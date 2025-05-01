<?php
session_start();
include('../includes/db.php');

// Only super admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Fetch departments
$departments = mysqli_query($conn, "SELECT * FROM departments");

// Grab filter & search from GET
$filter = isset($_GET['filter']) ? (int)$_GET['filter'] : 0;
$search = trim($_GET['search'] ?? '');

// Build WHERE clauses
$where = [];
if ($filter) {
    $where[] = "academic_staff.department_id = $filter";
}
if ($search !== '') {
    $s = mysqli_real_escape_string($conn, $search);
    $where[] = "(academic_staff.name LIKE '%$s%' 
                OR academic_staff.email LIKE '%$s%' 
                OR departments.department_name LIKE '%$s%')";
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// ——— CSV Export ———
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="staff_report_'.date('Ymd').'.csv"');
    $out = fopen('php://output','w');
    fputcsv($out, ['ID','Name','Email','LinkedIn','Image URL','Office','Department']);
    $res = $conn->query("
      SELECT academic_staff.id,
             academic_staff.name,
             academic_staff.email,
             academic_staff.linkedin,
             academic_staff.image,
             academic_staff.office_location,
             departments.department_name
        FROM academic_staff
        JOIN departments ON academic_staff.department_id = departments.id
        $whereSql
        ORDER BY academic_staff.id DESC
    ");
    while ($row = $res->fetch_assoc()) {
        fputcsv($out, [
            $row['id'],
            $row['name'],
            $row['email'],
            $row['linkedin'],
            $row['image'],
            $row['office_location'],
            $row['department_name']
        ]);
    }
    fclose($out);
    exit;
}

// ——— Handle Add / Edit / Delete ———
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_staff'])) {
        $stmt = $conn->prepare("
          INSERT INTO academic_staff 
            (name, email, linkedin, image, office_location, department_id)
          VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
          "sssssi",
          $_POST['name'],
          $_POST['email'],
          $_POST['linkedin'],
          $_POST['image'],
          $_POST['office_location'],
          $_POST['department_id']
        );
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['edit_staff'])) {
        $stmt = $conn->prepare("
          UPDATE academic_staff 
             SET name=?, email=?, linkedin=?, image=?, office_location=? 
           WHERE id=?
        ");
        $stmt->bind_param(
          "sssssi",
          $_POST['name'],
          $_POST['email'],
          $_POST['linkedin'],
          $_POST['image'],
          $_POST['office_location'],
          $_POST['staff_id']
        );
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['delete_staff'])) {
        $id = (int)$_POST['staff_id'];
        $conn->query("DELETE FROM academic_staff WHERE id = $id");
    }
}

// Fetch staff list
$staff = $conn->query("
  SELECT academic_staff.*, departments.department_name
    FROM academic_staff
    JOIN departments ON academic_staff.department_id = departments.id
    $whereSql
    ORDER BY academic_staff.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Academic Staff</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap & FontAwesome -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
  >
  <style>
    @media print { .no-print { display: none !important; } }
  </style>
</head>
<body class="bg-dark text-white p-4">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 mb-3 no-print">
    <div class="container-fluid px-4">
      <a class="navbar-brand" href="dashboard.php">
        <i class="fas fa-tachometer-alt me-1"></i>Back to Dashboard
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item me-3">
            <a class="nav-link position-relative" href="#">
              <i class="fas fa-bell text-warning"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
            </a>
          </li>
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

  <!-- PAGE CONTENT -->
  <div class="container-fluid px-5">

    <h2 class="mb-4 text-center">Manage Academic Staff</h2>

    <!-- Search + Filter + Print/CSV -->
    <form method="GET" class="row g-2 mb-4 no-print">
      <div class="col-md-5">
        <div class="input-group">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by name, email, department…"
            value="<?= htmlspecialchars($search) ?>"
          >
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div>
      <div class="col-md-3">
        <select name="filter" class="form-select" onchange="this.form.submit()">
          <option value="0">All Departments</option>
          <?php 
            mysqli_data_seek($departments, 0);
            while ($d = mysqli_fetch_assoc($departments)): ?>
            <option
              value="<?= $d['id'] ?>"
              <?= $filter === (int)$d['id'] ? 'selected' : '' ?>
            >
              <?= htmlspecialchars($d['department_name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-4 text-end">
        <button class="btn btn-outline-light me-2" onclick="window.print()">Print</button>
        <a
          href="?export=csv<?= $filter ? '&filter='.$filter : '' ?><?= $search ? '&search='.urlencode($search) : '' ?>"
          class="btn btn-outline-light"
        >
          Download CSV
        </a>
      </div>
    </form>

    <!-- Add Staff Form -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 no-print">
      <h4 class="mb-4">Add New Staff</h4>
      <div class="row g-3">
        <div class="col-md-2">
          <input name="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="col-md-2">
          <input name="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="col-md-2">
          <input name="linkedin" class="form-control" placeholder="LinkedIn URL">
        </div>
        <div class="col-md-2">
          <input name="image" class="form-control" placeholder="Image URL">
        </div>
        <div class="col-md-2">
          <input name="office_location" class="form-control" placeholder="Office Location">
        </div>
        <div class="col-md-2">
          <select name="department_id" class="form-select" required>
            <option value="">Select Dept</option>
            <?php 
              mysqli_data_seek($departments, 0);
              while ($d = mysqli_fetch_assoc($departments)): ?>
              <option value="<?= $d['id'] ?>">
                <?= htmlspecialchars($d['department_name']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="text-end mt-4">
        <button name="add_staff" class="btn btn-success">Add Staff</button>
      </div>
    </form>

    <!-- Staff Table -->
    <div class="table-responsive mb-5 mx-n2 px-2">
      <table class="table table-dark table-striped table-bordered text-center shadow-sm">
        <thead class="table-light">
          <tr>
            <th>ID</th><th>Name</th><th>Email</th>
            <th>LinkedIn</th><th>Image</th><th>Office</th>
            <th>Department</th><th class="no-print">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($staff)): ?>
          <tr>
            <form method="POST">
              <td><?= $row['id'] ?></td>
              <td>
                <input
                  name="name"
                  value="<?= htmlspecialchars($row['name']) ?>"
                  class="form-control"
                >
              </td>
              <td>
                <input
                  name="email"
                  value="<?= htmlspecialchars($row['email']) ?>"
                  class="form-control"
                >
              </td>
              <td>
                <input
                  name="linkedin"
                  value="<?= htmlspecialchars($row['linkedin']) ?>"
                  class="form-control"
                >
              </td>
              <td>
                <input
                  name="image"
                  value="<?= htmlspecialchars($row['image']) ?>"
                  class="form-control"
                >
              </td>
              <td>
                <input
                  name="office_location"
                  value="<?= htmlspecialchars($row['office_location']) ?>"
                  class="form-control"
                >
              </td>
              <td><?= htmlspecialchars($row['department_name']) ?></td>
              <td class="no-print">
                <input type="hidden" name="staff_id" value="<?= $row['id'] ?>">
                <button name="edit_staff" class="btn btn-sm btn-success me-1">Edit</button>
                <button name="delete_staff" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this entry?')">
                  Delete
                </button>
              </td>
            </form>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div><!-- /.container -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
