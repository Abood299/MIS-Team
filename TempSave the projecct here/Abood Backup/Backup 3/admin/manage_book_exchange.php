<?php

session_start();

include('../includes/db.php');

// Only 🔴Super Admins can access
if (empty($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Fetch departments
$departments = mysqli_query($conn, "SELECT * FROM departments ORDER BY department_name");

// Filter & Search logic
$filter = $_GET['filter'] ?? '';
$search = trim($_GET['search'] ?? '');
$where = [];
if ($filter) {
    $where[] = "be.department_id = " . intval($filter);
}
if ($search !== '') {
    $s = mysqli_real_escape_string($conn, $search);
    $where[] = "be.book_name LIKE '%$s%'";
}
$whereClause = $where ? 'WHERE '.implode(' AND ', $where) : '';

// Add Book
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add_book'])) {
    $name  = $_POST['book_name'];
    $img   = $_POST['image'];
    $dep   = (int)$_POST['department_id'];
    $stmt  = $conn->prepare("INSERT INTO book_exchange (book_name, image, department_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi",$name,$img,$dep);
    $stmt->execute();
    $stmt->close();
}

// Delete Book
if (isset($_POST['delete_book'])) {
    $id = (int)$_POST['book_id'];
    mysqli_query($conn, "DELETE FROM book_exchange WHERE id = $id");
}

// Edit Book
if (isset($_POST['edit_book'])) {
    $id   = (int)$_POST['book_id'];
    $name = $_POST['book_name'];
    $img  = $_POST['image'];
    $dep  = (int)$_POST['department_id'];
    $stmt = $conn->prepare("UPDATE book_exchange SET book_name=?, image=?, department_id=? WHERE id=?");
    $stmt->bind_param("ssii",$name,$img,$dep,$id);
    $stmt->execute();
    $stmt->close();
}

// Fetch books
$books = mysqli_query($conn, "
  SELECT be.id, be.book_name, be.image, be.department_id, d.department_name
    FROM book_exchange AS be
    JOIN departments AS d ON be.department_id = d.id
    $whereClause
    ORDER BY be.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Book Exchange</title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
  <link 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    rel="stylesheet"
  >
</head><?php include __DIR__ . '/../includes/admin_nav.php'; ?>
<body class="bg-dark text-white p-4">

      <h2 class="my-4 text-center">Manage Book Exchange</h2>

  


    <!-- Search & Filter -->
    <form method="GET" class="row g-2 align-items-center mb-4">
      <div class="col-md-6">
        <input 
          type="text" 
          name="search" 
          value="<?= htmlspecialchars($search) ?>" 
          class="form-control" 
          placeholder="Search books…"
        >
      </div>
      <div class="col-md-4">
        <select 
          name="filter" 
          class="form-select" 
          onchange="this.form.submit()"
        >
          <option value="">All Majors</option>
          <?php 
          mysqli_data_seek($departments, 0);
          while ($d = mysqli_fetch_assoc($departments)): 
          ?>
            <option 
              value="<?= $d['id'] ?>" 
              <?= $filter == $d['id'] ? 'selected' : '' ?>
            >
              <?= htmlspecialchars($d['department_name']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-2 text-end">
        <button class="btn btn-secondary">Go</button>
      </div>
    </form>

    <!-- Add New Book -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 text-white">
      <h4 class="mb-4">Add New Book</h4>
      <div class="row g-3">
        <div class="col-md-4">
          <input 
            type="text" 
            name="book_name" 
            placeholder="Book Name" 
            class="form-control" 
            required
          >
        </div>
        <div class="col-md-4">
          <input 
            type="url" 
            name="image" 
            placeholder="Image URL" 
            class="form-control"
          >
        </div>
        <div class="col-md-3">
          <select 
            name="department_id" 
            class="form-select" 
            required
          >
            <option value="">Select Major</option>
            <?php 
            mysqli_data_seek($departments, 0);
            while ($d = mysqli_fetch_assoc($departments)): 
            ?>
              <option value="<?= $d['id'] ?>">
                <?= htmlspecialchars($d['department_name']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-1">
          <button 
            type="submit" 
            name="add_book" 
            class="btn btn-success w-100"
          >
            Add
          </button>
        </div>
      </div>
    </form>

    <!-- Books Table -->
    <table class="table table-dark table-striped table-bordered text-center shadow-sm">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Book Name</th>
          <th>Image URL</th>
          <th>Major</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($books)): ?>
        <tr>
          <form method="POST">
            <td><?= $row['id'] ?></td>
            <td>
              <input 
                type="text" 
                name="book_name" 
                value="<?= htmlspecialchars($row['book_name']) ?>" 
                class="form-control form-control-sm"
              >
            </td>
            <td>
              <input 
                type="url" 
                name="image" 
                value="<?= htmlspecialchars($row['image']) ?>" 
                class="form-control form-control-sm"
              >
            </td>
            <td>
              <select name="department_id" class="form-select form-select-sm">
                <?php 
                mysqli_data_seek($departments, 0);
                while ($d = mysqli_fetch_assoc($departments)): 
                ?>
                  <option 
                    value="<?= $d['id'] ?>" 
                    <?= $d['id']==$row['department_id'] ? 'selected' : '' ?>
                  >
                    <?= htmlspecialchars($d['department_name']) ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </td>
            <td>
              <input type="hidden" name="book_id" value="<?= $row['id'] ?>">
              <button 
                name="edit_book" 
                class="btn btn-sm btn-success me-1"
              >
                Edit
              </button>
              <button 
                name="delete_book" 
                class="btn btn-sm btn-danger" 
                onclick="return confirm('Delete this book?')"
              >
                Delete
              </button>
            </td>
          </form>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  

  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
