<?php
session_start();
require 'includes/db.php';

$me     = $_SESSION['user_id'] ?? 0;
$chatId = (int)($_GET['chat_id'] ?? 0);

if (!$me || !$chatId) {
    http_response_code(400);
    exit;
}

// 1) Verify user is in chat
$stmt = $conn->prepare(
  "SELECT 1 
     FROM chats 
    WHERE id = ? 
      AND (user1_id = ? OR user2_id = ?)"
);
$stmt->bind_param('iii', $chatId, $me, $me);
$stmt->execute();
if (!$stmt->get_result()->fetch_assoc()) {
    http_response_code(403);
    exit;
}

// 2) Optional “after” timestamp filter
$after = $_GET['after'] ?? null;

if ($after) {
    $q = $conn->prepare("
        SELECT 
            m.id,
            m.sender_id,
            m.message,
            m.timestamp,
            m.is_deleted,
            m.is_edited,
            u.first_name,
            u.last_name
          FROM chat_messages m
          JOIN users u ON u.id = m.sender_id
         WHERE m.chat_id = ?
           AND m.timestamp > ?
         ORDER BY m.timestamp ASC
    ");
    $q->bind_param('is', $chatId, $after);
} else {
    $q = $conn->prepare("
        SELECT 
            m.id,
            m.sender_id,
            m.message,
            m.timestamp,
            m.is_deleted,
            m.is_edited,
            u.first_name,
            u.last_name
          FROM chat_messages m
          JOIN users u ON u.id = m.sender_id
         WHERE m.chat_id = ?
         ORDER BY m.timestamp ASC
    ");
    $q->bind_param('i', $chatId);
}

$q->execute();
$res = $q->get_result();

$out = [];
while ($r = $res->fetch_assoc()) {
    $out[] = [
        'id'         => (int)$r['id'],
        'sender_id'  => (int)$r['sender_id'],
        'first'      => $r['first_name'],
        'last'       => $r['last_name'],
        'message'    => $r['message'],
        'timestamp'  => $r['timestamp'],
        'is_deleted' => (bool)$r['is_deleted'],
        'is_edited'  => (bool)$r['is_edited'],
    ];
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($out);
