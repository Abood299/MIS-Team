<?php

session_start();

include('../includes/db.php');

// Ensure $search is always defined
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Only super-admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Handle Add / Edit / Delete, then redirect to avoid duplicate insert on refresh
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Add
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

    // Edit
    if (isset($_POST['edit_staff'])) {
        $stmt = $conn->prepare("
          UPDATE academic_staff
             SET name=?, email=?, linkedin=?, image=?, office_location=?, department_id=?
           WHERE id=?
        ");
        $stmt->bind_param(
          "sssssii",
          $_POST['name'],
          $_POST['email'],
          $_POST['linkedin'],
          $_POST['image'],
          $_POST['office_location'],
          $_POST['department_id'],
          $_POST['staff_id']
        );
        $stmt->execute();
        $stmt->close();
    }

    // Delete
    if (isset($_POST['delete_staff'])) {
        $id = (int)$_POST['staff_id'];
        $conn->query("DELETE FROM academic_staff WHERE id = $id");
    }

    // Redirect to GET to prevent duplicate submissions
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch all departments for dropdown
$departments = $conn->query("SELECT id, department_name FROM departments ORDER BY department_name");

// Fetch all staff (filter client-side)
$sql   = "SELECT a.*, d.department_name
            FROM academic_staff a
       LEFT JOIN departments d ON a.department_id = d.id
        ORDER BY a.id";
$staff = $conn->query($sql);
if (!$staff) {
    throw new mysqli_sql_exception($conn->error);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title>Manage Academic Staff</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    @media print { .no-print { display: none !important; } }
    body { background: #343a40; color: #fff; direction: ltr; }
    .table td, .table th { vertical-align: middle; }
  </style>
</head>
<body class="p-4 bg-dark text-white ">

  <?php include __DIR__ . '/../includes/admin_nav.php'; ?>

  <div class="container-fluid">
    <h2 class="my-4 text-center">Academic Staff Management</h2>

    <!-- Search + Filter + CSV/Print -->
    <form method="GET" class="row g-2 mb-4 no-print">
      <div class="col-md-5">
        <div class="input-group">
          <input
            id="searchStaff"
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by name, email, department…"
            value="<?= htmlspecialchars($search) ?>"
          >
          <button class="btn btn-primary" type="button" onclick="filterTable()">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3">
        <select id="deptFilter" name="filter" class="form-select">
          <option value="0">All Departments</option>
          <?php while ($d = $departments->fetch_assoc()): ?>
            <option value="<?= $d['id'] ?>">
              <?= htmlspecialchars($d['department_name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-4 text-end">
        <button type="button" class="btn btn-outline-light me-2" onclick="window.print()">
          <i class="fas fa-print"></i> Print
        </button>
        <a href="?export=csv" class="btn btn-outline-light">
          <i class="fas fa-file-csv"></i> Export CSV
        </a>
      </div>
    </form>

    <!-- Add New Staff -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 no-print text-white">
      <h4 class="mb-4">Add New Staff Member</h4>
      <div class="row g-3">
        <div class="col-md-2">
          <input name="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="col-md-2">
          <input name="email" type="email" class="form-control" placeholder="Email Address" required>
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
            <option value="">Select Department</option>
            <?php
              // Reset pointer and repopulate
              $departments->data_seek(0);
              while ($d = $departments->fetch_assoc()):
            ?>
              <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['department_name']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="text-end mt-4">
        <button name="add_staff" class="btn btn-success">
          <i class="fas fa-plus"></i> Add
        </button>
      </div>
    </form>

    <!-- Staff Table -->
    <div class="table-responsive mb-5">
      <table class="table table-dark table-striped table-bordered text-center">
        <thead class="table-light text-dark">
          <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>LinkedIn</th>
            <th>Image URL</th><th>Office</th><th>Department</th><th class="no-print">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $staff->fetch_assoc()): ?>
            <form method="POST">
              <tr>
                <td><?= $row['id'] ?></td>
                <td><input name="name" value="<?= htmlspecialchars($row['name']) ?>" class="form-control form-control-sm"></td>
                <td><input name="email" value="<?= htmlspecialchars($row['email']) ?>" class="form-control form-control-sm"></td>
                <td><input name="linkedin" value="<?= htmlspecialchars($row['linkedin']) ?>" class="form-control form-control-sm"></td>
                <td><input name="image" value="<?= htmlspecialchars($row['image']) ?>" class="form-control form-control-sm"></td>
                <td><input name="office_location" value="<?= htmlspecialchars($row['office_location']) ?>" class="form-control form-control-sm"></td>
                <td>
                  <select name="department_id" class="form-select form-select-sm">
                    <?php
                      $departments->data_seek(0);
                      while ($d = $departments->fetch_assoc()):
                        $sel = $row['department_id'] == $d['id'] ? 'selected' : '';
                    ?>
                      <option value="<?= $d['id'] ?>" <?= $sel ?>>
                        <?= htmlspecialchars($d['department_name']) ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </td>
                <td class="no-print">
                  <input type="hidden" name="staff_id" value="<?= $row['id'] ?>">
                  <button name="edit_staff" class="btn btn-sm btn-success me-1"><i class="fas fa-check"></i></button>
                  <button name="delete_staff" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            </form>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div><!-- /.container -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchStaff');
      const deptFilter  = document.getElementById('deptFilter');
      const rows        = Array.from(document.querySelectorAll('table tbody tr'));

      function filterTable() {
        const term = searchInput.value.trim().toLowerCase();
        const dept = deptFilter.value;

        rows.forEach(row => {
          const nameVal  = row.querySelector('input[name="name"]').value.toLowerCase();
          const emailVal = row.querySelector('input[name="email"]').value.toLowerCase();
          const dSelect  = row.querySelector('select[name="department_id"]');
          const dName    = dSelect.options[dSelect.selectedIndex].text.toLowerCase();

          const matchesText = !term
                            || nameVal.includes(term)
                            || emailVal.includes(term)
                            || dName.includes(term);
          const matchesDept = dept === '0' || dSelect.value === dept;

          row.style.display = (matchesText && matchesDept) ? '' : 'none';
        });
      }

      searchInput.addEventListener('input', filterTable);
      deptFilter.addEventListener('change', filterTable);
      filterTable();
    });
  </script>
</body>
</html>
