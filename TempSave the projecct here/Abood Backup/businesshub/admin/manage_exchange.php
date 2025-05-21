<?php

session_start();


// Restrict access to Super Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Prevent back-button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Exchange – Business Hub</title>
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css?v=<?= time() ?>"
    rel="stylesheet"
  >
  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
  >
</head>
<body class="bg-dark text-white p-4">
  <?php include __DIR__ . '/../includes/admin_nav.php'; ?>

  <div class="container">
    <h2 class="mb-4 text-center">Monitor Book Exchange</h2>

    <div class="row justify-content-center g-4">
      <!-- Card 1 -->
      <div class="col-12 col-md-4">
        <div class="card bg-secondary text-white text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">View All Offers</h5>
            <p class="card-text flex-grow-1">
              See a list of all current book exchange offers.
            </p>
            <a href="monitorBookOffers.php" class="btn btn-primary mt-auto">Review</a>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-12 col-md-4">
        <div class="card bg-secondary text-white text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">View All Requests</h5>
            <p class="card-text flex-grow-1">
              See a list of all current book exchange requests.
            </p>
            <a href="monitorBookRequest.php" class="btn btn-success mt-auto">Review</a>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-12 col-md-4">
        <div class="card bg-secondary text-white text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Modify Books in Book Exchange Page</h5>
            <p class="card-text flex-grow-1">
              Add new books or alter book cover.
            </p>
            <a href="manage_book_exchange.php" class="btn btn-danger mt-auto">Create</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
