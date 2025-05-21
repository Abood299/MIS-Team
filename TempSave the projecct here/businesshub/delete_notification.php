<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['status'=>'forbidden']);
  exit;
}

$userId  = $_SESSION['user_id'];
$notifId = isset($_POST['notif_id']) ? (int)$_POST['notif_id'] : 0;

// Only soft‐delete rows that belong to me
$stmt = $conn->prepare("
  UPDATE notifications
     SET is_deleted = 1
   WHERE id = ?
     AND receiver_id = ?
");
$stmt->bind_param('ii', $notifId, $userId);
$stmt->execute();

echo json_encode(['status'=>'ok']);
