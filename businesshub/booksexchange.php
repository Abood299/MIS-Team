<?php
// ── booksexchange.php ──
session_start();
require_once 'includes/db.php';    // your connection to business_hub2
$isLoggedIn = isset($_SESSION['user_id']);

// fetch all books + copy counts + department
$sql = "
  SELECT
    b.id,
    b.book_name,
     b.image,
    d.department_name AS department,   -- ← use the correct column
    COALESCE(o.copies,0)       AS copies
  FROM book_exchange AS b
  JOIN departments AS d
    ON b.department_id = d.id
  LEFT JOIN (
    SELECT book_id, COUNT(*) AS copies
    FROM book_offers
    GROUP BY book_id
  ) AS o
    ON b.id = o.book_id
  ORDER BY d.department_name, b.book_name
";
$res   = mysqli_query($conn,$sql);
$books = mysqli_fetch_all($res, MYSQLI_ASSOC);


// capture the “offer” flag from the URL
$offerStatus  = $_GET['offer'] ?? '';
$offerExists  = $offerStatus === 'exists';
$offerOk      = $offerStatus === 'ok';

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

<!-- Search Bar -->
<div class="container mb-3">
  <div class="input-group">
    <input id="searchInput" type="text" class="form-control" placeholder="Search for book…">
    <button id="searchBtn" class="btn btn-primary">Search</button>
  </div>
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
        Give
      </button>
      <button class="btn btn-primary" 
              data-bs-toggle="modal" 
              data-bs-target="#takeModal">
        Take
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

<?php include 'includes/footer.php'; ?>


<script>
(function(){
  const bookCards = document.querySelectorAll('.book-card');

  // ===============================================================================  
  // 1) Track which book was clicked and populate the hidden “Give” form field  
  // ===============================================================================  
  bookCards.forEach(card => {
    card
      .querySelector('.btn-success')              // “Give” button on each card  
      .addEventListener('click', () => {
        // Put this card’s book ID into the hidden input inside the Give modal  
        document.getElementById('giveBookId').value = card.dataset.bookId;
      });
  });

  // ===============================================================================  
  // 2) When the “Take” modal opens, clear previous state and fetch fresh offer data  
  // ===============================================================================  
  const takeModalEl   = document.getElementById('takeModal');
  const giverList     = document.getElementById('giverList');     // <ul> for offer items  
  const requestStatus = document.getElementById('requestStatus'); // status message below list  

  takeModalEl.addEventListener('show.bs.modal', event => {
    const triggerBtn = event.relatedTarget;                    // the “Take” button that opened it  
    const card       = triggerBtn.closest('.book-card');
    const bookId     = card.dataset.bookId;

    // Reset list & any previous status message  
    giverList.innerHTML       = '';
    requestStatus.textContent = '';

    // Fetch all offers for this book, including whether THIS user has already requested each  
    fetch(`getOffers.php?book_id=${bookId}`)
      .then(r => r.json())
      .then(offers => {
        if (!offers.length) {
          // No offers yet  
          giverList.innerHTML = `<li class="list-group-item">No offers yet for this book.</li>`;
          return;
        }
        // Build each list item  
        offers.forEach(o => {
          const li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-start';

          // Left side: giver info  
          let html = `
            <div>
              <strong>${o.giver_name}</strong><br>
              <small class="text-muted">
                Offered on: ${new Date(o.offered_at).toLocaleDateString()}
              </small><br>
              <small>${o.book_condition}</small>
            </div>
          `;

          // Right side:  
          if (window.currentUserId === o.giver_id) {
            // (A) Your own offer → Drop  
            html += `
              <button
                class="btn btn-sm btn-danger drop-btn"
                data-offer-id="${o.offer_id}"
              >Drop</button>
            `;
          }
          else if (o.has_requested) {
            // (B) You already have a *pending* request → Cancel  
            html += `
              <button
                class="btn btn-sm btn-warning cancel-btn"
                data-request-id="${o.request_id}"
              >Cancel</button>
            `;
          }
          else {
            // (C) No pending request → Request  
            html += `
              <button
                class="btn btn-sm btn-primary request-btn"
                data-offer-id="${o.offer_id}"
              >Request</button>
            `;
          }

          li.innerHTML = html;
          giverList.appendChild(li);
        });
      })
      .catch(() => {
        // Network or JSON error  
        giverList.innerHTML = `
          <li class="list-group-item text-danger">
            Error loading offers.
          </li>
        `;
      });
  });

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


<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
