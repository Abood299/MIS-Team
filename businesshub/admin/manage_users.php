<?php
ob_start();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Only super admins can access
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include('../includes/db.php');

// Add User
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // No hashing
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();
    $stmt->close();
}

// Change Role
if (isset($_POST['change_role'])) {
    $id = $_POST['user_id'];
    $new_role = $_POST['new_role'];
    mysqli_query($conn, "UPDATE users SET role = '$new_role' WHERE id = $id");
}

// Delete User
if (isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
}

$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white p-4">
  <div class="container">
    <h2 class="mb-4 text-center">Manage Users</h2>

    <!-- Add User Form -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 text-white">
      <h4 class="mb-4">Add New User</h4>

      <div class="row g-3">
        <div class="col-md-3">
          <input type="text" name="name" placeholder="Full Name" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="col-md-3">
          <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="col-md-3">
          <select name="role" class="form-select">
            <option value="user">User</option>
            <option value="super_admin">Super Admin</option>
          </select>
        </div>
      </div>

      <div class="text-end mt-4">
        <button type="submit" name="add_user" class="btn btn-success">Add User</button>
      </div>
    </form>

    <!-- Users Table -->
    <table class="table table-dark table-striped table-bordered text-center shadow-sm mt-5">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($user = mysqli_fetch_assoc($users)): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= htmlspecialchars($user['name']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= $user['role'] ?></td>
          <td>
            <!-- Update Role -->
            <form method="POST" class="d-inline">
              <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
              <select name="new_role" class="form-select d-inline w-auto">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="super_admin" <?= $user['role'] === 'super_admin' ? 'selected' : '' ?>>Super Admin</option>
              </select>
              <button name="change_role" class="btn btn-sm btn-success">Update</button>
            </form>

            <!-- Delete User -->
            <form method="POST" class="d-inline">
              <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
              <button name="delete_user" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
