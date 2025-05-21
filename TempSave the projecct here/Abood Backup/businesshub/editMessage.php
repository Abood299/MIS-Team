<?php
session_start();
require 'includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

function editMessage(mysqli $conn, int $messageId, int $editorId, string $newContent): void
{
    // 1) Fetch the current content
    $sel = $conn->prepare("SELECT content FROM messages WHERE id = ?");
    if (!$sel) {
        throw new Exception("Prepare failed (select): " . $conn->error);
    }
    $sel->bind_param("i", $messageId);
    $sel->execute();
    $sel->bind_result($oldContent);
    if (!$sel->fetch()) {
        $sel->close();
        throw new Exception("Message not found: {$messageId}");
    }
    $sel->close();

    // 2) Archive old content in message_edits
    $ins = $conn->prepare("
        INSERT INTO message_edits (message_id, editor_id, old_content)
        VALUES (?, ?, ?)
    ");
    if (!$ins) {
        throw new Exception("Prepare failed (insert edit): " . $conn->error);
    }
    $ins->bind_param("iis", $messageId, $editorId, $oldContent);
    $ins->execute();
    if ($ins->errno) {
        throw new Exception("Execute failed (insert edit): " . $ins->error);
    }
    $ins->close();

    // 3) Update the live message row
    $upd = $conn->prepare("
        UPDATE messages
           SET content   = ?,
               edited_at = NOW()
         WHERE id = ?
    ");
    if (!$upd) {
        throw new Exception("Prepare failed (update message): " . $conn->error);
    }
    $upd->bind_param("si", $newContent, $messageId);
    $upd->execute();
    if ($upd->errno) {
        throw new Exception("Execute failed (update message): " . $upd->error);
    }
    $upd->close();
}