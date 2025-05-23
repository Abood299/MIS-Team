<?php
// deleteMessage.php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

if (empty($_SESSION['user_id']) || !isset($_POST['message_id'])) {
  http_response_code(400);
  echo json_encode(['status'=>'error','error'=>'missing_parameters']);
  exit;
}

$messageId = (int) $_POST['message_id'];
$deleterId = (int) $_SESSION['user_id'];

try {
  deleteMessage($conn, $messageId, $deleterId);
  echo json_encode([
    'status'     => 'ok',
    'deleted_at' => date('Y-m-d H:i:s'),
  ]);
} catch (Exception $e) {
  error_log("deleteMessage.php error: " . $e->getMessage());
  http_response_code(500);
  echo json_encode(['status'=>'error','error'=>'server_error']);
}
