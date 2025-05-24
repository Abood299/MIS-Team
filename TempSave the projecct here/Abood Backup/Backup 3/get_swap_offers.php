<?php
// get_swap_offers.php
session_start();
require __DIR__ . '/includes/db.php';
header('Content-Type: application/json; charset=UTF-8');

$me = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

$sql = "
  SELECT
    o.id                     AS offer_id,
    o.user_id                AS giver_id,
    CONCAT(u.first_name,' ',u.last_name) AS giver_name,
    b1.book_name             AS offered_title,
    o.details                AS offer_condition,
    b2.book_name             AS desired_title,
    o.timestamp              AS offered_at,

    -- join to see if *you* have already requested this swap and it's still pending
    CASE WHEN br.id IS NULL THEN 0 ELSE 1 END AS has_requested,
    COALESCE(br.id, 0)         AS request_id

  FROM book_offers AS o
  JOIN users AS u
    ON u.id = o.user_id
  JOIN book_exchange AS b1
    ON b1.id = o.book_id
  JOIN book_exchange AS b2
    ON b2.id = o.desired_book_id

  LEFT JOIN book_requests AS br
    ON br.offer_id     = o.id
   AND br.requester_id = {$me}
   AND br.status       = 'pending'

  WHERE o.desired_book_id IS NOT NULL
    AND o.status = 'active'
  ORDER BY o.timestamp DESC
";

$result = $conn->query($sql);
if (! $result) {
  http_response_code(500);
  echo json_encode(['error'=>'DB','message'=>$conn->error]);
  exit;
}

$swaps = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($swaps);
