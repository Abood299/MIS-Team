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
    "SELECT request_id, user1_id, user2_id
       FROM chats
      WHERE id = ? AND (user1_id = ? OR user2_id = ?)"
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
// 5.1) Fetch the offer_id behind this chat
$reqStmt = $conn->prepare("
  SELECT offer_id 
    FROM book_requests 
   WHERE id = ?
   LIMIT 1
");
$reqStmt->bind_param('i', $chatInfo['request_id']);
$reqStmt->execute();
$reqRow   = $reqStmt->get_result()->fetch_assoc();
$offerId  = $reqRow ? (int)$reqRow['offer_id'] : 0;

// ─── NEW: fetch the offer’s current status ─────────────────────────────────────
$offerStatus = '';
if ($offerId) {
    $st = $conn->prepare("
      SELECT status
        FROM book_offers
       WHERE id = ?
       LIMIT 1
    ");
    $st->bind_param('i', $offerId);
    $st->execute();
    $statRow = $st->get_result()->fetch_assoc();
    $offerStatus = $statRow['status'] ?? '';
}
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
   <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
  <style>
  html, body {
    height: 100%;
    margin: 0;
  }
  .container-fluid.h-100 {
    height: calc(100vh - 2rem);
  }
  .card.flex-grow-1 {
    display: flex;
    flex-direction: column;
    max-height: 100%;
  }
  .card.flex-grow-1 .card-header,
  .card.flex-grow-1 .card-footer {
    flex: 0 0 auto;
  }
  .card.flex-grow-1 #chatContainer {
    flex: 1 1 auto;
    overflow-y: auto;
  }
  </style>
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container-fluid h-100 py-4">
  <div class="row h-100 justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 h-100 d-flex flex-column">
      <div class="card flex-grow-1 d-flex flex-column shadow-sm">

        <!-- Header -->
        <div class="card-header bg-white d-flex align-items-center">
          <span class="status-dot rounded-circle bg-success me-2"
                style="width:10px; height:10px;"></span>
          <div>
            <h5 class="mb-0"><?= $otherName ?></h5>
            <small class="text-success">Online</small>
          </div>
          <div class="ms-auto">
            <?php if (
              $offerId
              && $me === $chatInfo['user1_id']
              && $offerStatus === 'active'
            ): ?>
              <button
                type="button"
                id="deleteOfferBtn"
                class="btn btn-warning btn-sm"
                data-offer-id="<?= $offerId ?>"
              >
                We’ve made the deal – delete my offer
              </button>

            <?php elseif (
              $offerId
              && $me === $chatInfo['user1_id']
              && $offerStatus === 'exchanged'
            ): ?>
              <span class="badge bg-secondary">Exchanged</span>
            <?php endif; ?>
          </div>
        </div>

        <!-- Messages -->
        <div id="chatContainer" class="flex-grow-1 overflow-auto p-3 bg-white">
          <?php while ($msg = $messages->fetch_assoc()):
            $isMine = ((int)$msg['sender_id'] === $me);
            $align  = $isMine ? 'justify-content-end' : 'justify-content-start';
            $bg     = $isMine ? 'bg-primary text-white' : 'bg-light text-dark';
            $dt     = (new DateTime($msg['timestamp']))->format('H:i');
          ?>
            <div class="d-flex <?= $align ?> mb-2">
              <div class="p-2 <?= $bg ?> rounded" style="max-width:75%;">
                <div><?= nl2br(htmlspecialchars($msg['message'], ENT_QUOTES)) ?></div>
                <div class="text-end small text-muted mt-1"><?= $dt ?></div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <!-- Footer (input) -->
        <div class="card-footer chat-footer bg-white">
          <form action="send_message.php" method="POST" class="input-group">
            <input type="hidden" name="chat_id"    value="<?= $chatId ?>">
            <input type="hidden" name="receiver_id" value="<?= $otherId ?>">
            <input type="text"
                   name="message"
                   class="form-control"
                   placeholder="Type your message…"
                   required
                   autocomplete="off">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-paper-plane"></i>
            </button>
          </form>
        </div>

      </div>
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

<!-- Polling & appendMessage -->
<script>
  const chatContainer = document.getElementById('chatContainer');
  const chatId        = <?= $chatId ?>;
  let lastTs = chatContainer.querySelector('.message:last-child')?.dataset.ts || null;

  function appendMessage(m) {
    const body = m.message ?? '[no text]';
    const tsRaw = m.timestamp ?? null;
    let timeStr = '';
    if (tsRaw) {
      const dt = new Date(tsRaw);
      timeStr = `${String(dt.getHours()).padStart(2,'0')}:${String(dt.getMinutes()).padStart(2,'0')}`;
    }
    const isMine = m.sender_id === <?= $me ?>;
    const align  = isMine ? 'justify-content-end' : 'justify-content-start';
    const bg     = isMine ? 'bg-primary text-white' : 'bg-light text-dark';

    const div = document.createElement('div');
    div.className = `d-flex ${align} mb-2 message`;
    if (tsRaw) div.dataset.ts = tsRaw;
    div.innerHTML = `
      <div class="p-2 ${bg} rounded" style="max-width:75%;">
        ${body.replace(/\n/g,'<br>')}
        ${timeStr ? `<div class="text-end small text-muted mt-1">${timeStr}</div>` : ''}
      </div>
    `;
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
          lastTs = m.timestamp ?? lastTs;
        });
        chatContainer.scrollTop = chatContainer.scrollHeight;
      })
      .catch(console.error);
  }

  setInterval(fetchNew, 3000);
  fetchNew();
</script>

<!-- AJAX send handler -->
<script>
  const form       = document.querySelector('.chat-footer form');
  const input      = form.querySelector('input[name="message"]');

  form.addEventListener('submit', e => {
    e.preventDefault();
    const text = input.value.trim();
    if (!text) return;

    const payload = new URLSearchParams({
      chat_id:     chatId,
      receiver_id: <?= $otherId ?>,
      message:     text
    });

    fetch('send_message.php', {
      method:  'POST',
      headers: { 'Content-Type':'application/x-www-form-urlencoded' },
      body:    payload.toString()
    })
    .then(r => r.json())
    .then(data => {
      if (data.status === 'ok') {
        appendMessage({
          sender_id: data.sender_id,
          message:   data.message,
          timestamp: data.timestamp
        });
        input.value = '';
        chatContainer.scrollTop = chatContainer.scrollHeight;
        history.replaceState(null,'',`chat.php?chat_id=${chatId}`);
      } else {
        alert('Send failed: ' + (data.message||data.status));
      }
    })
    .catch(() => alert('Network error sending message.'));
  });
</script>
<!-- to delete the offer  -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('deleteOfferBtn');
  if (!btn) return;

  btn.addEventListener('click', e => {
    e.preventDefault();
    if (!confirm('Are you sure the deal is done?')) return;

    const offerId = btn.dataset.offerId;
    fetch('delete_offer.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `offer_id=${encodeURIComponent(offerId)}`
    })
    .then(res => {
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      return res.json();
    })
    .then(data => {
      if (data.status === 'ok') {
        // mark exchanged in the UI
        btn.disabled = true;
        btn.textContent = 'Exchanged';
        btn.classList.remove('btn-warning');
        btn.classList.add('btn-secondary');
      } else {
        console.error(data);
        alert('Could not update offer: ' + (data.message||data.status));
      }
    })
    .catch(err => {
      console.error(err);
      alert('Network or server error when updating offer.');
    });
  });
});
</script>


</body>
</html>
