<?php
session_start();
include('../includes/db.php');

// Prevent back-button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Restrict access to Super Admin only (users are not allowed)
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Add book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $name = $_POST['book_name'];
    $material = $_POST['book_material'];
    $department_id = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO books (book_name, book_material, department_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $material, $department_id);
    $stmt->execute();
    $stmt->close();
}

// Delete book
if (isset($_POST['delete_book'])) {
    $book_id = $_POST['book_id'];
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->close();
}

// Edit book
if (isset($_POST['edit_book'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $book_material = $_POST['book_material'];

    $stmt = $conn->prepare("UPDATE books SET book_name = ?, book_material = ? WHERE id = ?");
    $stmt->bind_param("ssi", $book_name, $book_material, $book_id);
    $stmt->execute();
    $stmt->close();
}

// Filter logic
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$whereClause = $filter ? "WHERE books.department_id = " . intval($filter) : "";

// Fetch filtered books
$books = $conn->query("
    SELECT books.*, departments.department_name 
    FROM books 
    JOIN departments ON books.department_id = departments.id
    $whereClause
");

// Fetch departments for dropdown
$departments = $conn->query("SELECT * FROM departments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">
  <div class="container">
    <h2 class="mb-4 text-center">Manage Books</h2>

    <!-- Filter Dropdown -->
    <form method="GET" class="mb-4">
      <div class="row g-2">
        <div class="col-md-4">
          <select name="filter" class="form-select" onchange="this.form.submit()">
            <option value="">All Majors</option>
            <?php mysqli_data_seek($departments, 0); while ($dept = mysqli_fetch_assoc($departments)): ?>
              <option value="<?= $dept['id'] ?>" <?= $filter == $dept['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($dept['department_name']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
    </form>

    <!-- Add Book Form -->
    <form method="POST" class="row g-3 bg-secondary p-4 rounded mb-5">
      <div class="col-md-4">
        <label class="form-label">Book Name</label>
        <input type="text" name="book_name" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Book Material (URL)</label>
        <input type="text" name="book_material" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Department</label>
        <select name="department_id" class="form-select" required>
          <option disabled selected>Select Major</option>
          <?php mysqli_data_seek($departments, 0); while ($dept = mysqli_fetch_assoc($departments)): ?>
            <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-12 text-end">
        <button type="submit" name="add_book" class="btn btn-success">Add Book</button>
      </div>
    </form>

    <!-- Books Table -->
    <table class="table table-dark table-striped table-bordered text-center">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Book Name</th>
          <th>Material</th>
          <th>Department</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($book = mysqli_fetch_assoc($books)): ?>
          <tr>
            <form method="POST">
              <td><?= $book['id'] ?></td>
              <td>
                <input type="text" name="book_name" value="<?= htmlspecialchars($book['book_name']) ?>" class="form-control" required>
              </td>
              <td>
                <input type="text" name="book_material" value="<?= htmlspecialchars($book['book_material']) ?>" class="form-control" required>
              </td>
              <td><?= htmlspecialchars($book['department_name']) ?></td>
              <td>
                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                <button type="submit" name="edit_book" class="btn btn-sm btn-success mb-1">Edit</button>
            </form>
            <form method="POST" class="d-inline">
              <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
              <button type="submit" name="delete_book" class="btn btn-sm btn-danger" onclick="return confirm('Delete this book?')">Delete</button>
            </form>
              </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
