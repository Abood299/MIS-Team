<?php
// cancel_swap_request.php

session_start();
require __DIR__ . '/includes/db.php';

header('Content-Type: application/json; charset=UTF-8');

// 0) Must be logged in
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'not_logged_in']);
    exit;
}

// 1) Grab & validate
$requester  = (int) $_SESSION['user_id'];
$request_id = isset($_POST['request_id'])
    ? (int) $_POST['request_id']
    : 0;

if ($request_id <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'missing_request_id']);
    exit;
}

// 2) Soft-cancel *only* your own pending swap‐request
$stmt = $conn->prepare("
    UPDATE book_requests
       SET status = 'canceled'
     WHERE id           = ?
       AND requester_id = ?
       AND status       = 'pending'
");
$stmt->bind_param('ii', $request_id, $requester);
$stmt->execute();

// 3) Return JSON
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'ok']);
} else {
    // nothing was updated: either it didn't exist, wasn't yours, or wasn't pending
    echo json_encode([
        'status'  => 'error',
        'message' => 'not_found_or_already_handled'
    ]);
}
exit;
