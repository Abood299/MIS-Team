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

  <style>
    .chat-list .list-group-item {
      transition: background-color 0.2s, box-shadow 0.2s;
    }
    .chat-list .list-group-item:hover {
      background-color: #f8f9fa;
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
  </style>
</head>
<body class="bg-light">

  <div class="container py-5">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Chats</h5>
        <button id="refresh-chats" class="btn btn-outline-secondary btn-sm">
          <i class="bi bi-arrow-clockwise"></i>
        </button>
      </div>
      <div class="card-body p-0">
        <div id="chat-list"
             class="list-group list-group-flush chat-list overflow-auto"
             style="max-height: 500px;">
          <!-- JavaScript will inject chat items here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap + dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const listEl     = document.getElementById('chat-list');
    const refreshBtn = document.getElementById('refresh-chats');

    async function loadChats() {
      // show loading placeholder
      listEl.innerHTML = '<p class="text-center py-4 text-muted">Loading…</p>';
      try {
        // ← fetch from your PHP list‐endpoint
        const res = await fetch('/businesshub/chats_list.php');
        if (!res.ok) throw new Error('Network response was not ok');
        const chats = await res.json();

        // no chats?
        if (!Array.isArray(chats) || chats.length === 0) {
          listEl.innerHTML = `
            <p class="text-center py-4 text-muted">
              No recent chats.
            </p>`;
          return;
        }

        // clear and populate
        listEl.innerHTML = '';
        chats.forEach(c => {
          const a = document.createElement('a');
          a.href      = `chat.php?chat_id=${c.chat_id}`;
          a.className = 
            'list-group-item list-group-item-action d-flex align-items-center px-4 py-3 border-0';

          // fallback avatar
          const avatar = c.avatar_url || 
            'https://img.freepik.com/premium-vector/user-icons-includes-user-icons-people-icons-symbols-premiumquality-graphic-design-elements_981536-526.jpg';

          // format time
          const dt = new Date(c.last_ts);
          const time = dt.toLocaleTimeString([], {
            hour:   '2-digit',
            minute: '2-digit'
          });

          // show unread badge
          const badge = c.unread_count > 0
            ? `<span class="badge bg-danger ms-3">${c.unread_count}</span>`
            : '';

          a.innerHTML = `
            <img src="${avatar}" alt="Avatar" class="avatar">
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">${c.first_name} ${c.last_name}</h6>
                <small class="text-muted">${time}</small>
              </div>
              <p class="mb-0 text-truncate text-muted">
                ${c.preview_text || ''}
              </p>
            </div>
            ${badge}
          `;
          listEl.appendChild(a);
        });
      } catch (err) {
        console.error(err);
        listEl.innerHTML = `
          <p class="text-center py-4 text-danger">
            Could not load chats.
          </p>`;
      }
    }

    // wire up manual refresh
    refreshBtn.addEventListener('click', loadChats);

    // initial load on page load
    loadChats();
  });
  </script>
</body>
</html>
