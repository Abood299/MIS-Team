<?php
// drop_swap_offer.php
session_start();
require_once 'includes/db.php';

// 1) Must be logged in
if (empty($_SESSION['user_id'])) {
  http_response_code(403);
  echo json_encode(['status'=>'error','message'=>'Not logged in']);
  exit;
}

// 2) Get & validate offer_id
$offerId = isset($_POST['offer_id']) ? (int)$_POST['offer_id'] : 0;
if (!$offerId) {
  http_response_code(400);
  echo json_encode(['status'=>'error','message'=>'Missing offer_id']);
  exit;
}

// 3) Soft-delete the offer
$stmt = $conn->prepare("
  UPDATE book_offers
     SET status = 'dropped'
   WHERE id = ?
     AND user_id = ?
");
$stmt->bind_param('ii', $offerId, $_SESSION['user_id']);
$stmt->execute();

if ($stmt->affected_rows) {
  echo json_encode(['status'=>'ok']);
} else {
  http_response_code(500);
  echo json_encode(['status'=>'error','message'=>'Could not drop']);
}
