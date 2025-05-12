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
$v = $conn->prepare(
    "SELECT user1_id, user2_id FROM chats WHERE id = ? AND (user1_id = ? OR user2_id = ?)"
);
$v->bind_param('iii', $chatId, $me, $me);
$v->execute();
$chatInfo = $v->get_result()->fetch_assoc();
if (!$chatInfo) {
    die("Access denied.");
}

// 5) Determine the other user
$user1 = (int)$chatInfo['user1_id'];
$user2 = (int)$chatInfo['user2_id'];
$otherId = ($user1 === $me) ? $user2 : $user1;

$stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
$stmt->bind_param('i', $otherId);
$stmt->execute();
$userRow = $stmt->get_result()->fetch_assoc();
$otherName = htmlspecialchars(
    $userRow['first_name'] . ' ' . $userRow['last_name'], ENT_QUOTES, 'UTF-8'
);

// 6) Fetch messages
$msgStmt = $conn->prepare(
    "SELECT
      m.id,
      m.sender_id,
      m.message,
      m.timestamp,
      m.is_deleted,
      m.is_edited
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
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
     <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
  <style>
        body { background-color: #f8f9fa; }
      .chat-card { max-width: 700px; margin: auto; border: none; border-radius: .75rem; overflow: hidden; box-shadow: 0 0 .75rem rgba(0,0,0,.1); }
    .chat-header { background-color: #fff; padding: 1rem; border-bottom: 1px solid #e9ecef; }
    .status-dot { width: 10px; height: 10px; background-color: #198754; border-radius: 50%; display:inline-block; margin-right:.5rem; }
    .chat-container { height: 60vh; overflow-y: auto; padding: 1rem; background-color: #fff; }
    .message { display: flex; margin-bottom: 1rem; position: relative; }
    [data-msg-id] { position: relative; }
    .message-left .content { background-color: #e2e3e5; color: #212529; border-radius: .5rem .5rem .5rem 0; padding: .75rem 1rem; }
    .message-right { flex-direction: row-reverse; align-items: flex-end; }
    .message-right .content { background-color: #0d6efd; color: #fff; border-radius: .5rem .5rem 0 .5rem; padding: .75rem 1rem; }
    .time-stamp { font-size: .75rem; margin-top: .25rem; display: block; }
    .delete-btn, .edit-btn { font-size: .9rem; margin-left: .5rem; cursor: pointer;   color:rgb(189, 187, 187);        /* ← white icons */ }
    .delete-btn:hover, .edit-btn:hover { color: #000; }
    .edited { font-size: .7rem; color: #666; margin-left:.5rem; }
    .chat-footer { background-color: #fff; padding: .75rem 1rem; border-top: 1px solid #e9ecef; position: sticky; bottom: 0; }
    .chat-footer .form-control { border-radius: .75rem 0 0 .75rem; }
    .chat-footer .btn { border-radius: 0 .75rem .75rem 0; }
  </style>
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>


<div class="container py-4">
  <div class="card chat-card">
<!-- Header -->
<div class="chat-header d-flex align-items-center">
  <div class="status-dot"></div>
  <div>
    <h5 class="mb-0"><?= $otherName ?></h5>
    <small class="text-success">Online</small>
  </div>
  <div class="ms-auto">
    <?php if (
      isset($offerId)
      && $offerId
      && $me === $chatInfo['user1_id']
      && isset($offerStatus)
      && $offerStatus === 'active'
    ): ?>
      <button
        id="deleteOfferBtn"
        class="btn btn-warning btn-sm"
        data-offer-id="<?= $offerId ?>"
      >
        We’ve dealt – delete my offer
      </button>
    <?php endif; ?>
  </div>
</div>


     <!-- Messages -->
    <div class="chat-container" id="chatContainer">
      <?php while ($msg = $messages->fetch_assoc()):
        $cls = ((int)$msg['sender_id'] === $me) ? 'message-right' : 'message-left';
        $text = nl2br(htmlspecialchars($msg['message'], ENT_QUOTES, 'UTF-8'));
        $ts   = htmlspecialchars($msg['timestamp'], ENT_QUOTES);
   // 12-hour, no leading zero on hour, uppercase AM/PM
$time = (new DateTime($msg['timestamp']))->format('g:i A');
      ?>
      <div class="message <?= $cls ?>" data-msg-id="<?= $msg['id'] ?>">
      <div class="content">
      <div class="msg-text"><?= $text ?></div>
      <span class="time-stamp"><?= $time ?></span>
      <?php if ((int)$msg['sender_id'] === $me): ?>
        <i class="fas fa-edit edit-btn" data-id="<?= $msg['id'] ?>" title="Edit"></i>
        <i class="fas fa-trash delete-btn" data-id="<?= $msg['id'] ?>" title="Delete"></i>
      <?php endif; ?>
      <?php if ($msg['is_edited']): ?>
        <small class="edited">(edited)</small>
      <?php endif; ?>
    </div>
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
<?php include __DIR__ . '/includes/footer.php'; ?>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Auto-scroll to the latest message on load
  const chatContainer = document.getElementById('chatContainer');
  if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;

  // Initialize polling
  const chatId = <?= $chatId ?>;
  const lastEl = document.querySelector('#chatContainer .message:last-child');
  let lastTs = lastEl ? lastEl.getAttribute('data-ts') : null;

  // Append a brand-new message element
  function appendMessage(m) {
    const cls = m.sender_id === <?= $me ?> ? 'message-right' : 'message-left';
    const div = document.createElement('div');
    div.className = 'message ' + cls;
    div.setAttribute('data-msg-id', m.id);
    div.setAttribute('data-ts', m.timestamp);

    if (m.is_deleted) {
      div.innerHTML = `<div class="content"><em>— message deleted —</em></div>`;
    } else {
      const safeText = m.message.replace(/\n/g,'<br>');
      const dt = new Date(m.timestamp);
      let hours = dt.getHours();
      const minutes = String(dt.getMinutes()).padStart(2,'0');
      const ampm   = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12 || 12;  // convert 0→12, 13→1, etc.
      const timeStr = `${hours}:${minutes} ${ampm}`;

      let icons = '';
      if (m.sender_id === <?= $me ?>) {
        icons = `
          <i class="fas fa-edit edit-btn" data-id="${m.id}" title="Edit"></i>
          <i class="fas fa-trash delete-btn" data-id="${m.id}" title="Delete"></i>
        `;
      }

      const editedFlag = m.is_edited ? '<small class="edited">(edited)</small>' : '';

      div.innerHTML = `
        <div class="content">
          <div class="msg-text">${safeText}</div>
          <span class="time-stamp">${timeStr}</span>
          ${icons}
          ${editedFlag}
        </div>
      `;
    }

    chatContainer.appendChild(div);
  }

  // Fetch new and updated messages
  function fetchNew() {
    let url = `get_messages.php?chat_id=${chatId}`;
    if (lastTs) url += `&after=${encodeURIComponent(lastTs)}`;

    fetch(url)
      .then(r => r.ok ? r.json() : Promise.reject(`HTTP ${r.status}`))
      .then(msgs => {
        msgs.forEach(m => {
          const existing = document.querySelector(`[data-msg-id="${m.id}"]`);
          if (existing) {
            // update deletion
            if (m.is_deleted) {
              existing.querySelector('.content').innerHTML = '<em>— message deleted —</em>';
            }
            // update edit
            else if (m.is_edited) {
              const contentEl = existing.querySelector('.content');
              const textDiv = contentEl.querySelector('.msg-text');
              textDiv.innerHTML = m.message.replace(/\n/g,'<br>');
              if (!contentEl.querySelector('.edited')) {
                const flag = document.createElement('small');
                flag.className = 'edited';
                flag.textContent = '(edited)';
                contentEl.append(flag);
              }
            }
          } else {
            // new message
            appendMessage(m);
          }
          lastTs = m.timestamp;
        });

        // keep scroll at bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
      })
      .catch(console.error);
  }

  // Poll every 3 seconds & run once immediately
  setInterval(fetchNew, 3000);
  fetchNew();
</script>


</script>

<!-- Delete & Edit Message Logic -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const chatContainer = document.getElementById('chatContainer');

  chatContainer.addEventListener('click', e => {
    // Delete
    if (e.target.matches('.delete-btn')) {
      const id = e.target.dataset.id;
      if (!confirm('Delete this message?')) return;
      fetch('delete_message.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: `message_id=${id}`
      })
      .then(r => r.json())
      .then(json => {
        if (json.status === 'ok') {
          const msg = document.querySelector(`[data-msg-id="${id}"] .content`);
          msg.innerHTML = '<em>— message deleted —</em>';
        } else alert(json.message || 'Delete failed');
      });
      return;
    }

 // ——— Edit message inline ———
if (e.target.matches('.edit-btn')) {
  const id        = e.target.dataset.id;
  const contentEl = document.querySelector(`[data-msg-id="${id}"] .content`);
  const textDiv   = contentEl.querySelector('.msg-text');
  const original  = textDiv.innerText.trim();

  // swap in an <input> just for the text
  textDiv.innerHTML = `<input type="text" class="form-control edit-input" value="${original}">`;
  const input = textDiv.querySelector('input');
  input.focus();

  // ——— NEW: pressing Enter commits the edit by blurring ———
  input.addEventListener('keydown', evt => {
    if (evt.key === 'Enter') {
      evt.preventDefault();
      input.blur();
    }
  });

  // existing blur-based save logic
  input.addEventListener('blur', () => {
    const updated = input.value.trim();

    if (updated && updated !== original) {
      fetch('edit_message.php', {
        method: 'POST',
        headers:{ 'Content-Type':'application/x-www-form-urlencoded' },
        body: `message_id=${id}&new_message=${encodeURIComponent(updated)}`
      })
      .then(r => r.json())
      .then(json => {
        if (json.status === 'ok') {
          // restore the text
          textDiv.innerHTML = updated;

          // re-insert the "(edited)" flag if not already there
          if (!contentEl.querySelector('.edited')) {
            const flag = document.createElement('small');
            flag.className = 'edited';
            flag.textContent = '(edited)';
            contentEl.append(flag);
          }
        } else {
          textDiv.textContent = original;
          alert(json.message || 'Edit failed');
        }
      });
    } else {
      // no change: put the original text back
      textDiv.textContent = original;
    }
  }, { once: true });

  return;
}


  });
});
</script>

</body>
</html>
