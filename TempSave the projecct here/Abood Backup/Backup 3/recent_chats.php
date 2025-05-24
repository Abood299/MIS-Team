<?php
// recent_chats.php
session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: user_login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recent Chats</title>

  <!-- Bootstrap 5 CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet">

  <?php $version = filemtime(__DIR__ . '/css/header-footer.css'); ?>
  <link rel="stylesheet" href="css/header-footer.css?v=<?= $version ?>">

  <style>
    .chat-list .list-group-item {
      transition: background-color 0.2s, box-shadow 0.2s;
    }
    .chat-list .list-group-item:hover {
      background-color: #EC522D;
      box-shadow: 0 4px 14px rgba(0,0,0,0.1);
      cursor: pointer;
    }
    .avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 1rem;
    }
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .page-content {
      flex: 1 0 auto;
    }
  </style>
</head>
<?php include __DIR__ . '/includes/header.php'; ?>
<body class="bg-light">
<main class="page-content">
  <div class="container py-5">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Chats</h5>
        <div>
          <button id="refresh-chats" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-clockwise"></i>
          </button>
          <button id="delete-selected" class="btn btn-outline-danger btn-sm" disabled>
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div id="chat-list"
             class="list-group list-group-flush chat-list overflow-auto"
             style="max-height: 500px;">
          <!-- JS will inject chat items here -->
        </div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const listEl     = document.getElementById('chat-list');
  const refreshBtn = document.getElementById('refresh-chats');
  const deleteBtn  = document.getElementById('delete-selected');

  async function loadChats() {
    listEl.innerHTML = '<p class="text-center py-4 text-muted">Loading…</p>';
    try {
     const res = await fetch('chats_list.php');
      if (!res.ok) throw new Error('Network response was not ok');
      const chats = await res.json();

      if (!Array.isArray(chats) || chats.length === 0) {
        listEl.innerHTML = `
          <p class="text-center py-4 text-muted">
            No recent chats.
          </p>`;
        deleteBtn.disabled = true;
        return;
      }

      listEl.innerHTML = '';
      chats.forEach(c => {
        const item = document.createElement('div');
        item.className = 'list-group-item border-0 d-flex align-items-center px-4 py-3';

        const chk = document.createElement('input');
        chk.type            = 'checkbox';
        chk.className       = 'form-check-input me-3 chat-checkbox';
        chk.dataset.conversationId = c.conversation_id;
        item.appendChild(chk);

        const a = document.createElement('a');
        a.href      = `chat.php?conversation_id=${c.conversation_id}`;
        a.className = 'flex-grow-1 d-flex align-items-center text-decoration-none text-reset';

        const avatar = 'https://img.freepik.com/premium-vector/user-icons-includes-user-icons-people-icons-symbols-premiumquality-graphic-design-elements_981536-526.jpg';
        const dt     = new Date(c.last_message_time);
        const time   = dt.toLocaleTimeString([], { hour:'2-digit', minute:'2-digit' });

        a.innerHTML = `
          <img src="${avatar}" alt="Avatar" class="avatar">
          <div class="flex-grow-1 ms-3">
            <div class="d-flex justify-content-between align-items-center">
              <h6 class="mb-0">${c.partner_name}</h6>
              <small class="text-muted">${time}</small>
            </div>
            <p class="mb-0 text-truncate text-muted">
              ${c.last_message || ''}
            </p>
          </div>
        `;

        item.appendChild(a);
        listEl.appendChild(item);
      });

      deleteBtn.disabled = true;
    } catch (err) {
      console.error(err);
      listEl.innerHTML = `
        <p class="text-center py-4 text-danger">
          Could not load chats.
        </p>`;
      deleteBtn.disabled = true;
    }
  }

  refreshBtn.addEventListener('click', loadChats);

  listEl.addEventListener('change', e => {
    if (!e.target.matches('.chat-checkbox')) return;
    deleteBtn.disabled = !document.querySelector('.chat-checkbox:checked');
  });

  deleteBtn.addEventListener('click', () => {
    if (!confirm('Hide selected conversations?')) return;
    document.querySelectorAll('.chat-checkbox:checked')
      .forEach(cb => {
        const item = cb.closest('.list-group-item');
        if (item) item.remove();
      });
    deleteBtn.disabled = true;
  });

  // initial load
  loadChats();
});
</script>
</body>
</html>
