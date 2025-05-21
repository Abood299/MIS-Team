<?php

session_start();

include('../includes/db.php');

// Prevent back-button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Restrict access to Super Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// ——— Handle CSV export ———
$filter   = trim($_GET['filter']   ?? '');
$search   = trim($_GET['search']   ?? '');
$whereClauses = [];
if ($filter !== '') {
    $whereClauses[] = "books.department_id = " . (int)$filter;
}
if ($search !== '') {
    $s = mysqli_real_escape_string($conn, $search);
    $whereClauses[] = "( books.id = '".(int)$s."'
                       OR books.book_name       LIKE '%$s%' 
                       OR books.book_material   LIKE '%$s%' )";
}
$whereSQL = $whereClauses
           ? "WHERE " . implode(" AND ", $whereClauses)
           : "";

if (isset($_GET['export']) && $_GET['export']==='csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="books_report_'.date('Ymd').'.csv"');
    $out = fopen('php://output','w');
    // CSV header
    fputcsv($out, ['ID','Book Name','Material','Department']);
    // Fetch
    $res = $conn->query("
      SELECT books.id, books.book_name, books.book_material, departments.department_name
        FROM books
        JOIN departments ON books.department_id = departments.id
        $whereSQL
        ORDER BY books.id DESC
    ");
    while ($row = $res->fetch_assoc()) {
        fputcsv($out, [
            $row['id'],
            $row['book_name'],
            $row['book_material'],
            $row['department_name']
        ]);
    }
    fclose($out);
    exit;
}

// ——— Add / Edit / Delete Book ———
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['add_book'])) {
        $stmt = $conn->prepare(
          "INSERT INTO books
             (book_name, book_material, department_id, year)
           VALUES (?,?,?,?)"
        );
        $stmt->bind_param(
          "ssis",
          $_POST['book_name'],
          $_POST['book_material'],
          $_POST['department_id'],
          $_POST['year']
        );
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['edit_book'])) {
        $stmt = $conn->prepare(
          "UPDATE books
              SET book_name     = ?,
                  book_material = ?,
                  year          = ?
            WHERE id = ?"
        );
        $stmt->bind_param(
          "sssi",
          $_POST['book_name'],
          $_POST['book_material'],
          $_POST['year'],
          $_POST['book_id']
        );
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['delete_book'])) {
        $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
        $stmt->bind_param("i", $_POST['book_id']);
        $stmt->execute();
        $stmt->close();
    }
}

// ——— Fetch for display ———
$books       = $conn->query("
    SELECT books.*, departments.department_name 
      FROM books 
      JOIN departments ON books.department_id = departments.id
      $whereSQL
      ORDER BY books.id DESC
");
$departments = $conn->query("SELECT * FROM departments");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Books</title>
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

 <?php include __DIR__ . '/../includes/admin_nav.php'; ?>

  <div class="container">

    <h2 class="mb-4 text-center">Manage Books</h2>

    <!-- ─── Search + Filter + Print/CSV ─── -->
    <div class="d-flex mb-4 align-items-center no-print">
      <form method="GET" class="d-flex flex-grow-1 align-items-center me-2">
        <div class="input-group">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by ID, name, material…"
            value="<?= htmlspecialchars($search) ?>"
          >
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
        <select
          name="filter"
          class="form-select ms-2"
          style="width: 180px;"
          onchange="this.form.submit()"
        >
          <option value="">All Majors</option>
          <?php
          mysqli_data_seek($departments,0);
          while($d = mysqli_fetch_assoc($departments)): ?>
            <option
              value="<?= $d['id'] ?>"
              <?= $filter==(string)$d['id']?'selected':'' ?>
            >
              <?= htmlspecialchars($d['department_name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </form>

      <button class="btn btn-outline-light me-2" onclick="window.print()">
        Print
      </button>
      <a
        href="?export=csv
          <?= $filter   ? '&filter='.urlencode($filter) : '' ?>
          <?= $search   ? '&search='.urlencode($search) : '' ?>"
        class="btn btn-outline-light"
      >
        Download CSV
      </a>
    </div>

    <!-- Add Book Form -->
    <form method="POST" class="row g-3 bg-secondary p-4 rounded mb-5 no-print">
      <div class="col-md-3">
        <label class="form-label">Book Name</label>
        <input
          type="text"
          name="book_name"
          class="form-control"
          required
        >
      </div>
      <div class="col-md-3">
        <label class="form-label">Material (URL)</label>
        <input
          type="text"
          name="book_material"
          class="form-control"
          required
        >
      </div>
      <div class="col-md-3">
        <label class="form-label">Year</label>
        <select name="year" class="form-select" required>
          <option value="" disabled selected>اختر السنة</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Department</label>
        <select name="department_id" class="form-select" required>
          <option value="" disabled selected>Select Major</option>
          <?php
            mysqli_data_seek($departments,0);
            while($dept = mysqli_fetch_assoc($departments)): ?>
              <option value="<?= $dept['id'] ?>">
                <?= htmlspecialchars($dept['department_name']) ?>
              </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-12 text-end">
        <button name="add_book" class="btn btn-success">Add Book</button>
      </div>
    </form>

    <!-- Books Table -->
    <div class="table-responsive px-1">
      <table class="table table-dark table-striped table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Book Name</th>
            <th>Material</th>
            <th>Year</th>              <!-- ← added -->
            <th>Department</th>
            <th class="no-print">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($b = mysqli_fetch_assoc($books)): ?>
          <tr>
            <form method="POST">
              <td><?= $b['id'] ?></td>
              <td>
                <input
                  type="text"
                  name="book_name"
                  value="<?= htmlspecialchars($b['book_name']) ?>"
                  class="form-control"
                  required
                >
              </td>
              <td>
                <input
                  type="text"
                  name="book_material"
                  value="<?= htmlspecialchars($b['book_material']) ?>"
                  class="form-control"
                  required
                >
              </td>
              <td>
                <!-- display/edit year next to material -->
                <select name="year" class="form-select" required>
                  <option value="1" <?= $b['year']==='1' ? 'selected' : '' ?>>1</option>
                  <option value="2" <?= $b['year']==='2' ? 'selected' : '' ?>>2</option>
                  <option value="3" <?= $b['year']==='3' ? 'selected' : '' ?>>3</option>
                  <option value="4" <?= $b['year']==='4' ? 'selected' : '' ?>>4</option>
                </select>
              </td>
              <td><?= htmlspecialchars($b['department_name']) ?></td>
              <td class="no-print">
                <input type="hidden" name="book_id" value="<?= $b['id'] ?>">
                <button name="edit_book" class="btn btn-sm btn-success mb-1">
                  Edit
                </button>
            </form>
                <form method="POST" class="d-inline">
                  <input type="hidden" name="book_id" value="<?= $b['id'] ?>">
                  <button
                    name="delete_book"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Delete this book?')"
                  >
                    Delete
                  </button>
                </form>
              </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div><!-- /.container -->

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
