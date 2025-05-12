<?php
// get_swap_offers.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=UTF-8');
require __DIR__ . '/includes/db.php';

$sql = "
  SELECT
    o.id                                AS offer_id,
    CONCAT(u.first_name,' ',u.last_name) AS giver_name,
    b1.book_name                        AS offered_title,   -- ← the book they’re offering
    o.details                           AS offer_condition,
    b2.book_name                        AS desired_title,   -- ← the book they want
    o.timestamp                         AS offered_at
  FROM book_offers AS o
  JOIN users AS u
    ON u.id = o.user_id

  -- join once for the book being offered:
  JOIN book_exchange AS b1
    ON b1.id = o.book_id

  -- join again for the desired book:
  JOIN book_exchange AS b2
    ON b2.id = o.desired_book_id

  WHERE o.desired_book_id IS NOT NULL
    AND o.status = 'active'
  ORDER BY o.timestamp DESC
";

$result = $conn->query($sql);
if (! $result) {
  http_response_code(500);
  echo json_encode([
    'error'   => 'DB query failed',
    'message' => $conn->error
  ]);
  exit;
}

$swaps = [];
while ($row = $result->fetch_assoc()) {
  $swaps[] = $row;
}

echo json_encode($swaps);
