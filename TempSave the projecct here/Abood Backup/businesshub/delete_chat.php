<?php
// delete_chat.php
session_start();
require 'includes/db.php';

if (empty($_SESSION['user_id']) || empty($_POST['chat_id'])) {
  http_response_code(400);
  echo json_encode(['error'=>'bad_request']);
  exit;
}

$me      = (int)$_SESSION['user_id'];
$chat_id = (int)$_POST['chat_id'];

$stmt = $conn->prepare(<<<SQL
  INSERT INTO chat_deletions (user_id, chat_id, deleted_at)
  VALUES (?, ?, NOW())
  ON DUPLICATE KEY UPDATE deleted_at = NOW()
SQL);
$stmt->bind_param('ii', $me, $chat_id);
$stmt->execute();

echo json_encode(['status'=>'ok']);
