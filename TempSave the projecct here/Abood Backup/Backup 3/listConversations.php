<?php


session_start();

// 1) bootstrap your DB connection
// adjust the path if needed—this should define $conn = mysqli_connect(...)
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

function listConversations(mysqli $conn, int $me): array
{
    $sql = "
    SELECT
      c.id AS conversation_id,
      -- pick the “other” user
      CASE
        WHEN c.user1_id = ? THEN c.user2_id
        ELSE c.user1_id
      END AS partner_id,
      -- grab their name
      CONCAT(u.first_name, ' ', u.last_name) AS partner_name,
      -- subquery to pull the very latest message in this convo
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
    JOIN users u
      ON u.id = CASE
                   WHEN c.user1_id = ? THEN c.user2_id
                   ELSE c.user1_id
                 END
    WHERE c.user1_id = ? OR c.user2_id = ?
    ORDER BY last_message_time DESC
    ";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    // bind the same $me four times
    $stmt->bind_param("iiii", $me, $me, $me, $me);
    $stmt->execute();
    $result = $stmt->get_result();

    $conversations = [];
    while ($row = $result->fetch_assoc()) {
        $conversations[] = $row;
    }

    $stmt->close();
    return $conversations;
}