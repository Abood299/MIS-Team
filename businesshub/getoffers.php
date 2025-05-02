<?php
// getOffers.php
session_start();
header('Content-Type: application/json');

require_once 'includes/db.php';

// 1) Validate input
$book_id = isset($_GET['book_id'])
           ? (int) $_GET['book_id']
           : 0;

if ($book_id <= 0) {
    echo json_encode([]);
    exit;
}

// 2) Query current offers for this book
$sql = "
  SELECT
    o.id            AS offer_id,
    o.details       AS book_condition,
    o.timestamp     AS offered_at,
    u.id            AS giver_id,
    u.first_name,
    u.last_name
  FROM book_offers AS o
  JOIN users      AS u 
    ON o.user_id = u.id
  WHERE o.book_id = $book_id
  ORDER BY o.timestamp DESC
";

$res = mysqli_query($conn, $sql);
if (!$res) {
    echo json_encode([]);
    exit;
}

// 3) Build response array
$offers = [];
while ($row = mysqli_fetch_assoc($res)) {
    $offers[] = [
        'offer_id'      => (int)$row['offer_id'],
        'giver_id'      => (int)$row['giver_id'],
        'giver_name'    => $row['first_name'] . ' ' . $row['last_name'],
        'book_condition'=> $row['book_condition'],
        'offered_at'    => $row['offered_at'],
    ];
}

// 4) Return JSON
echo json_encode($offers);
exit;
