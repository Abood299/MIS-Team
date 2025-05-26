<?php
// get_books_by_major.php
require 'includes/db.php';

$maj = (int)($_GET['major_id'] ?? 0);
$stmt = $conn->prepare("
  SELECT
    id,
    book_name AS title
  FROM book_exchange
  WHERE department_id = ?
  ORDER BY book_name
");
$stmt->bind_param('i', $maj);
$stmt->execute();
$res = $stmt->get_result();

$out = [];
while ($r = $res->fetch_assoc()) {
  $out[] = [
    'id'    => $r['id'],
    'title' => $r['title'],
  ];
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($out);
