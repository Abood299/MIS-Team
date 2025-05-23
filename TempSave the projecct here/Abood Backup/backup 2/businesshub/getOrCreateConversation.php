<?php
// getOrCreateConversation.php

session_start();

// 1) bootstrap your DB connection
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 2) enforce login
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$me            = (int) $_SESSION['user_id'];
$otherUser     = isset($_GET['user_id'])    ? (int) $_GET['user_id']    : null;
$relatedReqId  = isset($_GET['request_id']) ? (int) $_GET['request_id'] : null;

if (!$otherUser) {
    die('Missing target user ID.');
}

try {
    // 3) fetch or create the conversation
    $conversationId = getOrCreateConversation(
        $conn,
        $me,
        $otherUser,
        $relatedReqId
    );

    // 4) redirect into your chat UI
    header("Location: chat.php?conversation_id={$conversationId}");
    exit;

} catch (Exception $e) {
    error_log("Chat bootstrap error: " . $e->getMessage());
    die("Could not open chat. Please try again later.");
}
