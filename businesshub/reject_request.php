<?php
// reject.php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  exit;
}

$ownerId   = $_SESSION['user_id'];
$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;

// 1) Verify ownership
$stmt = $conn->prepare(<<<SQL
  SELECT br.requester_id
    FROM book_requests AS br
    JOIN book_offers   AS o ON br.offer_id = o.id
   WHERE br.id = ? AND o.user_id = ?
SQL
);
$stmt->bind_param('ii', $requestId, $ownerId);
$stmt->execute();
$res = $stmt->get_result();

if (!$row = $res->fetch_assoc()) {
  http_response_code(403);
  echo json_encode(['status'=>'forbidden']);
  exit;
}

// 2) Mark as rejected (or delete)
$stmt = $conn->prepare("
  UPDATE book_requests
     SET status = 'rejected'
   WHERE id = ?
");
$stmt->bind_param('i', $requestId);
$stmt->execute();

// 3) Notify the requester
$message = $_SESSION['first_name']." rejected your request.";
$stmt = $conn->prepare("
  INSERT INTO notifications
    (user_id, receiver_id, action_id, type, message)
  VALUES
    (?, ?, ?, 'request_rejected', ?)
");
$stmt->bind_param(
  'iiis',
  $ownerId,
  $row['requester_id'],
  $requestId,
  $message
);
$stmt->execute();

// 4) JSON back
header('Content-Type: application/json');
echo json_encode(['status'=>'ok']);
