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
  SELECT o.user_id       AS offer_owner,
         br.offer_id     AS offer_id,
         br.requester_id AS requester_id
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

// 2) Mark this request approved
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

// 4) Handle *other* pending requests for the same offer
$otherStmt = $conn->prepare("
  SELECT id, requester_id
    FROM book_requests
   WHERE offer_id = ?
     AND status   = 'pending'
     AND id      != ?
");
$otherStmt->bind_param('ii', $info['offer_id'], $requestId);
$otherStmt->execute();
$others = $otherStmt->get_result();

while ($row = $others->fetch_assoc()) {
  $otherReqId  = (int)$row['id'];
  $otherUserId = (int)$row['requester_id'];

  // 4a) Soft-delete their original book_request notification
  $delNotif = $conn->prepare("
    UPDATE notifications
       SET is_deleted = 1
     WHERE type      = 'book_request'
       AND action_id = ?
  ");
  $delNotif->bind_param('i', $otherReqId);
  $delNotif->execute();

  // 4b) Mark their request row as rejected
  $rejReq = $conn->prepare("
    UPDATE book_requests
       SET status = 'rejected'
     WHERE id = ?
  ");
  $rejReq->bind_param('i', $otherReqId);
  $rejReq->execute();

  // 4c) Notify them that the book was given to someone else
  $msgTaken = $_SESSION['first_name']
            . " gave this book to someone else.";
  $noteTaken = $conn->prepare("
    INSERT INTO notifications
      (user_id, receiver_id, action_id, type, message)
    VALUES
      (?, ?, ?, 'book_taken', ?)
  ");
  $noteTaken->bind_param(
    'iiis',
    $ownerId,
    $otherUserId,
    $info['offer_id'],
    $msgTaken
  );
  $noteTaken->execute();
}

// 5) Notify the accepted requester
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

// 6) Return JSON with the new chat_id
header('Content-Type: application/json');
echo json_encode([
  'status'  => 'ok',
  'chat_id' => $chatId
]);
