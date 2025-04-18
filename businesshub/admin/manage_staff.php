<?php
// Always start the session first before anything else
session_start();
include('../includes/db.php');

// Restrict access to Super Admin only (users with admin role are not allowed)
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

// Prevent back-button access after logout
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Fetch departments for filtering and forms
$departments = mysqli_query($conn, "SELECT * FROM departments");

// Filter logic
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$whereClause = $filter ? "WHERE academic_staff.department_id = " . intval($filter) : "";

// Add new staff
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_staff'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $linkedin = $_POST['linkedin'];
    $image = $_POST['image'];
    $office = $_POST['office_location'];
    $department_id = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO academic_staff (name, email, linkedin, image, office_location, department_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $email, $linkedin, $image, $office, $department_id);
    $stmt->execute();
    $stmt->close();
}

// Delete staff
if (isset($_POST['delete_staff'])) {
    $id = $_POST['staff_id'];
    mysqli_query($conn, "DELETE FROM academic_staff WHERE id = $id");
}

// Update staff
if (isset($_POST['edit_staff'])) {
    $id = $_POST['staff_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $linkedin = $_POST['linkedin'];
    $image = $_POST['image'];
    $office = $_POST['office_location'];

    $stmt = $conn->prepare("UPDATE academic_staff SET name=?, email=?, linkedin=?, image=?, office_location=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $email, $linkedin, $image, $office, $id);
    $stmt->execute();
    $stmt->close();
}

// Get staff list with department name
$staff = $conn->query("
    SELECT academic_staff.*, departments.department_name 
    FROM academic_staff 
    JOIN departments ON academic_staff.department_id = departments.id 
    $whereClause
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Academic Staff</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white p-4">
  <div class="container">
    <h2 class="mb-4 text-center">Manage Academic Staff</h2>

    <!-- Filter by Department -->
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

    <!-- Add Staff Form -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 text-white">
      <h4 class="mb-4">Add New Staff</h4>
      <div class="row g-3">
        <div class="col-md-2">
          <input name="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="col-md-2">
          <input name="email" class="form-control" placeholder="Email" required>
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
            <option value="">Select Major</option>
            <?php mysqli_data_seek($departments, 0); while ($dept = mysqli_fetch_assoc($departments)): ?>
              <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
      </div>
      <div class="text-end mt-4">
        <button name="add_staff" type="submit" class="btn btn-success">Add Staff</button>
      </div>
    </form>

    <!-- Staff Table -->
    <table class="table table-dark table-striped table-bordered text-center shadow-sm">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>LinkedIn</th>
          <th>Image</th>
          <th>Office</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($staff)): ?>
        <tr>
          <form method="POST">
            <td><?= $row['id'] ?></td>
            <td><input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" class="form-control"></td>
            <td><input type="text" name="email" value="<?= htmlspecialchars($row['email']) ?>" class="form-control"></td>
            <td><input type="text" name="linkedin" value="<?= htmlspecialchars($row['linkedin']) ?>" class="form-control"></td>
            <td><input type="text" name="image" value="<?= htmlspecialchars($row['image']) ?>" class="form-control"></td>
            <td><input type="text" name="office_location" value="<?= htmlspecialchars($row['office_location']) ?>" class="form-control"></td>
            <td><?= htmlspecialchars($row['department_name']) ?></td>
            <td>
              <input type="hidden" name="staff_id" value="<?= $row['id'] ?>">
              <button name="edit_staff" class="btn btn-sm btn-success">Edit</button>
              <button name="delete_staff" class="btn btn-sm btn-danger" onclick="return confirm('Delete this entry?')">Delete</button>
            </td>
          </form>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
