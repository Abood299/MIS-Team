<?php
// edit_message.php
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
$messageId  = isset($_POST['message_id'])  ? (int)$_POST['message_id']  : 0;
$newMessage = isset($_POST['new_message']) ? trim($_POST['new_message']) : '';
if (!$messageId || $newMessage === '') {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Invalid input']);
    exit;
}

// 3) Verify ownership
$stmt = $conn->prepare("SELECT sender_id, message FROM chat_messages WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $messageId);
$stmt->execute();
$orig = $stmt->get_result()->fetch_assoc();
if (!$orig || $orig['sender_id'] != $userId) {
    http_response_code(403);
    echo json_encode(['status'=>'error','message'=>'Access denied']);
    exit;
}

// 4) (Optional) Save edit history
$hist = $conn->prepare("
  INSERT INTO chat_message_edits 
    (message_id, old_content, edited_at, edited_by)
  VALUES (?, ?, NOW(), ?)
");
$hist->bind_param('isi', $messageId, $orig['message'], $userId);
$hist->execute();

// 5) Update the message
$upd = $conn->prepare("
  UPDATE chat_messages
     SET message    = ?,
         is_edited  = 1,
         edited_at  = NOW()
   WHERE id = ?
");
$upd->bind_param('si', $newMessage, $messageId);
if (!$upd->execute()) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Database error']);
    exit;
}

// 6) Return success (with timestamp if you like)
echo json_encode([
  'status'    => 'ok',
  'edited_at' => date('Y-m-d H:i:s')
]);
