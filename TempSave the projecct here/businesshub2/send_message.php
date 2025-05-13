<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

$senderId   = $_SESSION['user_id'];
$chatId     = (int)($_POST['chat_id'] ?? 0);
$receiverId = (int)($_POST['receiver_id'] ?? 0);
$message    = trim($_POST['message'] ?? '');

if (!$chatId || !$receiverId || $message === '') {
    header("Location: chat.php?chat_id={$chatId}");
    exit;
}

// 1) Verify user belongs to this chat
$v = $conn->prepare(
    "SELECT 1 FROM chats WHERE id = ? AND (user1_id = ? OR user2_id = ?)"
);
$v->bind_param('iii', $chatId, $senderId, $senderId);
$v->execute();
if (!$v->get_result()->fetch_assoc()) {
    die('Access denied.');
}

// 2) Insert the message
$i = $conn->prepare(
    "INSERT INTO chat_messages
       (chat_id, sender_id, receiver_id, message)
     VALUES (?, ?, ?, ?)"
);
$i->bind_param('iiis', $chatId, $senderId, $receiverId, $message);
$i->execute();

// 3) Look up the original request_id from this chat
$r = $conn->prepare("SELECT request_id FROM chats WHERE id = ? LIMIT 1");
$r->bind_param('i', $chatId);
$r->execute();
$requestRow = $r->get_result()->fetch_assoc();
$requestId  = $requestRow ? (int)$requestRow['request_id'] : 0;

// 4) Notify the receiver, referencing the book_request ID
if ($requestId) {
    $notifText = $_SESSION['first_name'] . " sent you a message.";
    $notif = $conn->prepare(
        "INSERT INTO notifications
           (user_id, receiver_id, action_id, type, message)
         VALUES
           (?, ?, ?, 'new_message', ?)"
    );
    $notif->bind_param('iiis', $senderId, $receiverId, $requestId, $notifText);
    $notif->execute();
}

// 5) Redirect back into the chat
header("Location: chat.php?chat_id={$chatId}");
exit;
