<?php
// give.php
session_start();
require_once 'includes/db.php';

// 1) must be logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: user_login.php');
  exit;
}

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id']);
$details = trim($_POST['details']);

// 2) check for an existing “offer” of the same book by this user
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
  // gentle alert and send them back
  echo <<<HTML
    <script>
      alert("You’ve already offered that book — you can’t add it twice.");
      window.location.href = "booksexchange.php";
    </script>
  HTML;
  exit;
}

// 3) otherwise insert the new offer
$stmt = $conn->prepare("
  INSERT INTO book_offers (book_id, user_id, details) 
  VALUES (?, ?, ?)
");
$stmt->bind_param("iis", $book_id, $user_id, $details);
$stmt->execute();

// 4) then redirect back with a success message (optional)
header("Location: booksexchange.php?offer=ok");
exit;
