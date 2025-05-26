<?php

session_start();

// Block back button page after logout
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Now, 🔴only Super Admins can access the dashboard
if (empty($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}


require_once __DIR__ . '/../includes/db.php';

// —————————————————————————————————————
// 1) Books per Department (Bar chart)
// —————————————————————————————————————
$sql = "
  SELECT d.department_name,
         COUNT(b.id) AS total
    FROM books AS b
    JOIN departments AS d
      ON b.department_id = d.id
   GROUP BY b.department_id
   ORDER BY d.department_name
";
$result = $conn->query($sql);

$deptLabels = [];
$deptCounts = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $deptLabels[] = $row['department_name'];
        $deptCounts[] = (int)$row['total'];
    }
}

// —————————————————————————————————————
// 2) Monthly Requests & Offers (Line chart)
// —————————————————————————————————————
$months        = [];
$requestCounts = [];
$offerCounts   = [];
for ($i = 5; $i >= 0; $i--) {
    $yearMonth       = date('Y-m', strtotime("-{$i} months"));
    $months[]        = date('M',   strtotime("-{$i} months"));

    // count requests
    $stmtReq = $conn->prepare("
      SELECT COUNT(*) AS cnt
        FROM book_requests
       WHERE DATE_FORMAT(timestamp, '%Y-%m') = ?
    ");
    $stmtReq->bind_param("s", $yearMonth);
    $stmtReq->execute();
    $cntReq = $stmtReq->get_result()->fetch_assoc()['cnt'] ?? 0;
    $requestCounts[] = (int)$cntReq;
    $stmtReq->close();

    // count offers
    $stmtOff = $conn->prepare("
      SELECT COUNT(*) AS cnt
        FROM book_offers
       WHERE DATE_FORMAT(timestamp, '%Y-%m') = ?
    ");
    $stmtOff->bind_param("s", $yearMonth);
    $stmtOff->execute();
    $cntOff = $stmtOff->get_result()->fetch_assoc()['cnt'] ?? 0;
    $offerCounts[] = (int)$cntOff;
    $stmtOff->close();
}

// —————————————————————————————————————
// 3) Book Request Statuses (Pie chart)
// —————————————————————————————————————
$statusLabels = [];
$statusCounts = [];
$sqlStatus = "SELECT status, COUNT(*) AS cnt FROM book_requests GROUP BY status";
$resStatus = $conn->query($sqlStatus);
if ($resStatus) {
    while ($row = $resStatus->fetch_assoc()) {
        // capitalize first letter
        $statusLabels[] = ucfirst($row['status']);
        $statusCounts[] = (int)$row['cnt'];
    }
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


    <!-- User Dropdown -->
    <div class="dropdown">
      <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
<h6>Welcome, <?= htmlspecialchars($_SESSION['admin_name']) ?></h6>
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
     
        <li><a class="dropdown-item" href="adminlogout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
</div>

 <!-- Main Content -->
  <div class="main-content">
    <h2 class="mb-4">Dashboard Analytics</h2>

    <div class="row g-4 mb-4">
      <!-- Bar Chart: Books per Department -->
      <div class="col-md-6">
        <div class="card bg-dark text-white shadow">
          <div class="card-body">
            <h5 class="card-title">Books per Department</h5>
            <canvas id="barChart" height="200"></canvas>
          </div>
        </div>
      </div>

      <!-- Line Chart: Monthly Requests & Offers -->
      <div class="col-md-6">
        <div class="card bg-dark text-white shadow">
          <div class="card-body">
            <h5 class="card-title">Monthly Requests & Offers</h5>
            <canvas id="lineChart" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <!-- Pie Chart: Book Requests by Status -->
      <div class="col-md-6 col-lg-4">
        <div class="card bg-dark text-white shadow">
          <div class="card-body">
            <h5 class="card-title">Book Requests by Status</h5>
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
    // === Bar Chart: Books per Department ===
    new Chart(document.getElementById("barChart"), {
      type: 'bar',
      data: {
        labels: <?= json_encode($deptLabels) ?>,
        datasets: [{
          label: 'Books',
          data:    <?= json_encode($deptCounts) ?>,
          backgroundColor: '#0d6efd'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
      }
    });

    // === Line Chart: Monthly Requests & Offers ===
    new Chart(document.getElementById("lineChart"), {
      type: 'line',
      data: {
        labels: <?= json_encode($months) ?>,
        datasets: [
          {
            label: 'Book Requests',
            data: <?= json_encode($requestCounts) ?>,
            borderColor: '#ffc107',
            backgroundColor: 'rgba(255,193,7,0.2)',
            tension: 0.3,
            fill: true
          },
          {
            label: 'Book Offers',
            data: <?= json_encode($offerCounts) ?>,
            borderColor: '#0dcaf0',
            backgroundColor: 'rgba(13,202,240,0.2)',
            tension: 0.3,
            fill: true
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true, labels: { color: 'white' } }
        },
        scales: { y: { beginAtZero: true } }
      }
    });

    // === Pie Chart: Book Requests by Status ===
    new Chart(document.getElementById("pieChart"), {
      type: 'pie',
      data: {
        labels: <?= json_encode($statusLabels) ?>,
        datasets: [{
          data: <?= json_encode($statusCounts) ?>,
          // Chart.js will assign default segment colors
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom', labels: { color: 'white' } }
        }
      }
    });
  </script>

</body>
</html>
