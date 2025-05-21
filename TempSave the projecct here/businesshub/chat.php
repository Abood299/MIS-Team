<?php
// chat.php
session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/chat_functions.php';

// 1) Get & validate conversation_id
$convId = isset($_GET['conversation_id']) ? (int)$_GET['conversation_id'] : 0;
if (!$convId) {
  echo "Conversation not specified.";
  exit;
}

// 2) Load conversation participants
$stmt = $conn->prepare("SELECT user1_id, user2_id FROM conversations WHERE id = ?");
$stmt->bind_param("i", $convId);
$stmt->execute();
$stmt->bind_result($user1, $user2);
if (!$stmt->fetch()) {
  echo "Invalid conversation.";
  exit;
}
$stmt->close();

$me = (int) $_SESSION['user_id'];
if ($me !== $user1 && $me !== $user2) {
  echo "Access denied.";
  exit;
}

// 3) Determine the “other” user
$otherId = ($me === $user1) ? $user2 : $user1;
// 4) Fetch their name
$stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
$stmt->bind_param("i", $otherId);
$stmt->execute();
$stmt->bind_result($first, $last);
$stmt->fetch();
$stmt->close();
$otherName = htmlspecialchars("$first $last", ENT_QUOTES);

// 5) Load all existing messages
try {
  $messages = fetchMessages($conn, $convId);
} catch (Exception $e) {
  die("Could not load messages: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Chat with <?= $otherName ?></title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Your header/footer CSS -->
  <?php $v = filemtime(__DIR__ . '/css/header-footer.css'); ?>
  <link rel="stylesheet" href="css/header-footer.css?v=<?= $v ?>">

  <style>
    /* --- basic chat styling --- */
    body { background:#f8f9fa; }
    .chat-card { max-width: 700px; margin:2rem auto; border-radius:.75rem; overflow:hidden; box-shadow:0 0 .75rem rgba(0,0,0,.1); }
    .chat-header, .chat-footer { background:#fff; padding:1rem; border-bottom:1px solid #e9ecef; }
    .chat-footer { border-top:1px solid #e9ecef; position:sticky; bottom:0; }
    .chat-container { height:60vh; overflow-y:auto; padding:1rem; background:#fff; }
    .message { display:flex; margin-bottom:1rem; }
    .message-left  { justify-content:flex-start; }
    .message-right { justify-content:flex-end; }
    .content { max-width:70%; padding:.75rem 1rem; border-radius:.5rem; position:relative; }
    .message-left  .content { background:#e2e3e5; border-radius:.5rem .5rem .5rem 0; }
    .message-right .content { background:#0d6efd; color:#fff; border-radius:.5rem .5rem 0 .5rem; }
    .time-stamp { font-size:.75rem; margin-top:.25rem; display:block; color:rgba(0,0,0,.5); }
    .edit-btn, .delete-btn { margin-left:.5rem; cursor:pointer; color:rgba(255,255,255,.7); }
    .message-left .edit-btn, .message-left .delete-btn { color:rgba(0,0,0,.5); }
    .edited { font-size:.7rem; color:#666; margin-left:.5rem; }
  </style>
</head>
<body>
  <?php include __DIR__ . '/includes/header.php'; ?>

  <div class="container">
    <div class="card chat-card">
      <!-- header -->
      <div class="chat-header d-flex align-items-center">
        <div class="status-dot me-2" style="width:10px;height:10px;border-radius:50%;background:#198754;"></div>
        <div>
          <h5 class="mb-0"><?= $otherName ?></h5>
          <small class="text-success">Online</small>
        </div>
      </div>

      <!-- messages -->
      <div class="chat-container" id="chatContainer">
        <?php foreach ($messages as $m): 
          $cls = $m['sender_id'] === $me ? 'message-right' : 'message-left';
          $text = htmlspecialchars($m['content'], ENT_QUOTES);
          $time = (new DateTime($m['created_at']))->format('g:i A');
        ?>
        <div class="message <?= $cls ?>" data-msg-id="<?= $m['id'] ?>" data-ts="<?= $m['created_at'] ?>">
          <div class="content">
            <?php if ($m['is_deleted']): ?>
              <em>— message deleted —</em>
            <?php else: ?>
              <div class="msg-text"><?= nl2br($text) ?></div>
              <span class="time-stamp"><?= $time ?></span>
              <?php if ($m['sender_id'] === $me): ?>
                <i class="fas fa-edit edit-btn"  data-id="<?= $m['id'] ?>" title="Edit"></i>
                <i class="fas fa-trash delete-btn" data-id="<?= $m['id'] ?>" title="Delete"></i>
              <?php endif; ?>
              <?php if ($m['edited_at']): ?>
                <small class="edited">(edited)</small>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- footer / input -->
      <div class="chat-footer">
        <div class="input-group">
          <input type="text" id="messageInput" class="form-control" placeholder="Type a message…" autocomplete="off">
          <button id="sendBtn" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php include __DIR__ . '/includes/footer.php'; ?>

  <!-- Bootstrap JS + FontAwesome -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>

  <script>
  const me       = <?= $me ?>;
  const convId   = <?= $convId ?>;
  const chatBox  = document.getElementById('chatContainer');
  const msgInput = document.getElementById('messageInput');
  const sendBtn  = document.getElementById('sendBtn');
  let lastTs     = chatBox.lastElementChild?.dataset.ts || null;

  // alias for clarity
  const loadMessages = poll;

  // append a new message bubble
  function appendMessage(m) {
    const cls   = m.sender_id === me ? 'message-right' : 'message-left';
    const div   = document.createElement('div');
    const dt    = new Date(m.created_at);
    let hours   = dt.getHours(), ampm = hours >= 12 ? 'PM' : 'AM';
    hours      = hours % 12 || 12;
    const mins  = String(dt.getMinutes()).padStart(2, '0');
    const time  = `${hours}:${mins} ${ampm}`;

    div.className     = 'message ' + cls;
    div.dataset.msgId = m.id;
    div.dataset.ts    = m.created_at;

    let html = '';
    if (m.is_deleted) {
      html = `<div class="content"><em>— message deleted —</em></div>`;
    } else {
      html = `
        <div class="content">
          <div class="msg-text">${m.content.replace(/\n/g,'<br>')}</div>
          <span class="time-stamp">${time}</span>
          ${m.sender_id === me ? `
            <i class="fas fa-edit edit-btn"  data-id="${m.id}" title="Edit"></i>
            <i class="fas fa-trash delete-btn" data-id="${m.id}" title="Delete"></i>
          ` : ''}
          ${m.edited_at ? '<small class="edited">(edited)</small>' : ''}
        </div>
      `;
    }
    div.innerHTML = html;
    chatBox.append(div);
    chatBox.scrollTop = chatBox.scrollHeight;
  }

  // send a message
sendBtn.addEventListener('click', async () => {
  const text = msgInput.value.trim();
  if (!text) return;

  const res  = await fetch('sendMessage.php', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `conversation_id=${convId}&message=${encodeURIComponent(text)}`
  });
  const json = await res.json();

  if (json.status === 'ok') {
    // 1) Append your own message immediately
    appendMessage({
      id:          json.message_id,
      sender_id:   me,
      content:     text,
      created_at:  json.created_at,
      edited_at:   null,
      is_deleted:  0
    });
    // 2) Clear input and advance lastTs so poll won’t re-append it
    msgInput.value = '';
    lastTs = json.created_at;
  } else {
    alert('Send failed: ' + json.error);
  }
});
// 3) allow Enter to send
msgInput.addEventListener('keydown', e => {
  if (e.key === 'Enter' && !e.shiftKey) {
    e.preventDefault();   // don’t insert a newline
    sendBtn.click();      // fire your send logic
  }
});

  // poll for new/edited/deleted messages
  async function poll() {
    let url = `fetchMessages.php?conversation_id=${convId}`;
    if (lastTs) url += `&after=${encodeURIComponent(lastTs)}`;

    const res  = await fetch(url);
    const msgs = await res.json();
    msgs.forEach(m => {
      const existing = chatBox.querySelector(`[data-msg-id="${m.id}"]`);
      if (existing) {
        // update delete/edit in place
        if (m.is_deleted) {
          existing.querySelector('.content').innerHTML = '<em>— message deleted —</em>';
        } else if (m.edited_at) {
          const c = existing.querySelector('.content');
          c.querySelector('.msg-text').innerHTML = m.content.replace(/\n/g,'<br>');
          if (!c.querySelector('.edited')) {
            c.insertAdjacentHTML('beforeend','<small class="edited">(edited)</small>');
          }
        }
      } else {
        appendMessage(m);
      }
      lastTs = m.created_at;
    });
  }

  // edit & delete handlers
  document.body.addEventListener('click', e => {
    if (e.target.matches('.delete-btn')) {
      const id = e.target.dataset.id;
      if (!confirm('Delete this message?')) return;
      fetch('deleteMessage.php', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`message_id=${id}`
      }).then(poll);
    }

    if (e.target.matches('.edit-btn')) {
      const id        = e.target.dataset.id;
      const contentEl = document.querySelector(`[data-msg-id="${id}"] .msg-text`);
      const original  = contentEl.innerText;
      const input     = document.createElement('input');
      input.type      = 'text';
      input.value     = original;
      input.className = 'form-control';
      contentEl.replaceWith(input);
      input.focus();
      input.addEventListener('blur', async () => {
        const updated = input.value.trim();
        if (updated && updated !== original) {
          await fetch('editMessage.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:`message_id=${id}&new_content=${encodeURIComponent(updated)}`
          });
        }
        poll();
      }, { once:true });
    }
  });

  // start polling
  setInterval(poll, 3000);
  poll();
  </script>
</body>
</html>
