<?php
session_start();
include('../includes/db.php');

// Only Super Admins are allowed to access
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Fetch departments
$departments = mysqli_query($conn, "SELECT * FROM departments");

// Filter logic
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$whereClause = $filter ? "WHERE department_id = " . intval($filter) : "";

// Add Course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_course'])) {
    $name = $_POST['course_name'];
    $link = $_POST['course_link'];
    $desc = $_POST['course_description'];
    $department_id = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO courses (course_name, course_link, course_description, department_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $link, $desc, $department_id);
    $stmt->execute();
    $stmt->close();
}

// Delete Course
if (isset($_POST['delete_course'])) {
    $id = $_POST['course_id'];
    mysqli_query($conn, "DELETE FROM courses WHERE id = $id");
}

// Edit Course
if (isset($_POST['edit_course'])) {
    $id = $_POST['course_id'];
    $name = $_POST['course_name'];
    $link = $_POST['course_link'];
    $desc = $_POST['course_description'];
    $stmt = $conn->prepare("UPDATE courses SET course_name=?, course_link=?, course_description=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $link, $desc, $id);
    $stmt->execute();
    $stmt->close();
}

$courses = mysqli_query($conn, "SELECT courses.*, departments.department_name FROM courses JOIN departments ON courses.department_id = departments.id $whereClause");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Courses</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white p-4">
  <div class="container">
    <h2 class="mb-4 text-center">Manage Courses</h2>

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

    <!-- Add Course Form -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 text-white">
      <h4 class="mb-4">Add New Course</h4>
      <div class="row g-3">
        <div class="col-md-3">
          <input type="text" name="course_name" placeholder="Course Name" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="course_link" placeholder="Course Link" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="course_description" placeholder="Course Description" class="form-control" required>
        </div>
        <div class="col-md-3">
          <select name="department_id" class="form-select" required>
            <option value="">Select Major</option>
            <?php mysqli_data_seek($departments, 0); while ($dept = mysqli_fetch_assoc($departments)): ?>
              <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="text-end mt-4">
        <button type="submit" name="add_course" class="btn btn-success">Add Course</button>
      </div>
    </form>

    <!-- Course Table -->
    <table class="table table-dark table-striped table-bordered text-center shadow-sm">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Link</th>
          <th>Description</th>
          <th>Major</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($course = mysqli_fetch_assoc($courses)): ?>
        <tr>
          <form method="POST">
            <td><?= $course['id'] ?></td>
            <td><input type="text" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" class="form-control"></td>
            <td><input type="text" name="course_link" value="<?= htmlspecialchars($course['course_link']) ?>" class="form-control"></td>
            <td><input type="text" name="course_description" value="<?= htmlspecialchars($course['course_description']) ?>" class="form-control"></td>
            <td><?= htmlspecialchars($course['department_name']) ?></td>
            <td>
              <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
              <button name="edit_course" class="btn btn-sm btn-success">Edit</button>
              <button name="delete_course" class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">Delete</button>
            </td>
          </form>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
