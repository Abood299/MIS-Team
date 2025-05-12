<?php
session_start();
include('../includes/db.php');

// Only super admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Fetch all departments for filters and drop-downs
$departments = $conn->query("SELECT id, department_name FROM departments ORDER BY department_name");

// Handle filter & search
$filter = isset($_GET['filter']) ? (int)$_GET['filter'] : 0;
$search = trim($_GET['search'] ?? '');

$where = [];
if ($filter) {
    $where[] = "a.department_id = $filter";
}
if ($search !== '') {
    $s = $conn->real_escape_string($search);
    $where[] = "(a.name LIKE '%$s%' 
               OR a.email LIKE '%$s%' 
               OR d.department_name LIKE '%$s%')";
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// ──────────── DEBUG LOGGING ────────────
// This will write to your PHP error log. Remove once you’ve confirmed.
error_log("DEBUG [AcademicStaff] filter=" . json_encode($filter));
error_log("DEBUG [AcademicStaff] search=" . json_encode($search));

$sql = "
  SELECT * from academic_staff ";
error_log("DEBUG [AcademicStaff] SQL: " . $sql);
// ───────────────────────────────────────

$staff = $conn->query($sql);
if (!$staff) {
    throw new mysqli_sql_exception($conn->error);
}

// CSV Export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="staff_report_'.date('Ymd').'.csv"');
    $out = fopen('php://output','w');
    fputcsv($out, ['ID','Name','Email','LinkedIn','Image URL','Office','Department']);
    $res = $staff;  // already ran the same query above
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

// Handle Add / Edit / Delete
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
    if (isset($_POST['delete_staff'])) {
        $id = (int)$_POST['staff_id'];
        $conn->query("DELETE FROM academic_staff WHERE id = $id");
    }
    // after POST, re-fetch to see latest data
    $staff = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>Manage Academic Staff</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    @media print { .no-print { display: none !important; } }
    body { background: #343a40; color: #fff; }
    .table td, .table th { vertical-align: middle; }
  </style>
</head>
<body class="p-4">

  <?php include __DIR__ . '/../includes/admin_nav.php'; ?>

  <div class="container-fluid">
    <h2 class="my-4 text-center">لوحة إدارة الهيئة الأكاديمية</h2>

    <!-- Search + Filter + CSV/Print -->
    <form method="GET" class="row g-2 mb-4 no-print">
      <div class="col-md-5">
        <div class="input-group">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="ابحث بالاسم، البريد، القسم…"
            value="<?= htmlspecialchars($search) ?>"
          >
          <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
      </div>
      <div class="col-md-3">
        <select name="filter" class="form-select" onchange="this.form.submit()">
          <option value="0">كل الأقسام</option>
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
        <button type="button" class="btn btn-outline-light me-2" onclick="window.print()">
          <i class="fas fa-print"></i> طباعة
        </button>
        <a
          href="?export=csv<?= $filter ? '&filter='.$filter : '' ?><?= $search ? '&search='.urlencode($search) : '' ?>"
          class="btn btn-outline-light"
        >
          <i class="fas fa-file-csv"></i> CSV
        </a>
      </div>
    </form>

    <!-- Add New Staff -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 no-print text-white">
      <h4 class="mb-4">إضافة عضو جديد</h4>
      <div class="row g-3">
        <div class="col-md-2"><input name="name"            class="form-control" placeholder="الاسم الكامل"           required></div>
        <div class="col-md-2"><input name="email" type="email" class="form-control" placeholder="البريد الإلكتروني"      required></div>
        <div class="col-md-2"><input name="linkedin"         class="form-control" placeholder="LinkedIn URL"></div>
        <div class="col-md-2"><input name="image"            class="form-control" placeholder="رابط الصورة"></div>
        <div class="col-md-2"><input name="office_location" class="form-control" placeholder="موقع المكتب"></div>
        <div class="col-md-2">
          <select name="department_id" class="form-select" required>
            <option value="">اختر القسم</option>
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
        <button name="add_staff" class="btn btn-success">
          <i class="fas fa-plus"></i> إضافة
        </button>
      </div>
    </form>

    <!-- Staff Table -->
    <div class="table-responsive mb-5">
      <table class="table table-dark table-striped table-bordered text-center">
        <thead class="table-light text-dark">
          <tr>
            <th>ID</th>
            <th>الاسم</th>
            <th>البريد الإلكتروني</th>
            <th>LinkedIn</th>
            <th>رابط الصورة</th>
            <th>المكتب</th>
            <th>القسم</th>
            <th class="no-print">إجراءات</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($staff)): ?>
            <form method="POST">
              <tr>
                <td><?= $row['id'] ?></td>
                <td>
                  <input name="name"
                         value="<?= htmlspecialchars($row['name']) ?>"
                         class="form-control form-control-sm">
                </td>
                <td>
                  <input name="email"
                         value="<?= htmlspecialchars($row['email']) ?>"
                         class="form-control form-control-sm">
                </td>
                <td>
                  <input name="linkedin"
                         value="<?= htmlspecialchars($row['linkedin']) ?>"
                         class="form-control form-control-sm">
                </td>
                <td>
                  <input name="image"
                         value="<?= htmlspecialchars($row['image']) ?>"
                         class="form-control form-control-sm">
                </td>
                <td>
                  <input name="office_location"
                         value="<?= htmlspecialchars($row['office_location']) ?>"
                         class="form-control form-control-sm">
                </td>
                <td>
                  <select name="department_id" class="form-select form-select-sm">
                    <?php 
                      mysqli_data_seek($departments, 0);
                      while ($d = mysqli_fetch_assoc($departments)):
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
                  <button name="edit_staff"   class="btn btn-sm btn-success me-1">
                    <i class="fas fa-check"></i>
                  </button>
                  <button name="delete_staff" class="btn btn-sm btn-danger"
                          onclick="return confirm('هل تريد الحذف بالفعل؟')">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </form>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div><!-- /.container -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
