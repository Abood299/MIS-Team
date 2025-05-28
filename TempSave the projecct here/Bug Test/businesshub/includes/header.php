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
<script>
// hard‐code the same list you have in halls.php:
window.globalHalls = [
  { name: "المدرج الكبير" },
  { name: "العمادة" },
  { name: "قاعة 1" },
  { name: "المصلى الرئيسي (ذكور + إناث)" },
  { name: "مختبر المحاكاة" },
  { name: "قاعة مناقشات 4" },
  { name: "قاعة 8" },
  { name: "قاعة الندوات الاقتصاد" },
  { name: "المدرج الصغير" },
  { name: "مدرج 3" },
  { name: "مدرج 4" },
  { name: "قاعة 7" },
  { name: "قاعة 9" },
  { name: "قاعة 13" },
  { name: "قاعة 14" },
  { name: "قاعة 15" },
  { name: "مدرج 1" },
  { name: "مدرج 2" },
  { name: "قاعة 10" },
  { name: "المستودع" },
  { name: "مختبر MIS 1" },
  { name: "مختبر MIS 2" },
  { name: "قاعة الندوات اعمال 4" },
  { name: "قاعة محمود العميان" },
  { name: "قاعة المعاني" },
  { name: "قاعة 105" },
  { name: "قاعة 201" },
  { name: "قاعة 203" },
  { name: "قاعة 205" },
  { name: "قاعة 207" }
];
</script>
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
      


<?php
// ─── Activity Trigger ───────────────────────────────────────────────────────
?>
<button
  class="btn notification-icon position-relative me-2"
  type="button"
  data-bs-toggle="offcanvas"
  data-bs-target="#activityPanel"
  aria-controls="activityPanel"
  title="Active Offers & Requests"
>
  <i class="fas fa-chart-line fa-lg"></i>
  <?php if (!empty($activeCount)): ?>
    <span class="notif-badge"><?= $activeCount ?></span>
  <?php endif; ?>
</button>

<?php
// ─── Activity Offcanvas Panel ──────────────────────────────────────────────
?>
<div
  class="offcanvas offcanvas-end"
  tabindex="-1"
  id="activityPanel"
  aria-labelledby="activityPanelLabel"
>
  <div class="offcanvas-header">
    <h5 id="activityPanelLabel">Activity Center</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <h6>My Active Offers</h6>
    <ul id="activityOffersList" class="list-group mb-3">
      <li class="list-group-item text-center text-muted">Loading…</li>
    </ul>

    <h6>My Pending Requests</h6>
    <ul id="activityRequestsList" class="list-group">
      <li class="list-group-item text-center text-muted">Loading…</li>
    </ul>
  </div>
</div>

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
  <form id="searchhh" action="#" method="GET" onsubmit="return false">
    <div class="search-card">
      <div class="search-input-wrapper">
        <i class="fas fa-search"></i>
        <input
          id="academicSearchInput"
          type="text"
          class="search-input-header"
          placeholder="ابحث عن عضو هيئة تدريس أو قاعة"
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
  <!-- Activity panel trigger (replace your bell button with this) -->

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
/* ensure your entire header is a flex row, centered vertically */
header.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* make just the right-hand icon group a flex row, centered vertically */
header.navbar .icons {
  display: flex;
  align-items: center;
}

/* ─── Icon alignment ───────────────────────────────────────────────────────── */
/* ─── Icon alignment (tighter spacing) ────────────────────────────────────── */
header.navbar .icons .notification-icon,
header.navbar .icons .burger-menu,
header.navbar .icons i {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  line-height: 1;
margin: 0 0.0625rem;  /* equals 1px */
}

/* if you want a tiny overlap: */
header.navbar .icons .notification-icon + .notification-icon,  
header.navbar .icons .notification-icon + .burger-menu,
header.navbar .icons .burger-menu + .notification-icon {
  margin-left: -10px;      /* slide them 2px into each other */
}
/* target only the activity button */
.icons .notification-icon.activity {
  margin-left: -20;
}
/* ─── Burger menu ─────────────────────────────────────────────────────────── */
header.navbar .icons .burger-menu {
  font-size: 1.2rem;          /* match notification-icon size */
  cursor: pointer;
}

/* ─── Notification Icon ───────────────────────────────────────────────────── */
.notification-icon {
  position: relative;
  color: #fff;
  font-size: 1.2rem;
}
.notification-icon:hover {
  color: #ddd;
}

/* ─── Badge ───────────────────────────────────────────────────────────────── */
.notif-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  background: #e74c3c;
  color: #fff;
  font-size: 0.65rem;
  padding: 2px 5px;
  border-radius: 50%;
}

/* ─── Welcome & Sign-In ───────────────────────────────────────────────────── */
.welcome-text {
  margin-right: auto;
  color: #ffffff93;
}
.sign-in {
  margin-left: 0.5rem;
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
    z-index: 2000;            /* above everything */
  height: 100vh;       /* ← guarantee full height */
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
  // cache elements
  var $overlay = $('#searchhh'),
      $icon    = $('.search-icon'),
      $close   = $('.close-search-link'),
      $input   = $('#academicSearchInput'),
      $list    = $('#suggestions');

  // build combined list of staff + halls
  var staffItems = (window.academicStaff || [])
        .map(s => ({ id: s.id,   name: s.name, type: 'staff' })),
      hallItems  = (window.globalHalls || [])
        .map((h,i) => ({ id: i, name: h.name, type: 'hall' })),
      allItems   = staffItems.concat(hallItems);

  // 1) open/close overlay
  $icon.on('click',   () => $overlay.css('display','flex'));
  $close.on('click',  () => $overlay.hide());
  $overlay.on('click', e => {
    if (e.target === $overlay[0]) $overlay.hide();
  });

// 2) suggestions as you type
$input.on('input', function(){
  var term = this.value.trim().toLowerCase();
  $list.empty();
  if (!term) return;

  allItems
    .filter(item => item.name.toLowerCase().includes(term))
    .slice(0,5)
    .forEach(item => {
      // decide badge text
      var badgeText = item.type === 'staff' ? 'عضو' : 'قاعة';

      // build suggestion with a Bootstrap badge
      $('<div>')
        .html(`
          ${item.name}
          <span class="badge bg-secondary float-end">${badgeText}</span>
        `)
        .appendTo($list)
        .on('click', () => {
          $overlay.hide();
          if (item.type === 'staff') {
            // staff behavior
            if (location.pathname.endsWith('AcademicStaff.php')) {
              jumpToStaff(item.id);
            } else {
              location.href = '/businesshub/front/AcademicStaff.php?highlight=' + item.id;
            }
          } else {
            // hall behavior
            location.href = '/businesshub/front/halls.php?highlightHall=' 
                            + encodeURIComponent(item.name);
          }
        });
    });
});



  // 3) jumpToStaff (unchanged)
  window.jumpToStaff = function(id){
    var $rows   = $('#staffTable tbody tr'),
        $target = $('#staff-' + id);
    if (!$target.length) return;
    $('html,body').animate({ scrollTop: $target.offset().top - 100 }, 300);
    $rows.addClass('dimmed');
    $target.removeClass('dimmed').addClass('focused');
    setTimeout(()=> $rows.removeClass('dimmed focused'), 2000);
  };

  // 4) on page-load ?highlight, scrub URL
  var params = new URLSearchParams(window.location.search);
  if (params.has('highlight')) {
    jumpToStaff(params.get('highlight'));
    params.delete('highlight');
    history.replaceState(null,'', location.pathname);
  }
});
</script>

<script>
(() => {
  // point to your new Activity panel, not notifPanel
  const panel    = document.getElementById('activityPanel');
  const offersEl = document.getElementById('activityOffersList');
  const reqsEl   = document.getElementById('activityRequestsList');

  // 1) Fetch & render on panel open
  panel.addEventListener('show.bs.offcanvas', () => {
    offersEl.innerHTML = '<li class="list-group-item text-center">Loading…</li>';
    reqsEl.innerHTML   = '<li class="list-group-item text-center">Loading…</li>';

    fetch('get_user_activity.php')
      .then(async r => {
        const text = await r.text();
        console.log('RAW get_user_activity response:', text);
        return JSON.parse(text);
      })
      .then(data => {
        // Active Offers
        if (!data.offers.length) {
          offersEl.innerHTML = '<li class="list-group-item text-center text-muted">No active offers.</li>';
        } else {
          offersEl.innerHTML = '';
          data.offers.forEach(o => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
              <div>
                <strong>${o.book_name}</strong><br>
                <small class="text-muted">Offered on ${new Date(o.offered_at).toLocaleDateString()}</small>
                <p class="mb-0"><small>${o.book_condition}</small></p>
              </div>
              <button class="btn btn-sm btn-danger drop-btn" data-offer-id="${o.offer_id}">
                حذف العرض
              </button>
            `;
            offersEl.appendChild(li);
          });
        }

        // Pending Requests
        if (!data.requests.length) {
          reqsEl.innerHTML = '<li class="list-group-item text-center text-muted">No pending requests.</li>';
        } else {
          reqsEl.innerHTML = '';
          data.requests.forEach(r => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
              <div>
                <strong>${r.book_name}</strong><br>
                <small class="text-muted">Requested on ${new Date(r.requested_at).toLocaleDateString()}</small>
              </div>
              <button class="btn btn-sm btn-warning cancel-btn" data-request-id="${r.request_id}">
                إلغاء الطلب
              </button>
            `;
            reqsEl.appendChild(li);
          });
        }
      })
      .catch(err => {
        console.error('Activity load error:', err);
        offersEl.innerHTML = '<li class="list-group-item text-danger">Error loading offers.</li>';
        reqsEl.innerHTML   = '<li class="list-group-item text-danger">Error loading requests.</li>';
      });
  });

  // 2) Delegate Drop & Cancel inside Activity panel
  panel.addEventListener('click', e => {
    // DROP offer
    if (e.target.matches('.drop-btn')) {
      const id = e.target.dataset.offerId;
      if (!confirm('هل أنت متأكد من حذف العرض؟')) return;
      fetch('drop.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: `offer_id=${id}`
      })
      .then(r => r.json())
      .then(j => {
        if (j.status === 'ok') {
          e.target.closest('li').remove();
        } else {
          alert('لم يتم حذف العرض: ' + j.status);
        }
      })
      .catch(() => alert('Network error dropping offer.'));
      return;
    }

    // CANCEL request
    if (e.target.matches('.cancel-btn')) {
      const id = e.target.dataset.requestId;
      if (!confirm('هل تريد إلغاء طلبك؟')) return;
      fetch('cancel_request.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: `request_id=${id}`
      })
      .then(r => r.json())
      .then(j => {
        if (j.status === 'ok') {
          e.target.closest('li').remove();
        } else {
          alert('لم يتم إلغاء الطلب: ' + j.status);
        }
      })
      .catch(() => alert('Network error cancelling request.'));
    }
  });
})();
</script>


