<?php

session_start();

// Block back button page after logout
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Now, only Super Admins can access the dashboard
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
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
  <title>Super Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      background-color: #000;
      color: white;
    }

    .sidebar {
      width: 250px;
      min-height: 100vh;
      background-color: #1c1c1c;
      padding-top: 20px;
      position: fixed;
    }

    .sidebar h4 {
      text-align: center;
      color: white;
      margin-bottom: 30px;
    }

    .sidebar a {
      padding: 15px 20px;
      display: block;
      font-weight: bold;
      text-decoration: none;
      border-radius: 0;
      margin-bottom: 5px;
    }

    .sidebar .bg-books { background-color: #007bff; color: white; }
    .sidebar .bg-courses { background-color: #28a745; color: white; }
    .sidebar .bg-staff { background-color: #ffc107; color: black; }
    .sidebar .bg-exchange { background-color: #dc3545; color: white; }
    .sidebar .bg-users { background-color: #6f42c1; color: white; }

    .sidebar a:hover {
      filter: brightness(0.9);
    }

    .topbar {
      background-color: #343a40;
      padding: 10px 20px;
      margin-left: 250px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
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
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Sidebar with colored links -->
<div class="sidebar">
  <h4>Business Hub</h4>

  <a href="manage_books.php" class="bg-books"><i class="fas fa-book me-2"></i>Books</a>
  <a href="manage_courses.php" class="bg-courses"><i class="fas fa-book-open me-2"></i>Courses</a>

  <?php if ($role === 'super_admin') : ?>
    <a href="manage_staff.php" class="bg-staff"><i class="fas fa-users me-2"></i>Academic Staff</a>
  <?php endif; ?>

  <?php if ($role === 'super_admin') : ?>
    <a href="manage_exchange.php" class="bg-exchange"><i class="fas fa-exchange-alt me-2"></i>Book Exchange</a>
    <a href="manage_users.php" class="bg-users"><i class="fas fa-user-cog me-2"></i>Users</a>
  <?php endif; ?>
</div>

<!-- Topbar -->
<div class="topbar">
<div>
    <a href="dashboard.php" class="text-white text-decoration-none">
      <strong>Super Admin Dashboard</strong>
    </a>
  </div>
  <div class="d-flex align-items-center gap-3">
    <!-- Notification -->
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
    <div class="dropdown">
      <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
        Welcome, <?= $_SESSION['user_name']; ?>
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="adminlogout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="main-content">
  <h2 class="mb-4">Dashboard Analytics</h2>
  
  <div class="row g-4 mb-4">
    <!-- Chart 1: Bar -->
    <div class="col-md-6">
      <div class="card bg-dark text-white shadow">
        <div class="card-body">
          <h5 class="card-title">Books per Department</h5>
          <canvas id="barChart" height="200"></canvas>
        </div>
      </div>
    </div>

    <!-- Chart 2: Line -->
    <div class="col-md-6">
      <div class="card bg-dark text-white shadow">
        <div class="card-body">
          <h5 class="card-title">Monthly Book Requests</h5>
          <canvas id="lineChart" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Chart 3: Pie -->
    <div class="col-md-6 col-lg-4">
      <div class="card bg-dark text-white shadow">
        <div class="card-body">
          <h5 class="card-title">User Role Distribution</h5>
          <canvas id="pieChart" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- to prevent back after sign out -->
<script>
  window.onunload = function() {};
  if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
    location.reload();
  }
</script>
<script>
  // Bar Chart for Books per Department
  new Chart(document.getElementById("barChart"), {
    type: 'bar',
    data: {
      labels: ['MIS', 'Marketing', 'Accounting', 'Finance', 'Economics', 'Business IT', 'Public Admin'],
      datasets: [{
        label: 'Books',
        data: [35, 42, 28, 22, 19, 37, 25],
        backgroundColor: '#0d6efd'
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Line Chart for Monthly Book Requests
  new Chart(document.getElementById("lineChart"), {
    type: 'line',
    data: {
      labels: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr'],
      datasets: [{
        label: 'Requests',
        data: [12, 19, 7, 17, 23, 14],
        borderColor: '#ffc107',
        backgroundColor: 'rgba(255,193,7,0.2)',
        tension: 0.3,
        fill: true
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: true } },
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Pie Chart for Role Distribution (only Super Admins & Users)
  new Chart(document.getElementById("pieChart"), {
    type: 'pie',
    data: {
      labels: ['Super Admins', 'Users'],
      datasets: [{
        data: [3, 97],
        backgroundColor: ['#dc3545', '#198754']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: { color: 'white' }
        }
      }
    }
  });
</script>

</body>
</html>
