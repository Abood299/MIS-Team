<?php
session_start(); // No condition here, just straight call
include('../includes/db.php');


// Prevent back-button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Restrict access to admin and super admin
if (!isset($_SESSION['user_id']) || 
   ($_SESSION['user_role'] !== 'admin' && $_SESSION['user_role'] !== 'super_admin')) {
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

// Fetch all books with department name
$books = $conn->query("
    SELECT books.*, departments.department_name 
    FROM books 
    JOIN departments ON books.department_id = departments.id
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
          <?php while ($dept = mysqli_fetch_assoc($departments)): ?>
            <option value="<?= $dept['id'] ?>"><?= $dept['department_name'] ?></option>
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
            <td><?= $book['id'] ?></td>
            <td><?= $book['book_name'] ?></td>
            <td><a href="<?= $book['book_material'] ?>" target="_blank">Open</a></td>
            <td><?= $book['department_name'] ?></td>
            <td>
              <form method="POST" class="d-inline">
                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                <button type="submit" name="delete_book" class="btn btn-danger btn-sm">Delete</button>
              </form>
              <!-- Optional: Add edit button logic later -->
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
