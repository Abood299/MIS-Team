<?php
// getOffers.php
session_start();
header('Content-Type: application/json');

require_once 'includes/db.php';

// 1) Validate input
$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : 0;
if ($book_id <= 0) {
    echo json_encode(['error' => 'Invalid book ID']); // 🚨 Better error feedback
    exit;
}

// 2) Get user ID safely
$user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// 3) Use prepared statements to prevent SQL injection
$sql = "
  SELECT DISTINCT
    o.id                                 AS offer_id,
    o.details                            AS book_condition,
    o.timestamp                          AS offered_at,
    u.id                                 AS giver_id,
    CONCAT(u.first_name,' ',u.last_name) AS giver_name,
    CASE WHEN br.id IS NULL THEN 0 ELSE 1 END AS has_requested,
    COALESCE(br.id, 0)                   AS request_id
  FROM book_offers AS o
  JOIN users AS u ON u.id = o.user_id
  LEFT JOIN book_requests AS br
    ON br.offer_id = o.id
    AND br.requester_id = ?
    AND br.status = 'pending'
  WHERE o.book_id = ?
    AND o.status = 'active'
    -- AND o.desired_book_id IS NULL 🚨 Commented out to include ALL offers (both Give and Exchange)
  ORDER BY o.timestamp DESC
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'SQL prepare failed: ' . $conn->error]); // 🚨 Log errors
    exit;
}

$stmt->bind_param("ii", $user_id, $book_id);
$stmt->execute();
$res = $stmt->get_result();


// 4) Build response array
$offers = [];
while ($row = $res->fetch_assoc()) {
    $offer_id = (int)$row['offer_id'];

    // This is the *key addition*: check for ANY pending request (by anyone) on this offer!
    $pendingReq = $conn->prepare("SELECT COUNT(*) as cnt FROM book_requests WHERE offer_id = ? AND status = 'pending'");
    $pendingReq->bind_param('i', $offer_id);
    $pendingReq->execute();
    $pendingRes = $pendingReq->get_result();
    $pendingCnt = $pendingRes->fetch_assoc()['cnt'] ?? 0;
    $pendingReq->close();

    $offers[] = [
        'offer_id'            => $offer_id,
        'giver_id'            => (int)$row['giver_id'],
        'giver_name'          => $row['giver_name'],
        'book_condition'      => $row['book_condition'],
        'offered_at'          => $row['offered_at'],
        'has_requested'       => (int)$row['has_requested'],
        'request_id'          => (int)$row['request_id'],
        'has_pending_request' => $pendingCnt > 0 ? 1 : 0, // <-- NEW!
    ];
}
echo json_encode($offers);
exit;