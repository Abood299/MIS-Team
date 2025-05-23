<?php
// includes/chat_functions.php
// Centralized chat helper functions

// Bootstrap your DB connection:
require_once __DIR__ . '/db.php';

/**
 * Get an existing conversation between two users, or create it (optionally linking a request).
 *
 * @param mysqli   $conn             Your mysqli connection.
 * @param int      $userA            One user’s ID.
 * @param int      $userB            The other user’s ID.
 * @param int|null $relatedRequestId Optional book_request ID to link this conversation to.
 * @return int   The conversation_id.
 * @throws Exception On DB errors.
 */
function getOrCreateConversation(mysqli $conn, int $userA, int $userB, ?int $relatedRequestId = null): int
{
    $user1 = min($userA, $userB);
    $user2 = max($userA, $userB);

    $stmt = $conn->prepare(
        "SELECT id FROM conversations WHERE user1_id = ? AND user2_id = ?"
    );
    if (!$stmt) throw new Exception($conn->error);
    $stmt->bind_param("ii", $user1, $user2);
    $stmt->execute();
    $stmt->bind_result($convId);
    if ($stmt->fetch()) {
        $stmt->close();
        if ($relatedRequestId !== null) {
            $upd = $conn->prepare(
                "UPDATE conversations SET related_request_id = ? WHERE id = ?"
            );
            $upd->bind_param("ii", $relatedRequestId, $convId);
            $upd->execute();
            $upd->close();
        }
        return $convId;
    }
    $stmt->close();

    if ($relatedRequestId !== null) {
        $ins = $conn->prepare(
            "INSERT INTO conversations (user1_id, user2_id, related_request_id) VALUES (?, ?, ?)"
        );
        $ins->bind_param("iii", $user1, $user2, $relatedRequestId);
    } else {
        $ins = $conn->prepare(
            "INSERT INTO conversations (user1_id, user2_id) VALUES (?, ?)"
        );
        $ins->bind_param("ii", $user1, $user2);
    }
    if (!$ins) throw new Exception($conn->error);
    $ins->execute();
    if ($ins->errno) throw new Exception($ins->error);
    $newId = $ins->insert_id;
    $ins->close();

    return $newId;
}

/**
 * List all conversations for a given user, with the partner’s info and last message.
 *
 * @param mysqli $conn Your mysqli connection.
 * @param int    $me   The current user’s ID.
 * @return array       Each element is an assoc-array with:
 *                     - conversation_id
 *                     - partner_id
 *                     - partner_name
 *                     - last_message
 *                     - last_message_time
 * @throws Exception On prepare/execute failure.
 */
function listConversations(mysqli $conn, int $me): array
{
    $sql = <<<SQL
    SELECT
      c.id AS conversation_id,
      CASE WHEN c.user1_id = ? THEN c.user2_id ELSE c.user1_id END AS partner_id,
      CONCAT(u.first_name,' ',u.last_name) AS partner_name,
      (
        SELECT m2.content
          FROM messages m2
         WHERE m2.conversation_id = c.id
         ORDER BY m2.created_at DESC
         LIMIT 1
      ) AS last_message,
      (
        SELECT m2.created_at
          FROM messages m2
         WHERE m2.conversation_id = c.id
         ORDER BY m2.created_at DESC
         LIMIT 1
      ) AS last_message_time
    FROM conversations c
    JOIN users u ON u.id = CASE WHEN c.user1_id = ? THEN c.user2_id ELSE c.user1_id END
    WHERE c.user1_id = ? OR c.user2_id = ?
    ORDER BY last_message_time DESC
    SQL;

    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
    $stmt->bind_param("iiii", $me, $me, $me, $me);
    $stmt->execute();
    $res = $stmt->get_result();

    $conversations = [];
    while ($row = $res->fetch_assoc()) {
        $conversations[] = $row;
    }
    $stmt->close();

    return $conversations;
}

/**
 * Send a message in a conversation.
 *
 * @param mysqli $conn           Your mysqli connection.
 * @param int    $conversationId The conversation’s ID.
 * @param int    $senderId       The user ID sending the message.
 * @param string $content        The message text.
 * @return int                   The new message’s ID.
 * @throws Exception             On SQL or prepare error.
 */
function sendMessage(mysqli $conn, int $conversationId, int $senderId, string $content): int
{
    $stmt = $conn->prepare(
        "INSERT INTO messages (conversation_id, sender_id, content) VALUES (?, ?, ?)"
    );
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
    $stmt->bind_param("iis", $conversationId, $senderId, $content);
    $stmt->execute();
    if ($stmt->errno) throw new Exception("Execute failed: " . $stmt->error);
    $messageId = $stmt->insert_id;
    $stmt->close();

    $upd = $conn->prepare(
        "UPDATE conversations SET last_message_at = NOW() WHERE id = ?"
    );
    if ($upd) {
        $upd->bind_param("i", $conversationId);
        $upd->execute();
        $upd->close();
    }

    return $messageId;
}

/**
 * Fetch all messages in a conversation.
 *
 * @param mysqli $conn           Your mysqli connection.
 * @param int    $conversationId The conversation’s ID.
 * @return array                 Each element is an assoc-array with message fields.
 * @throws Exception             On prepare/execute failure.
 */
function fetchMessages(mysqli $conn, int $conversationId): array
{
    $sql = <<<SQL
      SELECT id, sender_id, content, created_at, edited_at,
             is_deleted, deleted_at, deleted_by
      FROM messages
     WHERE conversation_id = ?
     ORDER BY created_at ASC
    SQL;

    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
    $stmt->bind_param("i", $conversationId);
    $stmt->execute();

    $res = $stmt->get_result();
    $messages = [];
    while ($row = $res->fetch_assoc()) {
        $messages[] = $row;
    }
    $stmt->close();

    return $messages;
}

/**
 * Edit an existing message: archive the old text, then update to the new content.
 *
 * @param mysqli $conn       Your mysqli connection.
 * @param int    $messageId  The ID of the message to edit.
 * @param int    $editorId   The user ID performing the edit.
 * @param string $newContent The new message text.
 * @return void
 * @throws Exception         On any SQL or prepare error.
 */
function editMessage(mysqli $conn, int $messageId, int $editorId, string $newContent): void
{
    $sel = $conn->prepare("SELECT content FROM messages WHERE id = ?");
    if (!$sel) throw new Exception("Prepare failed: " . $conn->error);
    $sel->bind_param("i", $messageId);
    $sel->execute();
    $sel->bind_result($oldContent);
    if (!$sel->fetch()) {
        $sel->close();
        throw new Exception("Message not found: {" . $messageId . "}");
    }
    $sel->close();

    $ins = $conn->prepare(
        "INSERT INTO message_edits (message_id, editor_id, old_content) VALUES (?, ?, ?)"
    );
    if (!$ins) throw new Exception("Prepare failed: " . $conn->error);
    $ins->bind_param("iis", $messageId, $editorId, $oldContent);
    $ins->execute();
    if ($ins->errno) throw new Exception($ins->error);
    $ins->close();

    $upd = $conn->prepare(
        "UPDATE messages SET content = ?, edited_at = NOW() WHERE id = ?"
    );
    if (!$upd) throw new Exception("Prepare failed: " . $conn->error);
    $upd->bind_param("si", $newContent, $messageId);
    $upd->execute();
    if ($upd->errno) throw new Exception($upd->error);
    $upd->close();
}

/**
 * Soft‐delete a message: mark it deleted, record who deleted it and when.
 *
 * @param mysqli $conn       Your mysqli connection.
 * @param int    $messageId  The ID of the message to delete.
 * @param int    $deleterId  The user ID performing the deletion.
 * @return void
 * @throws Exception         On any SQL or prepare error.
 */
function deleteMessage(mysqli $conn, int $messageId, int $deleterId): void
{
    $stmt = $conn->prepare(
        "UPDATE messages SET is_deleted = 1, deleted_at = NOW(), deleted_by = ? WHERE id = ?"
    );
    if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
    $stmt->bind_param("ii", $deleterId, $messageId);
    $stmt->execute();
    if ($stmt->errno) throw new Exception("Execute failed: " . $stmt->error);
    $stmt->close();
}