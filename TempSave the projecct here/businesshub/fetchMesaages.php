<?php
// fetchMessages.php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 1) Auth & param check
if (empty($_SESSION['user_id']) || !isset($_GET['conversation_id'])) {
    http_response_code(400);
    echo json_encode(['error'=>'missing_parameters']);
    exit;
}

$conversationId = (int) $_GET['conversation_id'];

try {
    // 2) Fetch via your helper
    $msgs = fetchMessages($conn, $conversationId);
    echo json_encode($msgs);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error'=>$e->getMessage()]);
}
