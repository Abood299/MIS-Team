<?php
// give_swap.php
session_start();
require __DIR__ . '/includes/db.php';

// 1) Must be logged in
if (empty($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

$user_id         = (int) $_SESSION['user_id'];
$book_id         = (int) ($_POST['book_id'] ?? 0);
$desired_book_id = (int) ($_POST['desired_book_id'] ?? 0);
$details         = trim($_POST['details'] ?? '');

// 2) Validation
if (!$book_id || !$desired_book_id || $details === '') {
    header('Location: booksexchange.php?offer=error&type=swap&msg=' . urlencode('يجب اختيار كلا الكتابين وإدخال التفاصيل.'));
    exit;
}

// 3) No duplicate swaps
$dup = $conn->prepare("
  SELECT 1
    FROM book_offers
   WHERE user_id         = ?
     AND book_id         = ?
     AND desired_book_id = ?
     AND status          = 'active'
");
$dup->bind_param('iii', $user_id, $book_id, $desired_book_id);
$dup->execute();
if ($dup->get_result()->num_rows) {
    header('Location: booksexchange.php?offer=exists&type=swap');
    exit;
}

// 4) Insert the swap offer
$stmt = $conn->prepare("
  INSERT INTO book_offers
    (book_id, user_id, details, desired_book_id)
  VALUES (?,?,?,?)
");
$stmt->bind_param('iisi', $book_id, $user_id, $details, $desired_book_id);
if (!$stmt->execute()) {
    header('Location: booksexchange.php?offer=error&type=swap&msg=' . urlencode('خطأ في قاعدة البيانات.'));
    exit;
}

// 5) Redirect back with a flag so the panel opens
header('Location: booksexchange.php?offer=ok&type=swap');
exit;
