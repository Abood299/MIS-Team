<?php
// sendMessage.php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 1) Auth & input validation
if (
    empty($_SESSION['user_id'])
    || !isset($_POST['conversation_id'])
    || !isset($_POST['message'])
    || trim($_POST['message']) === ''
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

// 2) Insert the message and bump the convo
try {
    $messageId = sendMessage($conn, $conversationId, $senderId, $content);
    $createdAt = date('Y-m-d H:i:s');
} catch (Exception $e) {
    http_response_code(500);
    error_log("sendMessage insert error: " . $e->getMessage());
    echo json_encode(['status'=>'error','error'=>'could_not_send']);
    exit;
}

// 3) Insert a "new message" notification
try {
    // a) Lookup participants
    $stmt = $conn->prepare("
      SELECT user1_id, user2_id
        FROM conversations
       WHERE id = ?
    ");
    $stmt->bind_param("i", $conversationId);
    $stmt->execute();
    $stmt->bind_result($u1, $u2);
    $stmt->fetch();
    $stmt->close();

    $receiverId = ($senderId === $u1) ? $u2 : $u1;

    // b) Lookup sender's name
    $u = $conn->prepare("
      SELECT CONCAT(first_name, ' ', last_name)
        FROM users
       WHERE id = ?
    ");
    $u->bind_param("i", $senderId);
    $u->execute();
    $u->bind_result($senderName);
    $u->fetch();
    $u->close();

    if (!$senderName) {
        $senderName = 'Someone';
    }

    // c) Insert the notification into the new conversation_id column
    $text = "{$senderName} sent you a message.";
    $notif = $conn->prepare("
      INSERT INTO notifications
        (user_id, receiver_id, conversation_id, type, message)
      VALUES
        (?, ?, ?, 'message', ?)
    ");
    $notif->bind_param(
      'iiis',
      $senderId,
      $receiverId,
      $conversationId,
      $text
    );
    $notif->execute();
    $notif->close();

} catch (Exception $e) {
    // log and continue; we don't want to break the chat if notif fails
    error_log("sendMessage notification error: " . $e->getMessage());
}

// 4) Return success
echo json_encode([
    'status'      => 'ok',
    'message_id'  => $messageId,
    'created_at'  => $createdAt
]);
exit;
