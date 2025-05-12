<?php
// swap_request.php
session_start();
require 'includes/db.php';
if (empty($_SESSION['user_id'])) {
  header('HTTP/1.1 401 Unauthorized');
  exit;
}
$user_id  = (int)$_SESSION['user_id'];
$offer_id = (int)($_POST['offer_id'] ?? 0);

// 1) Dup-check
$dup = $conn->prepare("
  SELECT 1 FROM book_requests
   WHERE requester_id = ? 
     AND offer_id     = ? 
     AND status       = 'pending'
");
$dup->bind_param('ii',$user_id,$offer_id);
$dup->execute();
if ($dup->get_result()->num_rows) {
  echo json_encode(['status'=>'exists']);
  exit;
}

// 2) Insert the request
$stmt = $conn->prepare("
  INSERT INTO book_requests (offer_id, requester_id) 
  VALUES (?,?)
");
$stmt->bind_param('ii',$offer_id,$user_id);
$stmt->execute();
$request_id = $stmt->insert_id;

// 3) Send the same notification your take.php does
//    (Assuming in your take flow you have something like this)
$notify = $conn->prepare("
  INSERT INTO notifications 
    (user_id, type, ref_id)
  VALUES 
    ((SELECT user_id FROM book_offers WHERE id=?), 'swap_request', ?)
");
$notify->bind_param('ii',$offer_id,$request_id);
$notify->execute();

echo json_encode(['status'=>'ok','request_id'=>$request_id]);
