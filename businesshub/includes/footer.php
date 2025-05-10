
<footer class="footer">
  <div class="footer-container">
    <div class="footer-left">
      <h2>
        <a href="MainPagefull.php" style="text-decoration: none;">
          <span style="color: #EC522D; font-weight: bold; text-shadow: 0 0 5px #EC522D, 0 0 20px #EC522D;">Business</span>
          <span style="color: #5E2950; font-weight: bold; text-shadow: 0 0 10px #5E2950, 0 0 20px #5E2950;">Hub</span>
        </a>
      </h2>
      <p class="slogan">تمكين الطلاب وربط المعرفة وبناء المستقبل</p>
    <p class="copyright">جميع الحقوق محفوظة © 2025 <strong>Business Hub</strong></p>

    </div>


    <div class="footer-middle">
      <a href="MIS.php">نظم المعلومات الإدارية</a>
      <a href="BUS.php">إدارة الأعمال</a>
      <a href="ECO.php">اقتصاد الأعمال</a>
      <a href="PBUS.php">الإدارة العامة</a>
      <a href="FNC.php">التمويل</a>
      <a href="MKT.php">التسويق</a>
      <a href="ACC.php">المحاسبة</a>
    </div>



    <div class="footer-right">
      <a href="https://regapp.ju.edu.jo/regapp/">موقع التسجيل</a>
      <a href="https://elearning.ju.edu.jo/login/index.php">eLearning</a>
      <a href="https://juexams.com/moodle/login/index.php">Ju-Exam</a>
      <a href="https://library.ju.edu.jo/Elibrary/">E-Library</a>
      <a href="https://eservices.ju.edu.jo/ClinicApp/Home.aspx">عيادة الجامعة</a>
      <a href="#">من نحن</a>
    </div>

  </div>

</footer>
<!-- to prevent back after sign out -->
<script>
  window.onunload = function() {};
  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
    location.reload();
  }
</script>
 
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

<!--
  JS: wires up Accept → chat.php and Reject → reject_request.php
  Make sure you’ve included Bootstrap’s bundle.js (for the offcanvas),
  then place this snippet just before your closing </body> tag.
-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!--
  JS: wires up Accept → chat.php and Reject → reject_request.php
  Make sure you’ve included Bootstrap’s bundle.js (for the offcanvas),
  then place this snippet just before your closing </body> tag.
-->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // ── 1) Accept book-request ────────────────────────────────────────────────
  document.querySelectorAll('.accept-request').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const reqId = btn.dataset.requestId;
      fetch('accept_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `request_id=${encodeURIComponent(reqId)}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'ok' && data.chat_id) {
          window.location.href = `chat.php?chat_id=${data.chat_id}`;
        } else {
          alert('Could not start chat: ' + (data.error || data.status));
        }
      })
      .catch(() => alert('Network error; please try again.'));
    });
  });

  // ── 2) Reject book-request ────────────────────────────────────────────────
  document.querySelectorAll('.reject-request').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const reqId = btn.dataset.requestId;
      if (!confirm('Reject this request?')) return;
      fetch('reject_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `request_id=${encodeURIComponent(reqId)}`
      })
      .then(r => r.json())
      .then(data => {
        if (data.status === 'ok') {
          btn.closest('li').remove();
        } else {
          alert('Could not reject: ' + (data.error || data.status));
        }
      })
      .catch(() => alert('Network error rejecting request'));
    });
  });

  // ── 3) Delete a single notification ───────────────────────────────────────
  document.querySelectorAll('.delete-notif').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const id = btn.dataset.notifId;
      if (!confirm('Delete this notification?')) return;
      fetch('delete_notification.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `notif_id=${encodeURIComponent(id)}`
      })
      .then(r => r.json())
      .then(data => {
        if (data.status === 'ok') {
          btn.closest('li').remove();
        } else {
          alert('Could not delete notification: ' + (data.error || data.status));
        }
      })
      .catch(() => alert('Network error deleting notification'));
    });
  });

  // ── 4) Clear all notifications ─────────────────────────────────────────────
  const clearAllBtn = document.getElementById('clear-all-notifs');
  if (clearAllBtn) {
    clearAllBtn.addEventListener('click', e => {
      e.preventDefault();
      if (!confirm('Delete all notifications?')) return;
      fetch('clear_notifications.php', { method: 'POST' })
        .then(r => r.json())
        .then(data => {
          if (data.status === 'ok') {
            document.querySelectorAll('#notifPanel .list-group-item')
                    .forEach(li => li.remove());
          } else {
            alert('Could not clear notifications: ' + (data.error || data.status));
          }
        })
        .catch(() => alert('Network error clearing notifications'));
    });
  }

  // ── 5) Recent Chats button ─────────────────────────────────────────────────
  const recentBtn = document.getElementById('show-recent-chats');
  if (recentBtn) {
    recentBtn.addEventListener('click', e => {
      e.preventDefault();
      window.location.href = 'recent_chats.php';
    });
  }

  // ── 6) On offcanvas show: clear badge & mark all read ───────────────────────
  const notifPanelEl = document.getElementById('notifPanel');
  if (notifPanelEl) {
    notifPanelEl.addEventListener('shown.bs.offcanvas', () => {
      document.querySelector('.notif-badge')?.remove();
      fetch('mark_notifications_read.php', { method: 'POST' })
        .then(r => r.json())
        .then(data => {
          if (data.status !== 'ok') {
            console.warn('Could not mark notifications read');
          }
        })
        .catch(() => console.warn('Network error marking read'));
    });
  }

  console.log('🟣 Notifications script loaded');
});
</script>

















