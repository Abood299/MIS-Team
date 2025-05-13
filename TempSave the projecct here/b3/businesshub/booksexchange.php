<?php
// ── booksexchange.php ──
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'includes/db.php';

$isLoggedIn = isset($_SESSION['user_id']);

// 1) Fetch all books + active-offer counts + department
$sql = "
  SELECT
    b.id,
    b.book_name,
    b.image,
    d.department_name AS department,
    COALESCE(o.copies,0) AS copies
  FROM book_exchange AS b
  JOIN departments AS d
    ON b.department_id = d.id
  LEFT JOIN (
    SELECT
      book_id,
      COUNT(*) AS copies
    FROM book_offers
    WHERE status = 'active'
      AND desired_book_id IS NULL
    GROUP BY book_id
  ) AS o
    ON b.id = o.book_id
  ORDER BY d.department_name, b.book_name
";

$res   = mysqli_query($conn, $sql);
$books = mysqli_fetch_all($res, MYSQLI_ASSOC);

// ── NEW: fetch number of active swap offers ──
$swapRes   = mysqli_query($conn, "
  SELECT COUNT(*) AS cnt
    FROM book_offers
   WHERE desired_book_id IS NOT NULL
     AND status = 'active'
");
$swapCount = (int) mysqli_fetch_assoc($swapRes)['cnt'];

// 2) Capture “offer” status for alerts
$offerStatus = $_GET['offer'] ?? '';
$offerExists = $offerStatus === 'exists';
$offerOk     = $offerStatus === 'ok';

// 3) Prepare departments list for swap modal
$majRes = mysqli_query($conn, "
  SELECT id, department_name AS name
    FROM departments
   ORDER BY department_name
");
$majors = mysqli_fetch_all($majRes, MYSQLI_ASSOC);

// 4) Prevent “undefined variable” in any PHP-side foreach
$offers = [];
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
       <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
     
    <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
    <script>
    // expose login state
    window.isLoggedIn = <?= $isLoggedIn?'true':'false' ?>;
    window.currentUserId = <?= $isLoggedIn ? (int)$_SESSION['user_id'] : 'null' ?>;
  </script>




    <style>

:root {
      --primary-color: #0d6efd;
      --secondary-color: #6c757d;
      --light-bg: #f8f9fa;
      --dark-text: #343a40;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }
    /* Global Styles for Books Exchange */
    body {

      margin: 0;
      padding: 0;
      background-color: #ffffff;
      color: var(--dark-text);
    }
   /* Page Title */
   .page-title {
      text-align: center;
      margin: 2rem 0 1rem 0;
    }
    /* Category Tabs */
    .category-tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 2rem;
      margin-bottom: 2rem;
    }
    .category-tabs button {
      border: none;
      background-color: #ddd;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      cursor: pointer;
      transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .category-tabs button.active,
    .category-tabs button:hover {
      background-color: #bbb;
      transform: scale(1.05);
    }
    /* Book Grid */
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1rem;
      padding: 0 1rem;
      margin-bottom: 2rem;
    }
    .book-card {
      border: 1px solid #ccc;
      border-radius: 8px;
      text-align: center;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background-color: #fff;
    }
    .book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px var(--card-shadow);
    }
    /* Wrap the image to position status on top */
    .book-image-container {
      position: relative;
    }
    .book-image-container img {
      border-radius: 4px;
      width: 100%;
      height: auto;
      display: block;
    }
    /* Book Status Bar */
    .book-status {
      position: absolute;
      top: 5px;
      right: 5px;
      font-size: 0.8rem;
      padding: 2px 5px;
      border-radius: 5px;
      color: #fff;
    }
    .book-status.available {
      background-color: green;
    }
    .book-status.unavailable {
      background-color: red;
    }
    .book-card h6 {
      margin: 0.5rem 0;
      font-size: 1.1rem;
      font-weight: 500;
    }
    .book-card p {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 0.5rem;
    }
    .book-card .btn {
      margin: 0.25rem;
      font-size: 0.9rem;
    }
/* swap-offers panel */
.offered-title {
  color: #A291E6; /* soft purple */
}
.desired-title {
  color: #F4A261; /* soft orange */
}
</style>
</head>


<body>
<?php include 'includes/header.php'; ?>

<!-- alert for actions  -->
<?php if ($offerExists): ?>
  <div class="container mt-3">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      You’ve already offered that book — you can’t add it twice.
    </div>
  </div>
<?php elseif ($offerOk): ?>
  <div class="container mt-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Your offer has been submitted!
    </div>
  </div>
<?php endif; ?>

<!-- Page Title -->
<div class="page-title">
  <h1>Books Exchange</h1>
</div>

<!-- Search + Swap-Offers Trigger -->
<div class="container mb-3 d-flex justify-content-center align-items-center">
  <div class="input-group me-2" style="max-width:400px; flex:1">
    <input id="searchInput" type="text" class="form-control" placeholder="Search for book…">
    <button id="searchBtn" class="btn btn-primary">Search</button>
  </div>

  <!-- Give-for-Take Offers button with badge -->
  <button 
    class="btn btn-outline-warning position-relative" 
    data-bs-toggle="modal" 
    data-bs-target="#swapOffersModal">
    Give for Take Offers

    <?php if ($swapCount > 0): ?>
      <span 
        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        <?= $swapCount ?>
        <span class="visually-hidden">swap offers</span>
      </span>
    <?php endif; ?>
  </button>
</div>

<!-- Category Tabs -->
<div class="category-tabs container mb-4">
  <button class="active" data-category="all">All Majors</button>
  <?php
    // get unique departments from your books list
    $depts = array_unique(array_column($books, 'department'));
    foreach ($depts as $dep):
  ?>
    <button data-category="<?= htmlspecialchars($dep) ?>">
      <?= htmlspecialchars($dep) ?>
    </button>
  <?php endforeach; ?>
</div>

<!-- Book Grid -->
<div class="book-grid container" id="bookGrid">
  <?php foreach($books as $b):
    $c   = (int)$b['copies'];
    // use the DB image if present, otherwise fallback
    $src = $b['image']
         ? htmlspecialchars($b['image'])
         : 'Academicpics/dummybook.jpeg';
  ?>
    <div class="book-card" 
         data-book-id="<?= (int)$b['id'] ?>"
         data-category="<?= htmlspecialchars($b['department']) ?>">
      
      <div class="book-image-container">
        <img
          src="<?= $src ?>"
          alt="Cover for <?= htmlspecialchars($b['book_name']) ?>">
        <div class="book-status <?= $c > 0 ? 'available' : 'unavailable' ?>"
             data-copies="<?= $c ?>">
          <?= $c > 0 
               ? "Available ({$c} copy" . ($c > 1 ? 'ies' : '') . ")"
               : "Not Available" ?>
        </div>
      </div>

      <h6><?= htmlspecialchars($b['book_name']) ?></h6>
      <p class="text-muted"><?= htmlspecialchars($b['department']) ?></p>

      <button class="btn btn-success" 
              data-bs-toggle="modal" 
              data-bs-target="#giveModal">
        اعطاء 
      </button>
      <button class="btn btn-primary" 
              data-bs-toggle="modal" 
              data-bs-target="#takeModal">
        اخذ
      </button>
   <button 
  class="btn btn-outline-warning give-for-take-btn" 
  data-book-id="<?= (int)$b['id'] ?>">
  اعطاء بشرط اخذ
</button>


    </div>
  <?php endforeach; ?>
</div>


<!-- Give Modal -->
<div class="modal fade" id="giveModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Give This Book</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <form id="giveForm" action="give.php" method="POST">
        <input type="hidden" name="book_id" id="giveBookId">
        <div class="mb-3">
          <label for="giverBookDetails" class="form-label">Book Details</label>
          <textarea name="details" class="form-control" id="giverBookDetails" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Offer</button>
      </form>
    </div>
  </div></div>
</div>

<!-- Take Modal -->
<div class="modal fade" id="takeModal" tabindex="-1">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">People Who Offered This Book</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
      <ul class="list-group" id="giverList"></ul>
      <div id="requestStatus" class="mt-3"></div>
    </div>
  </div></div>
</div>

<!-- Swap Offer Modal -->
<div class="modal fade" id="swapModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <!-- 1) Form wraps the modal-content -->
    <form id="swapForm" action="give_swap.php" method="POST">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Offer a Swap</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <!-- Hidden book you’re offering -->
          <input type="hidden" name="book_id" id="swap-offer-book-id">

          <div class="mb-3">
            <label for="desired_major" class="form-label">Choose Desired Major</label>
            <select id="desired_major" class="form-select" required>
              <option value="">— Select Major —</option>
              <?php foreach($majors as $m): ?>
                <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="desired_book" class="form-label">Choose Desired Book</label>
            <select id="desired_book" name="desired_book_id" class="form-select" required>
              <option value="">— Select Book —</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="swap-details" class="form-label">Your Book Condition / Details</label>
            <textarea id="swap-details" name="details" class="form-control" rows="3" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary">
            Submit Swap Offer
          </button>
        </div>

      </div>
    </form>
  </div>
</div>


<!-- Swap-Offers Panel Modal -->
<div class="modal fade" id="swapOffersModal" tabindex="-1" aria-labelledby="swapOffersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="swapOffersModalLabel">Give for Take Offers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush" id="swapOffersList">
          <li class="list-group-item text-center text-muted">— none yet —</li>
        </ul>
        <div id="swapOffersStatus" class="mt-3"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>


<?php include 'includes/footer.php'; ?>

  <!-- first load Bootstrap’s JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){
  const bookCards = document.querySelectorAll('.book-card');

  // ===============================================================================  
  // 1) Track which book was clicked and populate the hidden “Give” form field  
  // ===============================================================================  
  bookCards.forEach(card => {
    card.querySelector('.btn-success')?.addEventListener('click', () => {
      document.getElementById('giveBookId').value = card.dataset.bookId;
    });
  });

  // ===============================================================================  
  // 2) When the “Take” modal opens, clear previous state and fetch fresh offer data  
  // ===============================================================================  
const takeModalEl = document.getElementById('takeModal'); 
const giverList = document.getElementById('giverList');
const requestStatus = document.getElementById('requestStatus');

if (!takeModalEl.dataset.bound) {
  takeModalEl.addEventListener('show.bs.modal', event => {
    const triggerBtn = event.relatedTarget;
    const card = triggerBtn.closest('.book-card');
    const bookId = card.dataset.bookId;

    giverList.innerHTML = '';
    requestStatus.textContent = '';

    console.log('🟢 show.bs.modal for bookId =', bookId);

    fetch(`getOffers.php?book_id=${bookId}`)
      .then(r => r.json())
      .then(offers => {
        if (!offers.length) {
          giverList.innerHTML = `<li class="list-group-item">No offers yet for this book.</li>`;
          return;
        }

        const shown = new Set(offers.map(o => String(o.offer_id)));
        giverList.innerHTML = ''; // Clear again if needed

        shown.forEach(offerId => {
          const o = offers.find(item => String(item.offer_id) === offerId);
          if (!o) return;

          const li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-start';

          let html = `
            <div>
              <strong>${o.giver_name}</strong><br>
              <small class="text-muted">Offered on: ${new Date(o.offered_at).toLocaleDateString()}</small><br>
              <small>${o.book_condition}</small>
            </div>
          `;

          if (window.currentUserId === o.giver_id) {
            html += `<button class="btn btn-sm btn-danger drop-btn" data-offer-id="${o.offer_id}">Drop</button>`;
          } else if (o.has_requested) {
            html += `<button class="btn btn-sm btn-warning cancel-btn" data-request-id="${o.request_id}">Cancel</button>`;
          } else {
            html += `<button class="btn btn-sm btn-primary request-btn" data-offer-id="${o.offer_id}">Request</button>`;
          }

          li.innerHTML = html;
          giverList.appendChild(li);
        });
      })
      .catch(() => {
        giverList.innerHTML = `<li class="list-group-item text-danger">Error loading offers.</li>`;
      });
  });

  takeModalEl.dataset.bound = "true";
}
// ===========================================================================  
  // Populate the Give-modal’s hidden book_id whenever it’s shown  
  // ===========================================================================  
  const giveModalEl = document.getElementById('giveModal');

  giveModalEl.addEventListener('show.bs.modal', event => {
    // 1) The button that opened the modal  
    const triggerBtn = event.relatedTarget;
    // 2) Find its .book-card parent and grab the data-book-id  
    const card   = triggerBtn.closest('.book-card');
    const bookId = card.dataset.bookId;

    // *** Debug line: make sure this fires and shows a real ID ***  
    console.log('Opening Give modal for book_id =', bookId);

    // 3) Populate the hidden input  
    document.getElementById('giveBookId').value = bookId;
  });

  // ===============================================================================  
  // 3) Delegate button clicks in the Take modal’s offer list  
  // ===============================================================================  
  giverList.addEventListener('click', e => {

    // -------------------------------------------------------------------------------  
    // 3a) Handle “Request” button clicks  
    // -------------------------------------------------------------------------------  
    if (e.target.matches('.request-btn')) {
      if (!window.isLoggedIn) {
        // not signed in → redirect to login  
        window.location.href = 'user_login.php';
        return;
      }

      const offerId = e.target.dataset.offerId;
      requestStatus.textContent = 'Sending request…';

      fetch('take.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `offer_id=${offerId}`
      })
      .then(r => r.json())
      .then(data => {
        if (data.status === 'exists') {
          alert('You have already requested this book.');
          requestStatus.textContent = 'You already made this request.';
        }
        else if (data.status === 'ok') {
          alert('Your request has been submitted!');
          requestStatus.textContent = 'Request submitted!';
          // Optionally toggle button immediately:  
          e.target.textContent = 'Cancel';
          e.target.classList.replace('request-btn','cancel-btn');
          e.target.classList.replace('btn-primary','btn-warning');
          e.target.dataset.requestId = data.request_id; // if take.php returns it  
        }
        else {
          alert('Unexpected response, please try again.');
          requestStatus.textContent = 'Error: unexpected response.';
        }
      })
      .catch(() => {
        alert('Error sending request.');
        requestStatus.textContent = 'Network error.';
      });

      return;
    }

    // -------------------------------------------------------------------------------  
    // 3b) Handle “Cancel” button clicks (to drop a pending request)  
    // -------------------------------------------------------------------------------  
    if (e.target.matches('.cancel-btn')) {
      const requestId = e.target.dataset.requestId;
      requestStatus.textContent = 'Cancelling request…';

      fetch('cancel_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `request_id=${encodeURIComponent(requestId)}`
      })
      .then(response => {
        console.log('HTTP status:', response.status, response.statusText);
        return response.text();
      })
      .then(text => {
        console.log('Raw cancel_request.php response:', text);
        const data = JSON.parse(text);
        if (data.status === 'ok') {
          alert('Your request has been cancelled.');
          requestStatus.textContent = 'Request cancelled.';
          // Toggle button back to Request  
          e.target.textContent = 'Request';
          e.target.classList.replace('cancel-btn','request-btn');
          e.target.classList.replace('btn-warning','btn-primary');
          delete e.target.dataset.requestId;
        } else {
          alert('Could not cancel request: ' + (data.msg || data.status));
          requestStatus.textContent = 'Error cancelling.';
        }
      })
      .catch(err => {
        console.error('Fetch/parsing error:', err);
        alert('Network or parse error—see console.');
        requestStatus.textContent = 'Network error.';
      });

      return;
    }

    // -------------------------------------------------------------------------------  
    // 3c) Handle “Drop” button clicks (remove my own offer)  
    // -------------------------------------------------------------------------------  
    if (e.target.matches('.drop-btn')) {
      const offerId = e.target.dataset.offerId;
      if (!confirm('Remove your offer?')) return;

      fetch('drop.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `offer_id=${offerId}`
      })
      .then(r => r.text())
      .then(text => {
        const data = JSON.parse(text);
        if (data.status === 'ok') {
          // Remove this list item  
          e.target.closest('li').remove();
          // Update availability badge on the book card  
          const card = document.querySelector(
            `.book-card[data-book-id="${data.book_id}"]`
          );
          if (card) {
            const st = card.querySelector('.book-status');
            st.dataset.copies = data.copies;
            if (data.copies > 0) {
              st.textContent = `Available (${data.copies} copie${data.copies>1?'s':''})`;
              st.classList.replace('unavailable','available');
            } else {
              st.textContent = 'Not Available';
              st.classList.replace('available','unavailable');
            }
          }
        } else {
          alert('Could not remove your offer: ' + data.status);
        }
      })
      .catch(err => {
        console.error('Drop error:', err);
        alert('Oops, network or parse error – check the console.');
      });
    }
  });

  // ===============================================================================  
  // 4) Category filter tabs (All / MIS / Finance / …)  
  // ===============================================================================  
  document.querySelectorAll('.category-tabs button').forEach(btn => {
    btn.addEventListener('click', () => {
      // Toggle active class  
      document.querySelectorAll('.category-tabs button')
        .forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      // Show/hide cards by data-category  
      const cat = btn.dataset.category;
      bookCards.forEach(c => {
        c.style.display = (cat === 'all' || c.dataset.category === cat)
          ? 'flex'
          : 'none';
      });
    });
  });

  // ===============================================================================  
  // 5) Search input & button logic  
  // ===============================================================================  
  const searchInput = document.getElementById('searchInput');
  const searchBtn   = document.getElementById('searchBtn');

  function filterBooks(){
    const q = searchInput.value.toLowerCase();
    bookCards.forEach(c => {
      c.style.display = c.querySelector('h6').textContent
        .toLowerCase()
        .includes(q)
        ? 'flex'
        : 'none';
    });
  }

  // Live filtering on input  
  searchInput.addEventListener('input', filterBooks);
  // Or on button click  
  searchBtn.addEventListener('click', filterBooks);

  // ===============================================================================  
  // 6) for notification bell icon  
  // ===============================================================================  
  document.getElementById('notifPanel').addEventListener('click', e => {
    // Reject  
    if (e.target.matches('.reject-request')) {
      const reqId = e.target.dataset.requestId;
      fetch('reject_request.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: `request_id=${encodeURIComponent(reqId)}`
      })
      .then(r => r.json())
      .then(json => {
        if (json.status === 'ok') {
          e.target.closest('li').remove();
        } else {
          alert('Could not reject: ' + (json.msg||json.status));
        }
      })
      .catch(() => alert('Network error.'));
      return;
    }

    // Accept  
    if (e.target.matches('.accept-request')) {
      const reqId = e.target.dataset.requestId;
      location.href = `chat.php?request_id=${reqId}`;
      return;
    }
  });
  
})();

</script>


<script>
  // 1) Wire up per-card “Offer a Swap” form
  document.querySelectorAll('.give-for-take-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('swap-offer-book-id').value = btn.dataset.bookId;
      document.getElementById('desired_major').value = '';
      document.getElementById('desired_book').innerHTML =
        '<option value="">— Select Book —</option>';
      new bootstrap.Modal(document.getElementById('swapModal')).show();
    });
  });

  // 2) Load books whenever major changes *but skip the one being offered*
  document.getElementById('desired_major')
    .addEventListener('change', async function() {
      const majId     = this.value;
      const sel       = document.getElementById('desired_book');
      const offeredId = document.getElementById('swap-offer-book-id').value;

      // show loading state
      sel.innerHTML = '<option value="">— Loading… —</option>';

      try {
        const res   = await fetch(`get_books_by_major.php?major_id=${majId}`);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const books = await res.json();

        // rebuild the select, skipping the offered book
        sel.innerHTML = '<option value="">— Select Book —</option>';
        books.forEach(b => {
          if (String(b.id) === offeredId) return;
          const opt = document.createElement('option');
          opt.value       = b.id;
          opt.textContent = b.title;
          sel.append(opt);
        });

        // if nothing left, show a placeholder
        if (sel.options.length === 1) {
          sel.innerHTML = '<option value="">— No other books available —</option>';
        }
      } catch (err) {
        console.error('Could not load books for major:', err);
        sel.innerHTML = '<option value="">— Error loading books —</option>';
      }
    });

  // ——— 3) Load ALL swap offers into panel ———
  document.getElementById('swapOffersModal')
    .addEventListener('show.bs.modal', async () => {
      const list   = document.getElementById('swapOffersList');
      const status = document.getElementById('swapOffersStatus');

      list.innerHTML     = '<li class="list-group-item text-center">Loading…</li>';
      status.textContent = '';

      try {
        const r     = await fetch('get_swap_offers.php');
        if (!r.ok) throw new Error(`HTTP ${r.status}`);
        const swaps = await r.json();

        if (!swaps.length) {
          list.innerHTML = '<li class="list-group-item text-center text-muted">No swap offers yet.</li>';
        } else {
          list.innerHTML = '';

          swaps.forEach(o => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-start';
            li.dataset.offerId = o.offer_id;
            if (o.has_requested === 1 || o.has_requested === "1") {
              li.dataset.requestId = o.request_id;
            }

            let btnHTML;
            const me        = Number(window.currentUserId);
            const giverId   = Number(o.giver_id);
            const requested = (o.has_requested === 1 || o.has_requested === "1");

            if (giverId === me) {
              // your own offer → Drop
              btnHTML = `
                <button 
                  class="btn btn-sm btn-danger drop-swap-btn" 
                  data-offer-id="${o.offer_id}">
                  Drop
                </button>`;
            } else if (requested) {
              // already requested → Cancel
              btnHTML = `
                <button 
                  class="btn btn-sm btn-warning cancel-swap-btn" 
                  data-request-id="${o.request_id}">
                  Cancel
                </button>`;
            } else {
              // neither → Request Swap
              btnHTML = `
                <button 
                  class="btn btn-sm btn-primary request-swap-btn" 
                  data-offer-id="${o.offer_id}">
                  Request Swap
                </button>`;
            }

            li.innerHTML = `
              <div>
                <strong>${o.giver_name}</strong> offers 
                <span class="offered-title" style="color:#9966cc;">
                  ${o.offered_title}
                </span><br>
                wants <span class="desired-title" style="color:#ec522d;">
                  ${o.desired_title}
                </span> in exchange<br>
                <small class="text-muted">
                  ${new Date(o.offered_at).toLocaleDateString()}
                </small>
                <p class="mt-2"><strong>Details:</strong> ${o.offer_condition}</p>
              </div>
              ${btnHTML}
            `;
            list.appendChild(li);
          });
        }
      } catch (err) {
        console.error('Swap load error', err);
        list.innerHTML = '<li class="list-group-item text-danger">Error loading swap offers.</li>';
      }
    });

  // 4) Delegate Drop / Cancel / Request actions
  document.getElementById('swapOffersList').addEventListener('click', async (e) => {
    const btn     = e.target;
    const li      = btn.closest('li');
    const status  = document.getElementById('swapOffersStatus');

    // 1) DROP your own swap‐offer
    if (btn.matches('.drop-swap-btn')) {
      const offerId = btn.dataset.offerId;
      if (!confirm('Remove your swap offer?')) return;
      try {
        const resp = await fetch('drop_swap_offer.php', {
          method: 'POST',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          body: `offer_id=${encodeURIComponent(offerId)}`
        });
        const json = await resp.json();
        if (json.status === 'ok') {
          li.remove();
        } else {
          alert('Could not drop: ' + (json.error || json.status));
        }
      } catch (err) {
        console.error('Drop error', err);
        alert('Network error.');
      }
      return;
    }

    // 2) CANCEL your own swap‐request
    if (btn.matches('.cancel-swap-btn')) {
      const reqId   = btn.dataset.requestId;
      if (!confirm('Cancel your swap request?')) return;
      try {
        const resp = await fetch('cancel_swap_request.php', {
          method: 'POST',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          body: `request_id=${encodeURIComponent(reqId)}`
        });
        const json = await resp.json();
        if (json.status === 'ok') {
          // remove Cancel button
          btn.remove();
          // add back Request Swap
          const requestBtn = document.createElement('button');
          requestBtn.className = 'btn btn-sm btn-primary request-swap-btn';
          requestBtn.dataset.offerId = li.dataset.offerId;
          requestBtn.textContent = 'Request Swap';
          li.appendChild(requestBtn);
          status.textContent = 'Your swap request has been cancelled.';
        } else {
          alert('Could not cancel: ' + (json.message || json.status));
        }
      } catch (err) {
        console.error('Cancel error', err);
        alert('Network error.');
      }
      return;
    }

    // 3) REQUEST a swap
    if (btn.matches('.request-swap-btn')) {
      if (!window.isLoggedIn) {
        window.location = 'user_login.php';
        return;
      }
      const offerId = btn.dataset.offerId;
      status.textContent = 'Sending request…';
      try {
        const resp = await fetch('swap_request.php', {
          method: 'POST',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          body: `offer_id=${encodeURIComponent(offerId)}`
        });
        const text = await resp.text();
        let json;
        try {
          json = JSON.parse(text);
        } catch (parseErr) {
          console.error('JSON parse error:', parseErr);
          status.textContent = 'Error parsing server response';
          return;
        }

        if (json.status === 'exists') {
          status.textContent = 'You already requested this swap.';
        }
        else if (json.status === 'ok') {
          status.textContent = 'Swap requested!';
          // swap “Request” → “Cancel”
          btn.remove();
          const cancelBtn = document.createElement('button');
          cancelBtn.className = 'btn btn-sm btn-warning cancel-swap-btn';
          cancelBtn.dataset.requestId = json.request_id;
          cancelBtn.textContent = 'Cancel';
          li.appendChild(cancelBtn);
        }
        else {
          status.textContent = 'Error: ' + (json.message || json.status);
        }
      } catch (err) {
        console.error('Request error', err);
        status.textContent = 'Network error.';
      }
    }
  });
</script>




</body>
</html>
