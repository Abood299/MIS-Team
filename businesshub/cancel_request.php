<?php
// cancel_request.php
header('Content-Type: application/json');
session_start();

// 1) Load MySQLi connection
require_once __DIR__ . '/includes/db.php';  // defines $conn

// 2) Auth check
if (empty($_SESSION['user_id'])) {
    echo json_encode(['status'=>'error','msg'=>'not_logged_in']);
    exit;
}

$userId    = (int)$_SESSION['user_id'];
$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;

// 3) Validate
if ($requestId <= 0) {
    echo json_encode(['status'=>'error','msg'=>'invalid_request_id']);
    exit;
}

// 4) First delete any associated notifications
$stmt = $conn->prepare("
    DELETE FROM notifications
     WHERE action_id = ?
");
$stmt->bind_param("i", $requestId);
if (!$stmt->execute()) {
    echo json_encode(['status'=>'error','msg'=>'notification_delete_failed']);
    exit;
}
$stmt->close();

// 5) Then delete the request itself
$stmt = $conn->prepare("
    DELETE FROM book_requests
     WHERE id = ?
       AND requester_id = ?
");
$stmt->bind_param("ii", $requestId, $userId);
if (!$stmt->execute()) {
    echo json_encode(['status'=>'error','msg'=>'request_delete_failed']);
    exit;
}
$stmt->close();

// 6) All done
echo json_encode(['status'=>'ok']);
exit;
