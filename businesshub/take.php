<?php
// take.php
session_start();
require_once 'includes/db.php';

// 1) Must be logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: user_login.php');
  exit;
}

$requester_id = $_SESSION['user_id'];
$offer_id     = intval($_POST['offer_id']);

// 2) Check if this user already requested this offer
$stmt = $conn->prepare("
  SELECT id 
  FROM book_requests 
  WHERE offer_id = ? AND requester_id = ?
");
$stmt->bind_param("ii", $offer_id, $requester_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
  // Already requested
  header('Content-Type: application/json');
  echo json_encode(['status' => 'exists']);
  exit;
}

// 3) Insert the new request
$stmt = $conn->prepare("
  INSERT INTO book_requests (offer_id, requester_id, status)
  VALUES (?, ?, 'pending')
");
$stmt->bind_param("ii", $offer_id, $requester_id);
$stmt->execute();

// grab the new request’s id exactly once
$request_id = $stmt->insert_id;

// 4) Now find the owner of that offer
//    (use a fresh variable so we don’t clobber $stmt)
$stmt2 = $conn->prepare("
  SELECT user_id 
    FROM book_offers 
   WHERE id = ?
");
$stmt2->bind_param("i", $offer_id);
$stmt2->execute();
$owner_id = $stmt2->get_result()->fetch_assoc()['user_id'];

// 5) Insert the notification
$message = $_SESSION['first_name'] . " has requested your book offer.";
$stmt3 = $conn->prepare(<<<SQL
  INSERT INTO notifications
    (user_id, receiver_id, action_id, type, message)
  VALUES (?, ?, ?, 'book_request', ?)
SQL
);
$stmt3->bind_param("iiis", $_SESSION['user_id'], $owner_id, $request_id, $message);
$stmt3->execute();

// 6) Return success
header('Content-Type: application/json');
echo json_encode(['status'=>'ok']);
exit;

