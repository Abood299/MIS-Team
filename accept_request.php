<?php
// accept_request.php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  exit;
}

$ownerId   = $_SESSION['user_id'];
$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;

// 1) Verify this request belongs to one of my offers
$stmt = $conn->prepare(<<<SQL
  SELECT o.user_id        AS offer_owner,
         br.offer_id      AS offer_id,
         br.requester_id  AS requester_id
    FROM book_requests AS br
    JOIN book_offers   AS o  ON br.offer_id = o.id
   WHERE br.id = ?
     AND o.user_id = ?
SQL
);
$stmt->bind_param('ii', $requestId, $ownerId);
$stmt->execute();
$info = $stmt->get_result()->fetch_assoc();

if (!$info) {
  http_response_code(403);
  echo json_encode(['status'=>'forbidden']);
  exit;
}

// 2) Mark request approved
$upd = $conn->prepare("
  UPDATE book_requests
     SET status = 'accepted'
   WHERE id = ?
");
$upd->bind_param('i', $requestId);
$upd->execute();

// 3) Create a chat record linking the two users
$chatStmt = $conn->prepare("
  INSERT INTO chats (request_id, user1_id, user2_id)
       VALUES (?, ?, ?)
");
$chatStmt->bind_param(
  'iii',
  $requestId,
  $ownerId,
  $info['requester_id']
);
$chatStmt->execute();
$chatId = $conn->insert_id;

// 4) Notify the requester that they’ve been accepted
$message = $_SESSION['first_name'] . " accepted your request.";
$notif = $conn->prepare("
  INSERT INTO notifications
    (user_id, receiver_id, action_id, type, message)
  VALUES
    (?, ?, ?, 'request_accepted', ?)
");
$notif->bind_param(
  'iiis',
  $ownerId,
  $info['requester_id'],
  $requestId,
  $message
);
$notif->execute();

// 5) Return JSON with the new chat_id
header('Content-Type: application/json');
echo json_encode([
  'status'  => 'ok',
  'chat_id' => $chatId
]);
