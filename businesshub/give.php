
<?php
// give.php
session_start();
require_once 'includes/db.php';

// 1) Must be logged in
if (!isset($_SESSION['user_id'])) {
  header('HTTP/1.1 401 Unauthorized');
  echo json_encode(['status'=>'login_required']);
  exit;
}

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id']);
$details = trim($_POST['details']);

// 2) Check duplicate “give” by this user
$stmt = $conn->prepare("
  SELECT id
    FROM book_offers
   WHERE user_id = ?
     AND book_id = ?
     AND desired_book_id IS NULL
");
$stmt->bind_param("ii", $user_id, $book_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
  header('Location: booksexchange.php?offer=exists');
  exit;
}

// 3) Insert the new offer
$stmt = $conn->prepare("
  INSERT INTO book_offers (book_id, user_id, details) 
       VALUES (?, ?, ?)
");
$stmt->bind_param("iis", $book_id, $user_id, $details);
$stmt->execute();

// 4) success flag
header('Location: booksexchange.php?offer=ok');
exit;

// 4) Return updated copy count
$countRes = $conn->prepare("
  SELECT COUNT(*) AS cnt
    FROM book_offers
   WHERE book_id = ?
");
$countRes->bind_param("i", $book_id);
$countRes->execute();
$cnt = $countRes->get_result()->fetch_assoc()['cnt'];

/* 
// 5) JSON response
header('Content-Type: application/json');
echo json_encode([
  'status' => 'ok',
  'copies' => (int)$cnt
]);
exit; */