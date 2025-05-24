<?php
// File: includes/search_results.php
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/db.php';
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// 1) grab & sanitize
$search = trim($_GET['search'] ?? '');
if ($search === '') {
    header('Location: ../HomePage.php');
    exit;
}
$like = "%{$search}%";

// 2) quick existence check ONLY on books + staff
$stmt = $conn->prepare("
  SELECT 1
    FROM books
   WHERE book_name     LIKE ? 
      OR book_material LIKE ?
  UNION
  SELECT 1
    FROM academic_staff
   WHERE name  LIKE ?
      OR email LIKE ?
  LIMIT 1
");
$stmt->bind_param('ssss', $like, $like, $like, $like);
$stmt->execute();
$found = (bool) $stmt->get_result()->fetch_assoc();

// 3) redirect to results.php carrying the flag
header('Location: ../results.php'
     . '?search=' . urlencode($search)
     . '&found='  . ($found ? '1' : '0')
);
exit;
