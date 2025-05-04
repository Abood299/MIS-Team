<?php
// drop.php
session_start();
header('Content-Type: application/json');  // ← add this
require_once 'includes/db.php';

// 1) Must be logged in
if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  header('Content-Type: application/json');
  echo json_encode(['status'=>'login_required']);
  exit;
}

$user_id  = $_SESSION['user_id'];
$offer_id = intval($_POST['offer_id']);

// 2) Verify this offer belongs to the user, and fetch its book_id
$stmt = $conn->prepare("
  SELECT book_id
    FROM book_offers
   WHERE id = ? AND user_id = ?
   LIMIT 1
");
$stmt->bind_param("ii", $offer_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (! $row = $result->fetch_assoc()) {
  // either it doesn't exist, or it isn't owned by you
  http_response_code(403);
  header('Content-Type: application/json');
  echo json_encode(['status'=>'forbidden']);
  exit;
}

$book_id = (int)$row['book_id'];

// 3) Delete the offer
$stmt = $conn->prepare("DELETE FROM book_offers WHERE id = ?");
$stmt->bind_param("i", $offer_id);
$stmt->execute();

// 4) Re-count how many offers remain for that book
$stmt = $conn->prepare("
  SELECT COUNT(*) AS cnt
    FROM book_offers
   WHERE book_id = ?
");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$count = $stmt->get_result()->fetch_assoc()['cnt'];

// 5) Return JSON
header('Content-Type: application/json');
echo json_encode([
  'status'  => 'ok',
  'book_id' => $book_id,
  'copies'  => (int)$count
]);
exit;
