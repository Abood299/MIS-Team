<?php 
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/db.php';

// only fetch counts & panels when logged in
$unread = 0;
$panelNotes = [];
if (isset($_SESSION['user_id'])) {
  $uid = $_SESSION['user_id'];
  // 1) unread count matches exactly what shows in panel
  $stmt = $conn->prepare(
    "SELECT COUNT(*) AS cnt
      FROM notifications n
      LEFT JOIN book_requests br
        ON n.type = 'book_request'
       AND br.id = n.action_id
     WHERE n.receiver_id = ?
       AND n.is_read = 0
       AND n.is_deleted = 0
       AND (n.type != 'book_request' OR br.status = 'pending')"
  );
  $stmt->bind_param("i", $uid);
  $stmt->execute();
  $unread = (int)$stmt->get_result()->fetch_assoc()['cnt'];
  // 2) latest 5 notifications for offcanvas panel
  $panelStmt = $conn->prepare(
    "SELECT
      n.id,
      n.message,
      n.type,
      n.is_read,
      n.created_at,
      n.action_id,
      c.id AS chat_session_id,       -- pull the chat PK for linking
      br.status AS request_status    -- existing join
    FROM notifications AS n
    LEFT JOIN book_requests AS br
      ON n.type = 'book_request'
     AND br.id    = n.action_id
    LEFT JOIN chats AS c
      ON c.request_id = n.action_id
    WHERE n.receiver_id = ?
      AND n.is_deleted  = 0          -- skip soft-deleted
    ORDER BY n.created_at DESC
    LIMIT 5"
  );
  $panelStmt->bind_param("i", $uid);
  $panelStmt->execute();
  $panelNotes = $panelStmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<header class="navbar">
  <div class="logo-container">
    <a href="HomePage.php">
      <img src="images/3d-logo2.png" alt="Business Hub Logo" class="logo">
    </a>
    <a href="HomePage.php" class="brand-text">
      <span class="business-text">Business</span>
      <span class="hub-text">Hub</span>
    </a>
  </div>

  <nav class="nav-links">
    <div class="dropdown">
      <button class="dropbtn">
        الأقسام <i class="fas fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="departments/MIS.php">نظم المعلومات الإدارية</a>
        <a href="departments/BUS.php">إدارة الأعمال</a>
        <a href="departments/ECO.php">اقتصاد الأعمال</a>
        <a href="departments/PBUS.php">الإدارة العامة</a>
        <a href="departments/FNC.php">التمويل</a>
        <a href="departments/MKT.php">التسويق</a>
        <a href="departments/ACC.php">المحاسبة</a>
      </div>
    </div>
    <a href="front/AcademicStaff.php">أعضاء هيئة التدريس</a>
    <a href="front/halls.php">القاعات</a>
    <a href="booksexchange.php">تبادل الكتب</a>
  </nav>

  <div class="icons">
    <?php if (isset($_SESSION['user_id'])): ?>
      <span class="nav-link welcome-text">
        Welcome <?= htmlspecialchars($_SESSION['first_name']) ?>
      </span>

      <!-- Bell button opens offcanvas panel -->
      <button class="btn notification-icon" 
              type="button"
              data-bs-toggle="offcanvas" 
              data-bs-target="#notifPanel"
              aria-controls="notifPanel"
              title="Notifications">
        <i class="fas fa-bell"></i>
        <?php if ($unread): ?>
          <span class="notif-badge"><?= $unread ?></span>
        <?php endif; ?>
      </button>
    <?php endif; ?>

    <!-- search & burger toggles -->
    <i class="fas fa-search search-icon" onclick="toggleSearchPopup()"></i>
    <i class="fas fa-bars burger-menu"></i>

    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="logout.php" class="sign-in">Sign Out</a>
    <?php else: ?>
      <a href="user_login.php" class="sign-in">Sign In</a>
    <?php endif; ?>
  </div>
</header>
<!-- offcanvas notifications panel -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="notifPanel" aria-labelledby="notifPanelLabel">
  <div class="offcanvas-header">
    <h5 id="notifPanelLabel">Notifications</h5>

    <!-- Recent Chats button now just redirects -->
    <button id="show-recent-chats"
            class="btn btn-sm btn-secondary me-2"
            title="Recent Chats">
      <i class="fas fa-comments"></i>
    </button>

    <!-- Clear All notifications -->
    <button id="clear-all-notifs"
            class="btn btn-sm btn-danger me-2"
            title="Clear All">
      <i class="fas fa-trash-alt"></i>
    </button>

    <button type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <?php if (empty($panelNotes)): ?>
      <p class="text-muted">No notifications.</p>
    <?php else: ?>
      <ul class="list-group">
        <?php foreach($panelNotes as $n):
          // skip stale book_request notifications
          if ($n['type']==='book_request'
           && (!isset($n['request_status']) || $n['request_status']!=='pending')
          ) continue;

          $type   = $n['type'];
          $chatId = (int)($n['chat_session_id'] ?? 0);
        ?>
        <li
        class="list-group-item d-flex justify-content-between align-items-start
              <?= $n['is_read'] ? '' : 'list-group-item-warning' ?>
              <?php if ($type!=='book_request' && $chatId) echo ' clickable'; ?>"
        <?php if ($type!=='book_request' && $chatId): ?>
          style="cursor:pointer"
          data-chat-id="<?= $chatId ?>"
          onclick="window.location='chat.php?chat_id='+this.dataset.chatId;"
        <?php endif; ?>
        >
          <div class="flex-grow-1">
            <small class="text-muted">
              <?= date('M j, H:i', strtotime($n['created_at'])) ?>
            </small><br>
            <?= htmlspecialchars($n['message'], ENT_QUOTES, 'UTF-8') ?>
          </div>

          <?php if ($type === 'book_request'): ?>
          <div class="btn-group btn-group-sm ms-2">
            <button type="button"
                    class="btn btn-success accept-request"
                    data-request-id="<?= (int)$n['action_id'] ?>">
              Accept
            </button>
            <button type="button"
                    class="btn btn-danger reject-request"
                    data-request-id="<?= (int)$n['action_id'] ?>">
              Reject
            </button>
          </div>
          <?php endif; ?>

          <button type="button"
                  class="btn btn-sm btn-outline-danger delete-notif ms-2"
                  data-notif-id="<?= (int)$n['id'] ?>"
                  title="Delete"
                  onclick="event.stopPropagation();">
            &times;
          </button>
        </li>
        <?php endforeach; ?>
      </ul>
      <hr>
 
    <?php endif; ?>
  </div>
</div>





<!-- Search Bar Popup -->
<div class="search-popup-header">
  <div class="search-container-header">
    <input type="text" class="search-input-header" placeholder="Search...">
    <button class="search-close-btn-header"><i class="fas fa-times"></i></button>
  </div>
</div>

<!-- Grey Overlay Menu -->
<div class="menu-overlay">
  <div class="menu-logo">
    <a href="HomePage.php">
      <img src="images/logo.png" alt="Business Hub Logo">
    </a>
    <a href="HomePage.php" class="brand-text">
      <span class="business-text">Business</span>
      <span class="hub-text">Hub</span>
    </a>
  </div>
  <button class="close-btn-gry"><i class="fas fa-times"></i></button>

  <div class="menu-links">
    <a href="front/halls.php">القاعات</a>
    <a href="booksexchange.php">تبادل الكتب</a>
    <a href="front/AcademicStaff.php">هيئة التدريس</a>
    <a href="front/GPA.php">حساب المعدل التراكمي</a>
    <a href="front/GraduateReq.php">متطلبات التخرج</a>

    <!-- Note: we do NOT include the bell here in mobile -->
 

    <div class="mobile-auth">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="mobile-signout">Sign Out</a>
      <?php else: ?>
        <a href="user_login.php" class="mobile-signin">Sign In</a>
      <?php endif; ?>
    </div>
  </div>
</div>


<style>
/* ─── Desktop header ───────────────────────────────────────────────────────── */
.icons {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.welcome-text {
  margin-right: auto;
  color: #ffffff93;
}
.notification-icon {
  position: relative;
  color: #fff;
  font-size: 1.2rem;
  margin-right: .5rem;
}
.notification-icon:hover {
  color: #ddd;
}
.notif-badge {
  position: absolute;
  top: -4px; right: -4px;
  background: #e74c3c; color: #fff;
  font-size: .65rem; padding: 2px 5px;
  border-radius: 50%;
}
.sign-in {
  margin-left: .5rem;
}

/* ─── Mobile overlay ───────────────────────────────────────────────────────── */
.menu-links .mobile-notif {
  /* removed – bell not here */
}
.brand-text { text-decoration: none; color: #fff; display: flex; }
.business-text { font-weight: 600; }
.hub-text { font-weight: 300; margin-left: 0.25rem; }


/* welcome text pushes others right */
.welcome-text { margin-right: auto; color: #fff8; }

/* bell + badge */
.notification-icon {
  position: relative;
  background: none; border: none; color: #fff; font-size: 1.2rem;
}
.notif-badge {
  position: absolute; top: -4px; right: -4px;
  background: #e74c3c; color: #fff;
  font-size: .65rem; padding: 2px 5px; border-radius: 50%;
}
/* Hover effect for clickable notifications */
.list-group-item.clickable:hover {
  background-color: #f0f8ff;    /* or whatever highlight color you prefer */
}
</style>
