<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['status'=>'forbidden']);
  exit;
}

$userId = $_SESSION['user_id'];

// Soft-delete all of this user’s notifications
$stmt = $conn->prepare("
  UPDATE notifications
     SET is_deleted = 1
   WHERE receiver_id = ?
");
$stmt->bind_param('i', $userId);
$stmt->execute();

// Success
header('Content-Type: application/json');
echo json_encode(['status'=>'ok']);
