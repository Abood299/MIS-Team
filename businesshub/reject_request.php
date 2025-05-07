<?php
// reject_request.php

// 0) Always return JSON
header('Content-Type: application/json');
session_start();

// 1) Load MySQLi connection
require_once __DIR__ . '/includes/db.php';  // adjust path if needed

// 2) Must be logged in
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'login_required']);
    exit;
}

$ownerId   = (int) $_SESSION['user_id'];
$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;

// 3) Validate input
if ($requestId <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'msg' => 'invalid_request_id']);
    exit;
}

// 4) Verify ownership and get requester_id
$stmt = $conn->prepare(<<<SQL
  SELECT br.requester_id
    FROM book_requests AS br
    JOIN book_offers   AS o  ON br.offer_id = o.id
   WHERE br.id = ?
     AND o.user_id = ?
SQL
);
$stmt->bind_param('ii', $requestId, $ownerId);
$stmt->execute();
$res = $stmt->get_result();
if (!($row = $res->fetch_assoc())) {
    http_response_code(403);
    echo json_encode(['status' => 'forbidden']);
    exit;
}
$requesterId = (int) $row['requester_id'];
$stmt->close();

// 5) Delete the original "book_request" notification
$stmt = $conn->prepare(
    "DELETE FROM notifications WHERE action_id = ? AND type = 'book_request'"
);
$stmt->bind_param('i', $requestId);
$stmt->execute();
$stmt->close();

// 6) Insert the "rejected" notification (action_id = NULL)
$message = htmlspecialchars(
    $_SESSION['first_name'] . " rejected your book request.",
    ENT_QUOTES,
    'UTF-8'
);
$stmt = $conn->prepare(<<<SQL
  INSERT INTO notifications
    (user_id, receiver_id, action_id, type, message)
  VALUES
    (?, ?, NULL, 'request_rejected', ?)
SQL
);
$stmt->bind_param('iis', $ownerId, $requesterId, $message);
$stmt->execute();
$stmt->close();

// Instead of DELETE, do:
$stmt = $conn->prepare("
  UPDATE book_requests
     SET status     = 'rejected'
   WHERE id = ?
");
$stmt->bind_param('i', $requestId);
$stmt->execute();

// 8) Done
echo json_encode(['status' => 'ok']);
exit;
