<?php
session_start();
require 'includes/db.php';

// 1) Ensure user is logged in
$me = (int)($_SESSION['user_id'] ?? 0);
if (!$me) {
    header('Location: user_login.php');
    exit;
}

// 2) Fallback: if someone lands via request_id, redirect to chat_id
if (!empty($_GET['request_id']) && empty($_GET['chat_id'])) {
    $requestId = (int) $_GET['request_id'];
    $stmt = $conn->prepare("SELECT id FROM chats WHERE request_id = ? LIMIT 1");
    $stmt->bind_param('i', $requestId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row) {
        header("Location: chat.php?chat_id=" . (int)$row['id']);
        exit;
    }
    die("Chat session not found.");
}

// 3) Get chat_id from query
$chatId = isset($_GET['chat_id']) ? (int)$_GET['chat_id'] : 0;
if (!$chatId) {
    die("Invalid chat.");
}

// 4) Verify current user belongs to this chat
$stmt = $conn->prepare(
    "SELECT user1_id, user2_id FROM chats WHERE id = ? AND (user1_id = ? OR user2_id = ?)"
);
$stmt->bind_param('iii', $chatId, $me, $me);
$stmt->execute();
$chatInfo = $stmt->get_result()->fetch_assoc();
if (!$chatInfo) {
    die("Access denied.");
}

// 5) Determine the other user (cast to int to avoid string/number mismatch)
$user1 = (int)$chatInfo['user1_id'];
$user2 = (int)$chatInfo['user2_id'];
$otherId = ($user1 === $me) ? $user2 : $user1;

$stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
$stmt->bind_param('i', $otherId);
$stmt->execute();
$userRow = $stmt->get_result()->fetch_assoc();
$otherName = htmlspecialchars(
    $userRow['first_name'] . ' ' . $userRow['last_name'],
    ENT_QUOTES,
    'UTF-8'
);

// 6) Fetch messages
$msgStmt = $conn->prepare(
    "SELECT m.sender_id, m.message, m.timestamp
       FROM chat_messages m
      WHERE m.chat_id = ?
      ORDER BY m.timestamp ASC"
);
$msgStmt->bind_param('i', $chatId);
$msgStmt->execute();
$messages = $msgStmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat with <?= $otherName ?></title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .chat-card { max-width: 700px; margin: auto; border: none; border-radius: .75rem; overflow: hidden; box-shadow: 0 0 .75rem rgba(0,0,0,.1); }
    .chat-header { background-color: #ffffff; padding: 1rem; border-bottom: 1px solid #e9ecef; }
    .chat-header .status-dot { display: inline-block; width: 10px; height: 10px; background-color: #198754; border-radius: 50%; margin-right: .5rem; }
    .chat-container { height: 70vh; overflow-y: auto; padding: 1rem; background-color: #ffffff; }
    .message { display: flex; margin-bottom: 1rem; }
    .message-left .content { background-color: #e9ecef; color: #495057; border-radius: .5rem .5rem .5rem 0; padding: .75rem 1rem; }
    .message-right { flex-direction: row-reverse; align-items: flex-end; }
    .message-right .content { background-color: #0d6efd; color: #ffffff; border-radius: .5rem .5rem 0 .5rem; padding: .75rem 1rem; }
    .chat-footer { background-color: #ffffff; padding: .75rem 1rem; border-top: 1px solid #e9ecef; position: sticky; bottom: 0; }
    .chat-footer .form-control { border-radius: .75rem 0 0 .75rem; }
    .chat-footer .btn { border-radius: 0 .75rem .75rem 0; }
  </style>
</head>
<body>

<div class="container py-4">
  <div class="card chat-card">
    <!-- Header -->
    <div class="chat-header d-flex align-items-center">
      <div class="status-dot"></div>
      <div>
        <h5 class="mb-0"><?= $otherName ?></h5>
        <small class="text-success">Online</small>
      </div>
    </div>

    <!-- Messages -->
    <div class="chat-container d-flex flex-column" id="chatContainer">
      <?php while ($msg = $messages->fetch_assoc()): 
        $cls = ((int)$msg['sender_id'] === $me) ? 'message-right' : 'message-left';
        $text = nl2br(htmlspecialchars($msg['message'], ENT_QUOTES, 'UTF-8'));
        // add data-ts so JS can initialize lastTs
        $ts   = htmlspecialchars($msg['timestamp'], ENT_QUOTES);
      ?>
        <div class="message <?= $cls ?>" data-ts="<?= $ts ?>">
          <div class="content"><?= $text ?></div>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Input -->
    <div class="chat-footer">
      <form action="send_message.php" method="POST" class="input-group">
        <input type="hidden" name="chat_id"    value="<?= $chatId ?>">
        <input type="hidden" name="receiver_id" value="<?= $otherId ?>">
        <input type="text" name="message" class="form-control" placeholder="Type your message..." required autocomplete="off">
        <button class="btn btn-primary" type="submit"><i class="fas fa-paper-plane"></i></button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Auto-scroll to the latest message on load
  const chatContainer = document.getElementById('chatContainer');
  if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;
</script>
<script>
  // Initialize polling
  const chatId = <?= $chatId ?>;
  // Grab timestamp of last rendered message so we don't re-fetch it
  const lastEl = document.querySelector('#chatContainer .message:last-child');
  let lastTs = lastEl ? lastEl.getAttribute('data-ts') : null;

  function appendMessage(m) {
    const cls = m.sender_id === <?= $me ?> ? 'message-right' : 'message-left';
    const div = document.createElement('div');
    div.className = 'message ' + cls;
    div.setAttribute('data-ts', m.timestamp);
    div.innerHTML = `<div class="content">${m.message}</div>`;
    chatContainer.appendChild(div);
  }

  function fetchNew() {
    let url = `get_messages.php?chat_id=${chatId}`;
    if (lastTs) url += `&after=${encodeURIComponent(lastTs)}`;
    fetch(url)
      .then(r => r.json())
      .then(msgs => {
        msgs.forEach(m => {
          appendMessage(m);
          lastTs = m.timestamp;
        });
        chatContainer.scrollTop = chatContainer.scrollHeight;
      })
      .catch(console.error);
  }

  // Poll for new messages every 3 seconds
  setInterval(fetchNew, 3000);
  // (optional) fetch once immediately:
  fetchNew();
</script>

</body>
</html>
