<?php  
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// at the top of header.php, or wherever you can safely require the model
require_once __DIR__ . '/../includes/model/academicStaffModel.php';
$staffList = getAllAcademicStaff();
require_once __DIR__ . '/db.php';

// 🔴
 require_once $_SERVER['DOCUMENT_ROOT'] . '/businesshub/includes/db.php';
 // 🔴
$unread = 0;
$panelNotes = [];

if (isset($_SESSION['user_id'])) {
  $uid = $_SESSION['user_id'];

  // 1) Unread count (requests only)
  $stmt = $conn->prepare(
    "SELECT COUNT(*) AS cnt
       FROM notifications AS n
  LEFT JOIN book_requests AS br
         ON br.id = n.action_id
        AND n.type IN ('book_request', 'swap_request')
      WHERE n.receiver_id = ?
        AND n.is_read = 0
        AND n.is_deleted = 0
        
        AND (
             n.type NOT IN ('book_request','swap_request')
             OR br.status = 'pending'
        )"
  );
  $stmt->bind_param("i", $uid);
  $stmt->execute();
  $unread = (int)$stmt->get_result()->fetch_assoc()['cnt'];
  $stmt->close();

  // 2) Latest 5 notifications (requests + accepts + messages)
  $panelStmt = $conn->prepare(
    "SELECT
       n.id,
       n.message,
       n.type,
       n.is_read,
       n.created_at,
       n.action_id,
       br.status           AS request_status,

       -- conversation for requests & request_accepted:
       c.id                AS req_chat_id,

       -- conversation for messages:
       c2.id               AS msg_chat_id,

       -- pick whichever exists:
       COALESCE(c.id, c2.id) AS chat_session_id

     FROM notifications AS n

     LEFT JOIN book_requests AS br
       ON br.id = n.action_id
      AND n.type IN ('book_request', 'swap_request')

     -- link requests & accepted requests to the related conversation
     LEFT JOIN conversations AS c
       ON c.related_request_id = n.action_id

     -- link messages to the conversation_id column
     LEFT JOIN conversations AS c2
       ON c2.id = n.conversation_id
      AND n.type = 'message'

     WHERE n.receiver_id = ?
       AND n.is_deleted = 0
     ORDER BY n.created_at DESC
     LIMIT 5"
  );
  $panelStmt->bind_param("i", $uid);
  $panelStmt->execute();
  $panelNotes = $panelStmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $panelStmt->close();
}
?>
<header class="navbar">
  <div class="logo-container">
    <a href="HomePage.php">
      <img src="images/bznz.png" alt="Business Hub Logo" class="logo" style="transform: perspective(500px) rotateY(10deg); box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);">
    </a>
    <a href="HomePage.php" class="brand-text">
<span style="font-size: 22px; font-weight: bold; color: #EC522D; margin-right: 5px; text-shadow: 0 0 12px #EC522D;">Business</span>
<span style="font-size: 22px; font-weight: bold; color: #5E2950; text-shadow: 0 0 12px #5E2950;">Hub</span>

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


 <i class="fas fa-bars burger-menu"></i>

  <!-- ← add the search icon here: -->
    <i class="fas fa-search search-icon" title="Search"></i>

    <!-- SEARCH OVERLAY (global) -->
  <form id="searchhh" action="#" method="GET">
    <div class="search-card">
      <div class="search-input-wrapper">
        <i class="fas fa-search"></i>
        <input
          id="academicSearchInput"
          type="text"
          class="search-input-header"
          placeholder="ابحث عن عضو…"
          autocomplete="off"
        />
        <div id="suggestions" class="suggestions-list"></div>
      </div>
      <button type="button" class="close-search-link">Close</button>
    </div>
  </form>

  <!-- make sure jQuery is loaded before the script below -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





    
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
          // skip stale book_request or swap_request notifications
          if (
            in_array($n['type'], ['book_request','swap_request'], true)
            && (!isset($n['request_status']) || $n['request_status'] !== 'pending')
          ) continue;

          $type   = $n['type'];
          $chatId = (int)($n['chat_session_id'] ?? 0);
        // only 'request_accepted' and 'message' should be clickable
                 $isClickable = in_array($type, ['request_accepted','message'], true) && $chatId > 0;
               
        ?>
        <li
          class="list-group-item d-flex justify-content-between align-items-start
                 <?= $n['is_read'] ? '' : 'list-group-item-warning' ?>
                 <?= $isClickable ? 'clickable' : '' ?>"
          <?= $isClickable ? "style=\"cursor:pointer\" data-chat-id=\"{$chatId}\"
                             onclick=\"window.location='chat.php?conversation_id='+this.dataset.chatId;\"" : "" ?>>
          <div class="flex-grow-1">
            <small class="text-muted">
              <?= date('M j, H:i', strtotime($n['created_at'])) ?>
            </small><br>
            <?= htmlspecialchars($n['message'], ENT_QUOTES, 'UTF-8') ?>
          </div>

          <?php if (in_array($type, ['book_request','swap_request'], true)): ?>
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



<script>// Automatically close any open offcanvas when clicking the overlay
document.querySelector('.menu-overlay')?.addEventListener('click', function () {
  // Find open offcanvas
  var openCanvas = document.querySelector('.offcanvas.show');
  if (openCanvas) {
    // Hide the canvas
    bootstrap.Offcanvas.getInstance(openCanvas)?.hide();
  }
  // Hide the overlay
  this.style.display = 'none';
});
</script>



<!-- Grey Overlay Menu -->
<div class="menu-overlay">
  <div class="menu-logo">
    <a href="HomePage.php">
      <img src="images/logo.png" alt="Business Hub Logo">
    </a>
    <a href="HomePage.php" class="brand-text">
  <span style="font-size: 22px; font-weight: bold; color: #EC522D; margin-right: 5px; text-shadow: 0 0 10px #EC522D;">Business</span>
  <span style="font-size: 22px; font-weight: bold; color: #5E2950; text-shadow: 0 0 10px #5E2950;">Hub</span>

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

/* ─── Search Overlay Styling ───────────────────────────────────────────────── */
/* ─── Full-screen blurred overlay + centering ───────────────────────────────── */
#searchhh {
  position: fixed;
  inset: 0;
  display: none;            /* hide by default */
  background: rgba(0,0,0,0.4);
  backdrop-filter: blur(4px);
  z-index: 1000;

  /* centering only when we turn it on via JS */
  align-items: center;
  justify-content: center;
  padding: 1rem;
  box-sizing: border-box;
}

    #searchhh .search-card {
      background: #fff;
      border-radius: 8px;
      max-width: 500px;
      width: 90%;
      box-shadow: 0 8px 24px rgba(0,0,0,0.2);
      text-align: center;
    }
    /* ← this is critical for the dropdown to position under the input */
    #searchhh .search-input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      border-top: 4px solid #EC522D;
      padding: .75rem 1rem;
    }
    .search-input-header {
      flex: 1;
      border: none;
      outline: none;
      font-size: 1rem;
    }
    .close-search-link {
      margin: .5rem auto 1rem;
      background: none;
      border: none;
      text-decoration: underline;
      cursor: pointer;
    }
    .search-icon {
      color: #fff;
      font-size: 1.2rem;
      cursor: pointer;
      padding: .25rem;
    }
    .suggestions-list {
      position: absolute;
      top: 100%;
      left: 0; right: 0;
      background: #fff;
      border: 1px solid #ccc;
      max-height: 200px;
      overflow-y: auto;
      z-index: 1002;
    }
    .suggestions-list div {
      padding: .5rem 1rem;
      cursor: pointer;
    }
    .suggestions-list div:hover {
      background: #f5f5f5;
    }
@keyframes flicker {
  0%, 100% { background-color: #fff3a6 !important; }
  50%      { background-color: transparent !important; }
}

/* animated flicker; runs twice (0.5s each) */
.highlight-flicker {
  animation: flicker 0.5s ease-in-out 2;
}

/* you can leave your old static highlight rule if you ever want a non-animated highlight */
#staffTable tr.highlight {
  background-color: #fff3a6 !important;
}

</style>

 <!-- expose staff for autocomplete -->
  <script>
    window.academicStaff = <?= json_encode(
      array_map(fn($r)=>['id'=>$r['id'],'name'=>$r['name']], $staffList),
      JSON_UNESCAPED_UNICODE
    ); ?>;
  </script>

<script>
$(function(){
  var $overlay = $('#searchhh'),
      $icon    = $('.search-icon'),
      $close   = $('.close-search-link'),
      $input   = $('#academicSearchInput'),
      $list    = $('#suggestions'),
      staff    = window.academicStaff;

  $icon.click(() => $overlay.css('display','flex'));
  $close.click(() => $overlay.hide());
  $overlay.click(e => { if (e.target === e.currentTarget) $overlay.hide(); });

  $input.on('input', function(){
    var term = this.value.trim().toLowerCase();
    $list.empty();
    if (!term) return;
    staff
      .filter(s => s.name.toLowerCase().includes(term))
      .slice(0,5)
      .forEach(s => {
        $('<div>')
          .text(s.name)
          .appendTo($list)
          .click(() => {
            if (location.pathname.endsWith('AcademicStaff.php')) {
              jumpToStaff(s.id);
            } else {
              location.href = '/businesshub/front/AcademicStaff.php?highlight=' + s.id;
            }
            $overlay.hide();
          });
      });
  });

  window.jumpToStaff = function(id){
    var $row = $('#staff-' + id);
    if (!$row.length) return;
    // scroll into view
    $('html,body').animate({ scrollTop: $row.offset().top - 100 }, 300);

    // flicker animation
    $row
      .addClass('highlight-flicker')
      .one('animationend', function(){
        $row.removeClass('highlight-flicker');
      });
  };

  var params = new URLSearchParams(location.search);
  if (params.has('highlight')) jumpToStaff(params.get('highlight'));
});
</script>
