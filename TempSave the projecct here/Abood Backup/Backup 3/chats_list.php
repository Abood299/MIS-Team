<?php
// chats_list.php
session_start();
header('Content-Type: application/json');

// 1) Bootstrap DB & helpers
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 2) Auth
if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode([]);  // or ['error'=>'not_logged_in']
  exit;
}

// 3) Fetch & output
try {
  $me    = (int) $_SESSION['user_id'];
  $chats = listConversations($conn, $me);
  echo json_encode($chats);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error'=>'could_not_load_chats']);
}
