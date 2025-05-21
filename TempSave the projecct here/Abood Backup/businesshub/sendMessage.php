<?php
// sendMessage.php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 1) Authentication & input validation
if (empty($_SESSION['user_id'])
    || !isset($_POST['conversation_id'])
    || !isset($_POST['message'])
) {
    http_response_code(400);
    echo json_encode(['status'=>'error','error'=>'missing_parameters']);
    exit;
}

$senderId       = (int) $_SESSION['user_id'];
$conversationId = (int) $_POST['conversation_id'];
$content        = trim($_POST['message']);

if ($conversationId < 1 || $content === '') {
    http_response_code(400);
    echo json_encode(['status'=>'error','error'=>'invalid_input']);
    exit;
}

try {
    // 2) Send the message
    $messageId = sendMessage($conn, $conversationId, $senderId, $content);

    // 3) Return success JSON with timestamp
    echo json_encode([
        'status'      => 'ok',
        'message_id'  => $messageId,
        'created_at'  => date('Y-m-d H:i:s')
    ]);

} catch (Exception $e) {
    http_response_code(500);
    error_log("sendMessage.php error: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'error'  => 'could_not_send'
    ]);
}
