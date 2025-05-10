<?php
// getOffers.php
session_start();
header('Content-Type: application/json');

require_once 'includes/db.php';

// 1) Validate input
$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : 0;
if ($book_id <= 0) {
    echo json_encode([]);
    exit;
}

// 2) Who am I?
$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// 3) Pull all active offers + giver info + whether *this* user has a PENDING request
$sql = "
  SELECT DISTINCT
    o.id                                AS offer_id,
    o.details                           AS book_condition,
    o.timestamp                         AS offered_at,
    u.id                                AS giver_id,
    CONCAT(u.first_name,' ',u.last_name) AS giver_name,

    -- new fields for cancel/undo
    CASE WHEN br.id IS NULL THEN 0 ELSE 1 END AS has_requested,
    COALESCE(br.id, 0)                  AS request_id

  FROM book_offers AS o
  JOIN users         AS u  ON u.id = o.user_id

  LEFT JOIN book_requests AS br
    ON br.offer_id     = o.id
   AND br.requester_id = {$user_id}
   AND br.status       = 'pending'        -- only matching pending requests

  WHERE o.book_id   = {$book_id}
    AND o.status    = 'active'           -- only include non-dropped offers
  ORDER BY o.timestamp DESC
";


$res = mysqli_query($conn, $sql);
if (!$res) {
    echo json_encode([]);
    exit;
}

// 4) Build response array
$offers = [];
while ($row = mysqli_fetch_assoc($res)) {
    $offers[] = [
        'offer_id'      => (int)$row['offer_id'],
        'giver_id'      => (int)$row['giver_id'],
        'giver_name'    => $row['giver_name'],
        'book_condition'=> $row['book_condition'],
        'offered_at'    => $row['offered_at'],
        'has_requested' => (int)$row['has_requested'],  // 1 if you have a pending request
        'request_id'    => (int)$row['request_id'],     // the pending request’s id, or 0
    ];
}

// 5) Return JSON
echo json_encode($offers);
exit;
