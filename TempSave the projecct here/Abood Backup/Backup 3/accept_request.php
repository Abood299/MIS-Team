<?php
// accept_request.php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';  // bring in getOrCreateConversation()

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  exit;
}

$ownerId   = (int) $_SESSION['user_id'];
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
$stmt->close();

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
$upd->close();

// 3) Soft-delete my offer (mark as exchanged)
$updOffer = $conn->prepare(
  "UPDATE book_offers SET status = 'exchanged' WHERE id = ?"
);
$updOffer->bind_param('i', $info['offer_id']);
$updOffer->execute();
$updOffer->close();

// 4) Spin up the conversation linking these two users
$conversationId = getOrCreateConversation(
  $conn,
  $ownerId,
  $info['requester_id'],
  $requestId
);

// 5) Handle *other* pending requests for the same offer
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
$otherStmt->close();

while ($row = $others->fetch_assoc()) {
  $otherReqId  = (int)$row['id'];
  $otherUserId = (int)$row['requester_id'];

  // 5a) Soft-delete their original book_request notification
  $delNotif = $conn->prepare("
    UPDATE notifications
       SET is_deleted = 1
     WHERE type      = 'book_request'
       AND action_id = ?
  ");
  $delNotif->bind_param('i', $otherReqId);
  $delNotif->execute();
  $delNotif->close();

  // 5b) Mark their request row as rejected
  $rejReq = $conn->prepare("
    UPDATE book_requests
       SET status = 'rejected'
     WHERE id = ?
  ");
  $rejReq->bind_param('i', $otherReqId);
  $rejReq->execute();
  $rejReq->close();

  // 5c) Notify them that the book was given to someone else
  $msgTaken = $_SESSION['first_name'] . " gave this book to someone else.";
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
  $noteTaken->close();
}

// 6) Notify the accepted requester
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
$notif->close();

// 7) Return JSON with the new conversation_id
echo json_encode([
  'status'           => 'ok',
  'conversation_id'  => $conversationId
]);
exit;