<?php
// mark_notifications_read.php
session_start();
require 'includes/db.php';

if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  exit;
}

$uid = (int)$_SESSION['user_id'];
$stmt = $conn->prepare("
  UPDATE notifications
     SET is_read = 1
   WHERE receiver_id = ?
");
$stmt->bind_param('i', $uid);
$stmt->execute();

header('Content-Type: application/json');
echo json_encode(['status'=>'ok']);
