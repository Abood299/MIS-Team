<?php
session_start();
require 'includes/db.php';
$me     = $_SESSION['user_id'] ?? 0;
$chatId = (int)($_GET['chat_id'] ?? 0);
if (!$me || !$chatId) { http_response_code(400); exit; }
// verify user is in chat…
$stmt = $conn->prepare(
  "SELECT 1 FROM chats WHERE id=? AND (user1_id=? OR user2_id=?)"
);
$stmt->bind_param('iii',$chatId,$me,$me);
$stmt->execute();
if (!$stmt->get_result()->fetch_assoc()) {
  http_response_code(403); exit;
}
// optional “after” timestamp filter:
$after = $_GET['after'] ?? null;
if ($after) {
  $q = $conn->prepare("
    SELECT m.*,u.first_name,u.last_name
      FROM chat_messages m
      JOIN users u ON u.id=m.sender_id
     WHERE m.chat_id=? AND m.timestamp>? 
     ORDER BY m.timestamp ASC
  ");
  $q->bind_param('is',$chatId,$after);
} else {
  $q = $conn->prepare("
    SELECT m.*,u.first_name,u.last_name
      FROM chat_messages m
      JOIN users u ON u.id=m.sender_id
     WHERE m.chat_id=?
     ORDER BY m.timestamp ASC
  ");
  $q->bind_param('i',$chatId);
}
$q->execute();
$res = $q->get_result();
$out = [];
while ($r = $res->fetch_assoc()) {
  $out[] = [
    'id'        => $r['id'],
    'sender_id' => $r['sender_id'],
    'first'     => $r['first_name'],
    'last'      => $r['last_name'],
    'msg'       => $r['message'],
    'ts'        => $r['timestamp'],
  ];
}
header('Content-Type: application/json');
echo json_encode($out);
