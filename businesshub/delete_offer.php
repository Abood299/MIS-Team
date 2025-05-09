<?php
// delete_offer.php — mark an offer as “dropped” via AJAX

session_start();
header('Content-Type: application/json; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(0);

require __DIR__ . '/includes/db.php';

// 1) Auth check
$userId = (int)($_SESSION['user_id'] ?? 0);
if (!$userId) {
    http_response_code(401);
    echo json_encode(['status'=>'error','message'=>'Not authenticated']);
    exit;
}

// 2) Validate offer_id
$offerId = isset($_POST['offer_id']) ? (int)$_POST['offer_id'] : 0;
if (!$offerId) {
    http_response_code(400);
    echo json_encode(['status'=>'error','message'=>'Invalid offer ID']);
    exit;
}

// 3) Verify ownership
$stmt = $conn->prepare("SELECT user_id FROM book_offers WHERE id = ? LIMIT 1");
$stmt->bind_param('i', $offerId);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if (!$row || (int)$row['user_id'] !== $userId) {
    http_response_code(403);
    echo json_encode(['status'=>'error','message'=>'Access denied']);
    exit;
}

// 4) Soft-delete by setting status='exchanged'
$upd = $conn->prepare("
  UPDATE book_offers
     SET status = 'exchanged'
   WHERE id = ?
");
$upd->bind_param('i', $offerId);
if (!$upd->execute()) {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Database error']);
    exit;
}

// 5) Success
echo json_encode(['status'=>'ok']);
exit;

// (no closing PHP tag, no trailing whitespace)
