<?php
// swap_request.php
session_start();
require 'includes/db.php';
header('Content-Type:application/json; charset=UTF-8');

if (empty($_SESSION['user_id'])) {
    echo json_encode(['status'=>'login_required']);
    exit;
}

$offerId = (int)($_POST['offer_id'] ?? 0);
$userId  = (int)$_SESSION['user_id'];

if (!$offerId) {
    echo json_encode(['status'=>'error','message'=>'No offer specified']);
    exit;
}

// prevent duplicates
$chk = $conn->prepare("
  SELECT 1 FROM swap_requests
   WHERE offer_id = ? AND requester_id = ?
");
$chk->bind_param('ii', $offerId, $userId);
$chk->execute();
if ($chk->get_result()->num_rows) {
    echo json_encode(['status'=>'exists']);
    exit;
}

// insert
$ins = $conn->prepare("
  INSERT INTO swap_requests
    (offer_id, requester_id, status, created_at)
  VALUES (?, ?, 'pending', NOW())
");
$ins->bind_param('ii', $offerId, $userId);
if ($ins->execute()) {
    echo json_encode(['status'=>'ok','request_id'=>$ins->insert_id]);
} else {
    echo json_encode(['status'=>'error','message'=>'DB error']);
}
