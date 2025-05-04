<?php 
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// make sure $conn is available for the bell-count query
require_once 'includes/db.php';

// only fetch counts & panels when logged in
$unread = 0;
$panelNotes = [];
if (isset($_SESSION['user_id'])) {
  $uid = $_SESSION['user_id'];

  // 1) unread count
  $stmt = $conn->prepare("
    SELECT COUNT(*) AS cnt
      FROM notifications
     WHERE receiver_id = ?
       AND is_read = 0
  ");
  $stmt->bind_param("i", $uid);
  $stmt->execute();
  $unread = (int)$stmt->get_result()->fetch_assoc()['cnt'];

  // 2) latest 5 notifications for offcanvas panel
// After – added action_id
$panelStmt = $conn->prepare("
  SELECT id,
         action_id,
         message,
         type,
         is_read,
         created_at
    FROM notifications
   WHERE receiver_id = ?
   ORDER BY created_at DESC
   LIMIT 5
");

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
        <a href="MIS.php">نظم المعلومات الإدارية</a>
        <a href="BUS.php">إدارة الأعمال</a>
        <a href="ECO.php">اقتصاد الأعمال</a>
        <a href="PBUS.php">الإدارة العامة</a>
        <a href="FNC.php">التمويل</a>
        <a href="MKT.php">التسويق</a>
        <a href="ACC.php">المحاسبة</a>
      </div>
    </div>
    <a href="AcademicStaff.php">أعضاء هيئة التدريس</a>
    <a href="halls.php">القاعات</a>
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
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <!-- 👇 Replace the empty body you currently have with this: 👇 -->
    <?php if (empty($panelNotes)): ?>
      <p class="text-muted">No notifications.</p>
    <?php else: ?>
      <ul class="list-group">
        <?php foreach($panelNotes as $n): ?>
          <li class="list-group-item d-flex justify-content-between align-items-start <?= $n['is_read']?'':'list-group-item-warning' ?>">
            <div>
              <small class="text-muted"><?= date('M j, H:i', strtotime($n['created_at'])) ?></small><br>
              <?= htmlspecialchars($n['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>

            <?php if ($n['type']==='book_request' && !empty($n['action_id'])): ?>
              <div class="btn-group btn-group-sm">
                <button
                  type="button"
                  class="btn btn-success accept-request"
                  data-request-id="<?= (int)$n['action_id'] ?>"
                >Accept</button>
                <button
                  type="button"
                  class="btn btn-danger reject-request"
                  data-request-id="<?= (int)$n['action_id'] ?>"
                >Reject</button>
              </div>
            <?php endif; ?>

          </li>
        <?php endforeach; ?>
      </ul>
      <hr>
      <a href="notifications.php">See all notifications…</a>
    <?php endif; ?>
  </div>
</div>


<!--
  JS: wires up Accept → chat.php and Reject → reject_request.php
  Make sure you’ve included Bootstrap’s bundle.js (for the offcanvas),
  then place this snippet just before your closing </body> tag.
-->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1) Accept buttons → go to chat page
  document.querySelectorAll('.accept-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const reqId = btn.dataset.requestId;
      window.location.href = `chat.php?request_id=${reqId}`;
    });
  });

  // 2) Reject buttons → AJAX, then remove from panel
  document.querySelectorAll('.reject-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const reqId = btn.dataset.requestId;
      if (!confirm('Reject this request?')) return;

      fetch('reject_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `request_id=${reqId}`
      })
      .then(r => r.json())
      .then(data => {
        if (data.status === 'ok') {
          btn.closest('li').remove();
        } else {
          alert('Could not reject: ' + (data.error||data.status));
        }
      })
      .catch(() => {
        alert('Network error rejecting request');
      });
    });
  });
});
</script>

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
    <a href="halls.php">القاعات</a>
    <a href="MIS.php">الأقسام</a>
    <a href="booksexchange.php">تبادل الكتب</a>
    <a href="AcademicStaff.php">هيئة التدريس</a>
    <a href="GPA.php">حساب المعدل التراكمي</a>
    <a href="GraduateReq.php">متطلبات التخرج</a>

    <!-- Note: we do NOT include the bell here in mobile -->
    <!-- Remove any <a class="mobile-notif">…</a> you had before -->

    <div class="mobile-auth">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="mobile-signout">Sign Out</a>
      <?php else: ?>
        <a href="user_login.php" class="mobile-signin">Sign In</a>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
function toggleSearchPopup() {
  document.querySelector('.search-popup-header')?.classList.toggle('active');
}
document.addEventListener("DOMContentLoaded", () => {
  const searchIcon = document.querySelector(".search-icon");
  const searchPopup = document.querySelector(".search-popup-header");
  const closeSearch = document.querySelector(".search-close-btn-header");
  const container   = document.querySelector(".search-container-header");

  searchIcon?.addEventListener("click", () => searchPopup.classList.toggle("active"));
  closeSearch?.addEventListener("click", () => searchPopup.classList.remove("active"));
  searchPopup?.addEventListener("click", e => {
    if (!container.contains(e.target)) searchPopup.classList.remove("active");
  });
  document.addEventListener("keydown", e => {
    if (e.key==="Escape" && searchPopup.classList.contains("active")) {
      searchPopup.classList.remove("active");
    }
  });

  document.querySelector('.burger-menu')?.addEventListener('click', () => {
    document.querySelector('.menu-overlay')?.classList.add('active');
  });
  document.querySelector('.close-btn-gry')?.addEventListener('click', () => {
    document.querySelector('.menu-overlay')?.classList.remove('active');
  });
});
</script>

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

</style>
