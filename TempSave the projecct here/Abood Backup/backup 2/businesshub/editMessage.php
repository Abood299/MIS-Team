<?php
// editMessage.php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 1) Auth & input
if (empty($_SESSION['user_id'])
 || !isset($_POST['message_id'])
 || !isset($_POST['new_message'])
) {
  http_response_code(400);
  echo json_encode(['status'=>'error','error'=>'missing_parameters']);
  exit;
}

$messageId  = (int) $_POST['message_id'];
$editorId   = (int) $_SESSION['user_id'];
$newContent = trim($_POST['new_message']);

if ($newContent === '') {
  http_response_code(400);
  echo json_encode(['status'=>'error','error'=>'empty_message']);
  exit;
}

// 2) Perform the edit
try {
  editMessage($conn, $messageId, $editorId, $newContent);
  echo json_encode(['status'=>'ok']);
} catch (Exception $e) {
  error_log("editMessage.php error: " . $e->getMessage());
  http_response_code(500);
  echo json_encode(['status'=>'error','error'=>'server_error']);
}
