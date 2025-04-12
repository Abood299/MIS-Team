<?php
session_start();

// Block back button page after logout
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Access protection
if (
    !isset($_SESSION['user_id']) || 
    (
      $_SESSION['user_role'] !== 'admin' && 
      $_SESSION['user_role'] !== 'super_admin'
    )
) {
    header("Location: admin_login_page.php");
    exit;
}

$role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome (Add in <head> if not already added) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
  <style>
    body {
      background-color:rgb(0, 0, 0);
    }
    .dashboard-card {
      border-radius: 12px;
      padding: 20px;
      color: #fff;
      height: 150px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: transform 0.2s ease;
    }
    .dashboard-card:hover {
      transform: scale(1.03);
    }
    .bg-books { background-color: #007bff; }
    .bg-courses { background-color: #28a745; }
    .bg-staff { background-color: #ffc107; color: #000; }
    .bg-exchange { background-color: #dc3545; }
    a.card-link {
      text-decoration: none;
      color: inherit;
    }
    .topbar {
      background-color: #343a40;
      color: white;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .dropdown-toggle::after {
      margin-left: 8px;
    }
    .dropdown-menu {
      background-color: #343a40;
      border: none;
    }
    .dropdown-menu a {
      color: #ffc107;
      text-decoration: none;
    }
    .dropdown-menu a:hover {
      background-color: #495057;
    }
    .bg-users { background-color: #6f42c1; }
    .bg-users { background-color: #6f42c1; color: #fff; }
  </style>
</head>
<body>



<div class="topbar d-flex justify-content-between align-items-center">
  <div><strong>Admin Dashboard</strong></div>

  <div class="d-flex align-items-center gap-3">
    
    <!-- Notification Dropdown -->
    <div class="dropdown">
      <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell me-2 text-warning"></i>

      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
        <li><a class="dropdown-item" href="#">📚 New book request</a></li>
        <li><a class="dropdown-item" href="#">📬 New Feedback received</a></li>
        <li><a class="dropdown-item" href="#">🔔 Reminder: Check user updates</a></li>
      </ul>
    </div>

    <!-- User Dropdown -->
<!-- User Dropdown -->
<div class="dropdown">
  <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
    Welcome, <?php echo $_SESSION['user_name']; ?>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
    <li><a class="dropdown-item" href="#">Settings</a></li>
    <li><a class="dropdown-item" href="adminlogout.php">Log Out</a></li>
  </ul>
</div>


  </div>
</div>


<div class="container py-5">
  <div class="row g-4">

    <div class="col-md-6 col-xl-3">
      <a href="manage_books.php" class="card-link">
        <div class="dashboard-card bg-books">
          <h4>Books</h4>
          <p>Manage department books</p>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-xl-3">
      <a href="manage_courses.php" class="card-link">
        <div class="dashboard-card bg-courses">
          <h4>Courses</h4>
          <p>Manage department courses</p>
        </div>
      </a>
    </div>

    <?php if ($role === 'super_admin') : ?>
    <div class="col-md-6 col-xl-3">
      <a href="manage_staff.php" class="card-link">
        <div class="dashboard-card bg-staff">
          <h4>Academic Staff</h4>
          <p>Manage faculty members</p>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-xl-3">
      <a href="manage_exchange.php" class="card-link">
        <div class="dashboard-card bg-exchange">
          <h4>Book Exchange</h4>
          <p>View & monitor requests</p>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-xl-3">
      <a href="manage_users.php" class="card-link">
        <div class="dashboard-card bg-users">
          <h4>Users</h4>
          <p>Manage users & roles</p>
        </div>
      </a>
    </div>
    <?php endif; ?>
  <!-- Bootstrap Bundle JS (with Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // previous page should be reloaded when user navigate through browser navigation
    // for mozilla
    window.onunload = function(){};
    // for chrome
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        location.reload();
    }
</script>
</body>
</html>
