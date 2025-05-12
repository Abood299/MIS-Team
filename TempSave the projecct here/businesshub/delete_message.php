<?php
// delete_message.php
session_start();
require __DIR__ . '/includes/db.php';
header('Content-Type: application/json; charset=UTF-8');

// 1) Auth check
$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['status'=>'error','message'=>'Not authenticated']);
    exit;
}

// 2) Validate input
$messageId = isset($_POST['message_id']) ? (int)$_POST['message_id'] : 0;
if (!$messageId) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Invalid message ID']);
    exit;
}

// 3) Verify ownership
$stmt = $conn->prepare("SELECT sender_id FROM chat_messages WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $messageId);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
if (!$row || $row['sender_id'] != $userId) {
    http_response_code(403);
    echo json_encode(['status'=>'error','message'=>'Access denied']);
    exit;
}

// 4) Soft‐delete
$upd = $conn->prepare("
  UPDATE chat_messages
     SET is_deleted = 1,
         deleted_at = NOW()
   WHERE id = ?
");
$upd->bind_param('i', $messageId);
if (!$upd->execute()) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Database error']);
    exit;
}

// 5) Success
echo json_encode(['status'=>'ok']);
