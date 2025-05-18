<?php
// swap_request.php
session_start();
require __DIR__ . '/includes/db.php';

// — 0) Must be logged in
if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['status'=>'error','message'=>'not_logged_in']);
  exit;
}

$user_id  = (int) $_SESSION['user_id'];
$offer_id = (int) ($_POST['offer_id'] ?? 0);

// — 1) Validate
if (! $offer_id) {
  http_response_code(400);
  echo json_encode(['status'=>'error','message'=>'no_offer_id']);
  exit;
}

// — 2) Dup-check for *pending* only
$dup = $conn->prepare("
  SELECT 1
    FROM book_requests
   WHERE requester_id = ?
     AND offer_id     = ?
     AND status       = 'pending'
");
$dup->bind_param('ii', $user_id, $offer_id);
$dup->execute();
if ($dup->get_result()->num_rows) {
  echo json_encode(['status'=>'exists']);
  exit;
}

// — 3) Insert the new swap‐request
$ins = $conn->prepare("
  INSERT INTO book_requests (offer_id, requester_id)
  VALUES (?, ?)
");
$ins->bind_param('ii', $offer_id, $user_id);
$ins->execute();
$request_id = $ins->insert_id;

// 4) Pull all the pieces to build a message
//    - who asked (their name)
//    - what book they’re offering
//    - what book they want
$msgQ = $conn->prepare("
  SELECT
    CONCAT(u.first_name,' ',u.last_name) AS who,
    b1.book_name                       AS offered,
    b2.book_name                       AS desired,
    bo.user_id                         AS receiver_id
  FROM book_requests br
  JOIN book_offers    bo ON bo.id              = br.offer_id
  JOIN users          u  ON u.id               = br.requester_id
  JOIN book_exchange  b1 ON b1.id              = bo.book_id
  JOIN book_exchange  b2 ON b2.id              = bo.desired_book_id
  WHERE br.id = ?
");
$msgQ->bind_param('i', $request_id);
$msgQ->execute();
$data = $msgQ->get_result()->fetch_assoc();

$receiver_id = (int)$data['receiver_id'];
$who         = $data['who'];
$offered     = $data['offered'];
$desired     = $data['desired'];

$message = sprintf(
  "%s wants to swap “%s” for “%s”",
  $who,
  $offered,
  $desired
);

// 5) Fire the notification
$note = $conn->prepare("
  INSERT INTO notifications
    (receiver_id, type, action_id, message)
  VALUES
    (?, 'swap_request', ?, ?)
");
$note->bind_param('iis', $receiver_id, $request_id, $message);
$note->execute();

// 6) Return success
echo json_encode(['status'=>'ok', 'request_id'=>$request_id]);