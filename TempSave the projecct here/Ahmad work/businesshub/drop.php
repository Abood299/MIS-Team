<?php
// drop.php

session_start();
header('Content-Type: application/json');
require_once 'includes/db.php';

// 1) Must be logged in
if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['status' => 'login_required']);
  exit;
}

$user_id  = (int) $_SESSION['user_id'];
$offer_id = isset($_POST['offer_id']) ? (int) $_POST['offer_id'] : 0;

// 2) Verify this active offer belongs to the user, and fetch its book_id
$stmt = $conn->prepare("
  SELECT book_id
    FROM book_offers
   WHERE id       = ?
     AND user_id  = ?
     AND status   = 'active'
   LIMIT 1
");
$stmt->bind_param('ii', $offer_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!($row = $result->fetch_assoc())) {
  // either it doesn't exist, isn't owned by you, or already dropped
  http_response_code(403);
  echo json_encode(['status' => 'forbidden']);
  exit;
}

$book_id = (int) $row['book_id'];
$stmt->close();

// 3) Soft-delete: mark the offer as dropped
$stmt = $conn->prepare("
  UPDATE book_offers
     SET status = 'dropped'
   WHERE id = ?
");
$stmt->bind_param('i', $offer_id);
$stmt->execute();
$stmt->close();

// 4) Re-count only active offers for that book
$stmt = $conn->prepare("
  SELECT COUNT(*) AS cnt
    FROM book_offers
   WHERE book_id = ?
     AND status  = 'active'
");
$stmt->bind_param('i', $book_id);
$stmt->execute();
$count = (int) $stmt->get_result()->fetch_assoc()['cnt'];
$stmt->close();

// 5) Return JSON
echo json_encode([
  'status'  => 'ok',
  'book_id' => $book_id,
  'copies'  => $count
]);
exit;
