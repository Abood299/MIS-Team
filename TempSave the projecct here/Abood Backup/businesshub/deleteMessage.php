<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

function deleteMessage(mysqli $conn, int $messageId, int $deleterId): void
{
    $stmt = $conn->prepare("
        UPDATE messages
           SET is_deleted = 1,
               deleted_at = NOW(),
               deleted_by = ?
         WHERE id = ?
    ");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ii", $deleterId, $messageId);
    $stmt->execute();
    if ($stmt->errno) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    $stmt->close();
}
if (empty($_SESSION['user_id']) || empty($_POST['message_id'])) {
    http_response_code(400);
    exit('Missing parameters.');
}

try {
    $msgId     = (int) $_POST['message_id'];
    $deleterId = (int) $_SESSION['user_id'];

    deleteMessage($conn, $msgId, $deleterId);

    echo json_encode([
        'status'     => 'success',
        'deleted_at' => date('Y-m-d H:i:s'),
    ]);
} catch (Exception $e) {
    error_log("Chat deleteMessage error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Unable to delete message']);
}
