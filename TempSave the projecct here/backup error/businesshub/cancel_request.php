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

// 4) Verify this is *your* pending request
$stmt = $conn->prepare("
    SELECT status
      FROM book_requests
     WHERE id = ?
       AND requester_id = ?
       AND status = 'pending'
    LIMIT 1
");
$stmt->bind_param("ii", $requestId, $userId);
$stmt->execute();
$res = $stmt->get_result();

if (! $res->fetch_assoc()) {
    echo json_encode(['status'=>'error','msg'=>'not_found_or_not_pending']);
    exit;
}
$stmt->close();

// 5) Soft‑delete: mark as canceled
$stmt = $conn->prepare("
    UPDATE book_requests
       SET status = 'canceled'
     WHERE id = ?
       AND requester_id = ?
");
$stmt->bind_param("ii", $requestId, $userId);
if (! $stmt->execute()) {
    echo json_encode(['status'=>'error','msg'=>'request_cancel_failed']);
    exit;
}
$stmt->close();

// 6) (Optional) If you want to remove the original notification that invited action,
//    you can still delete it here—but you’ll keep the request row for history.
//    e.g.:
//
//    $stmt = $conn->prepare("
//        DELETE FROM notifications
//         WHERE action_id = ?
//           AND type = 'book_request'
//    ");
//    $stmt->bind_param("i", $requestId);
//    $stmt->execute();
//    $stmt->close();

// 7) All done
echo json_encode(['status'=>'ok']);
exit;
