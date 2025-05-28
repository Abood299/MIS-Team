<?php
// get_user_activity.php
header('Content-Type: application/json; charset=utf-8');
session_start();

// adjust path if needed:
require_once __DIR__ . '/includes/db.php';

if (empty($_SESSION['user_id'])) {
  http_response_code(403);
  echo json_encode(['offers'=>[], 'requests'=>[]]);
  exit;
}
$uid = (int) $_SESSION['user_id'];

// 1) Active offers (uses `details` column)
$stmt = $conn->prepare("
  SELECT 
    o.id           AS offer_id,
    b.book_name,
    o.details      AS book_condition,
    o.timestamp    AS offered_at
  FROM book_offers o
  JOIN book_exchange b ON b.id = o.book_id
  WHERE o.user_id = ?     /* your schema uses `user_id` for giver */
    AND o.status = 'active'
  ORDER BY o.timestamp DESC
");
$stmt->bind_param('i', $uid);
$stmt->execute();
$offers = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// 2) Pending requests (maps `timestamp` → `requested_at`)
$stmt = $conn->prepare("
  SELECT 
    r.id           AS request_id,
    b.book_name,
    r.timestamp    AS requested_at
  FROM book_requests r
  JOIN book_offers   o ON o.id = r.offer_id
  JOIN book_exchange b ON b.id = o.book_id
  WHERE r.requester_id = ?
    AND r.status = 'pending'
  ORDER BY r.timestamp DESC
");
$stmt->bind_param('i', $uid);
$stmt->execute();
$requests = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// 3) Emit JSON without any extra output
echo json_encode([
  'offers'   => $offers,
  'requests' => $requests
]);
