<?php
  // make sure session is already started in the including file
  $userName = $_SESSION['user_name'] ?? 'User';
?>
<!-- ======= START NAVBAR ======= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- Brand / Dashboard link -->
      <a class="navbar-brand" href="dashboard.php">
        <i class="fas fa-tachometer-alt me-1"></i>
       Back to Dashboard
      </a>
      <!-- Mobile toggle -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#adminNavbar"
        aria-controls="adminNavbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right‑side items -->
      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav ms-auto align-items-center">
          <!-- Notification icon -->
          <li class="nav-item me-3">
            <a class="nav-link position-relative" href="#">
              <i class="fas fa-bell text-warning"></i>
              <!-- optional badge -->
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </li>
          <!-- User dropdown -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="userMenu"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fas fa-user-circle me-1"></i>
              <?= htmlspecialchars($_SESSION['user_name']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="adminlogout.php">Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- ======== END NAVBAR ======== -->

<!-- bootstrap.bundle.js includes Popper, needed for dropdowns and toggles -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ppHgpuV/n7tN3egMphDOC4S65idpD5pwh5JeB7B3u0Fqxkj+vlGC57kbHxl5Gkfj"
        crossorigin="anonymous"></script>
