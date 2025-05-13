<?php
// take.php
session_start();

// 0) Always return JSON
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';  // adjust path as needed

// 1) Must be logged in
if (empty($_SESSION['user_id'])) {
    echo json_encode(['status'=>'error','msg'=>'login_required']);
    exit;
}

$userId  = (int) $_SESSION['user_id'];
$offerId = isset($_POST['offer_id']) ? (int) $_POST['offer_id'] : 0;

// 2) Validate offer_id
if ($offerId <= 0) {
    echo json_encode(['status'=>'error','msg'=>'invalid_offer_id']);
    exit;
}

// 3) Prevent duplicate request
$stmt = $conn->prepare("
     SELECT id
    FROM book_requests
   WHERE offer_id     = ?
     AND requester_id = ? 
     AND status       = 'pending'
"); // add 2 extra lines to prevent duplicate requests
$stmt->bind_param("ii", $offerId, $userId);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows > 0) {
    echo json_encode(['status'=>'exists']);
    exit;
}

// 4) Insert new request
$stmt = $conn->prepare("
    INSERT INTO book_requests (offer_id, requester_id, status)
         VALUES (?, ?, 'pending')
");
$stmt->bind_param("ii", $offerId, $userId);
$stmt->execute();

// Grab the new request’s ID
$requestId = $conn->insert_id;

// 5) Create a notification for the offer-owner
//    First look up the owner’s user_id:
$stmt = $conn->prepare("
    SELECT user_id
      FROM book_offers
     WHERE id = ?
");
$stmt->bind_param("i", $offerId);
$stmt->execute();
$ownerId = $stmt->get_result()->fetch_assoc()['user_id'];

// Then insert notification:
$stmt = $conn->prepare("
    INSERT INTO notifications
        (user_id, receiver_id, action_id, type, message)
      VALUES
        (?, ?, ?, 'book_request', CONCAT((SELECT CONCAT(first_name,' ',last_name) FROM users WHERE id=?), 
               ' has requested your book'))
");
$stmt->bind_param("iiii", $userId, $ownerId, $requestId, $userId);
$stmt->execute();

// 6) Return success + the new request_id
echo json_encode([
    'status'     => 'ok',
    'request_id' => $requestId
]);
exit;
