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
require_once 'includes/db.php';

$offerExists = (isset($_GET['offer']) && $_GET['offer']==='exists');
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- chatgpt addons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- the link tag below for linking css bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- put on all pages  -->
       <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
     
    <base href="/businesshub/">
    <?php $version = filemtime('css/header-footer.css'); ?>
    <link rel="stylesheet" href="css/header-footer.css?v=<?php echo $version; ?>">
    <script>
    // expose login state
    window.isLoggedIn = <?= $isLoggedIn?'true':'false' ?>;
  </script>
    <?php if ($offerExists): ?>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      alert("You’ve already offered that book — you can’t add it twice.");
      // clean the URL so refresh won't re-alert
      history.replaceState({}, '', 'booksexchange.php');
    });
  </script>
  <?php endif; ?>
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

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function(){
  const bookCards = document.querySelectorAll('.book-card');

  // 1) Track which book and populate Give hidden
  bookCards.forEach(card => {
    card.querySelector('.btn-success').addEventListener('click', () => {
      document.getElementById('giveBookId').value = card.dataset.bookId;
    });
  });

  // 2) When Take modal opens, fetch offers for the specific book
  const takeModalEl   = document.getElementById('takeModal');
  const giverList     = document.getElementById('giverList');
  const requestStatus = document.getElementById('requestStatus');

  takeModalEl.addEventListener('show.bs.modal', event => {
    const triggerBtn = event.relatedTarget;
    const card       = triggerBtn.closest('.book-card');
    const bookId     = card.dataset.bookId;

    giverList.innerHTML = '';
    requestStatus.textContent = '';

    fetch(`getOffers.php?book_id=${bookId}`)
      .then(r => r.json())
      .then(offers => {
        if (!offers.length) {
          giverList.innerHTML = `<li class="list-group-item">No offers yet for this book.</li>`;
          return;
        }
        offers.forEach(o => {
          const li = document.createElement('li');
          li.className = 'list-group-item d-flex justify-content-between align-items-start';
          li.innerHTML = `
            <div>
              <strong>${o.giver_name}</strong><br>
              <small class="text-muted">
                Offered on: ${new Date(o.offered_at).toLocaleDateString()}
              </small><br>
              <small>${o.book_condition}</small>
            </div>
            <button
              class="btn btn-sm btn-primary request-btn"
              data-offer-id="${o.offer_id}"
            >
              Request
            </button>
          `;
          giverList.appendChild(li);
        });
      })
      .catch(() => {
        giverList.innerHTML = `<li class="list-group-item text-danger">Error loading offers.</li>`;
      });
  });

  // 3) Delegate Request button clicks
  giverList.addEventListener('click', e => {
    if (!e.target.matches('.request-btn')) return;

    if (!window.isLoggedIn) {
      // not signed in → go to login
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
    // 1) parse JSON
    .then(r => r.json())
    // 2) handle the result
    .then(data => {
      if (data.status === 'exists') {
        alert('You have already requested this book.');
        requestStatus.textContent = 'You already made this request.';
      }
      else if (data.status === 'ok') {
        alert('Your request has been submitted!');
        requestStatus.textContent = 'Request submitted!';
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
  });

  // 4) Category filter
  document.querySelectorAll('.category-tabs button').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.category-tabs button').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const cat = btn.dataset.category;
      bookCards.forEach(c => {
        c.style.display = (cat === 'all' || c.dataset.category === cat) ? 'flex' : 'none';
      });
    });
  });

  // 5) Search
  const searchInput = document.getElementById('searchInput');
  const searchBtn   = document.getElementById('searchBtn');
  function filterBooks(){
    const q = searchInput.value.toLowerCase();
    bookCards.forEach(c => {
      c.style.display = c.querySelector('h6').textContent.toLowerCase().includes(q)
        ? 'flex'
        : 'none';
    });
  }
  searchInput.addEventListener('input', filterBooks);
  searchBtn.addEventListener('click', filterBooks);

})();
</script>

</body>
</html>
