<?php
// send_message.php — AJAX endpoint for sending a chat message
session_start();

// 0) Force JSON output, hide any stray warnings
header('Content-Type: application/json; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(0);

require 'includes/db.php';

// ── 1) Authentication ──────────────────────────────────────────────────────────
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status'=>'error','message'=>'Not authenticated']);
    exit;
}

// ── 2) Gather & validate input ────────────────────────────────────────────────
$senderId    = (int) $_SESSION['user_id'];
$chatId      = (int) ($_POST['chat_id']     ?? 0);
$receiverId  = (int) ($_POST['receiver_id'] ?? 0);
$messageText = trim((string) ($_POST['message'] ?? ''));

if (!$chatId || !$receiverId || $messageText === '') {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Invalid input']);
    exit;
}

// ── 3) Verify user belongs to this chat ───────────────────────────────────────
$verify = $conn->prepare("
    SELECT 1
      FROM chats
     WHERE id = ?
       AND (user1_id = ? OR user2_id = ?)
     LIMIT 1
");
$verify->bind_param('iii', $chatId, $senderId, $senderId);
$verify->execute();
if (!$verify->get_result()->fetch_assoc()) {
    http_response_code(403);
    echo json_encode(['status'=>'error','message'=>'Access denied']);
    exit;
}

// ── 4) Insert the message ─────────────────────────────────────────────────────
$insert = $conn->prepare("
    INSERT INTO chat_messages
      (chat_id, sender_id, receiver_id, message)
    VALUES
      (?, ?, ?, ?)
");
$insert->bind_param('iiis',
    $chatId,
    $senderId,
    $receiverId,
    $messageText
);
if (!$insert->execute()) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Database insert failed']);
    exit;
}

// ── 5) Retrieve the timestamp of the newly inserted message ────────────────────
$newId = $insert->insert_id;
$tsQ   = $conn->prepare("
    SELECT timestamp
      FROM chat_messages
     WHERE id = ?
     LIMIT 1
");
$tsQ->bind_param('i', $newId);
$tsQ->execute();
$tsRow     = $tsQ->get_result()->fetch_assoc();
$timestamp = $tsRow['timestamp'] ?? date('Y-m-d H:i:s');

// ── 6) Notify the receiver ─────────────────────────────────────────────────────
$rQ = $conn->prepare("
    SELECT request_id
      FROM chats
     WHERE id = ?
     LIMIT 1
");
$rQ->bind_param('i', $chatId);
$rQ->execute();
$rRow      = $rQ->get_result()->fetch_assoc();
$requestId = (int) ($rRow['request_id'] ?? 0);

if ($requestId) {
    $notifText = ($_SESSION['first_name'] ?? 'Someone') . " sent you a message.";
    $nQ = $conn->prepare("
        INSERT INTO notifications
          (user_id, receiver_id, action_id, type, message)
        VALUES
          (?, ?, ?, 'new_message', ?)
    ");
    $nQ->bind_param('iiis',
        $senderId,
        $receiverId,
        $requestId,
        $notifText
    );
    $nQ->execute();
}

// ── 7) Return JSON ─────────────────────────────────────────────────────────────
echo json_encode([
    'status'    => 'ok',
    'sender_id' => $senderId,
    'message'   => $messageText,
    'timestamp' => $timestamp
]);
exit;
