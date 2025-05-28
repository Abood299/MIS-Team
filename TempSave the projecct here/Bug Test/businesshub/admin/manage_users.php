<?php
ob_start();
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Only 🔴Super Admins can access
if (empty($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'super_admin') {
    header("Location: admin_login_page.php");
    exit;
}


header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include('../includes/db.php');
// ——— Handle Add / Update / Delete / Block actions ———
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['add_user'])) {
        $first = $_POST['first_name'];
        $last  = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass  = $_POST['password'];
        $role  = $_POST['role'];
        $stmt = $conn->prepare("
          INSERT INTO users 
            (first_name, last_name, email, phone, password, role) 
          VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssss", $first, $last, $email, $phone, $pass, $role);
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['change_role'])) {
        $id       = (int)$_POST['user_id'];
        $new_role = $_POST['new_role'];
        mysqli_query($conn, "UPDATE users SET role = '$new_role' WHERE id = $id");
    }
    if (isset($_POST['delete_user'])) {
        $id = (int)$_POST['user_id'];
        mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    }
    if (isset($_POST['toggle_block'])) {
        $id       = (int)$_POST['user_id'];
        $newState = (int)$_POST['new_state'];
        $stmt = $conn->prepare("UPDATE users SET is_blocked = ? WHERE id = ?");
        $stmt->bind_param("ii", $newState, $id);
        $stmt->execute();
        $stmt->close();
    }
}

// ——— Search Filter ———
$search = trim($_GET['search'] ?? '');
$whereSql = '';
if ($search !== '') {
    $s = mysqli_real_escape_string($conn, $search);
    $whereSql = "WHERE 
        id = '".(int)$s."' 
        OR first_name LIKE '%$s%' 
        OR last_name  LIKE '%$s%' 
        OR email      LIKE '%$s%' 
        OR phone      LIKE '%$s%'";
}

// ——— CSV Export ———
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="users_report_'.date('Ymd').'.csv"');
    $out = fopen('php://output','w');
    fputcsv($out, ['ID','First Name','Last Name','Email','Phone','Role','Created At','Status']);
    $res = mysqli_query($conn, "
      SELECT id, first_name, last_name, email, phone, role, created_at, is_blocked
        FROM users
        $whereSql
        ORDER BY created_at DESC
    ");
    while ($row = mysqli_fetch_assoc($res)) {
        fputcsv($out, [
            $row['id'],
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['phone'],
            $row['role'],
            $row['created_at'],
            $row['is_blocked'] ? 'Blocked' : 'Active'
        ]);
    }
    fclose($out);
    exit;
}

// ——— Fetch Users ———
$users = mysqli_query($conn, "
  SELECT id, first_name, last_name, email, phone, role, created_at, is_blocked
    FROM users
    $whereSql
    ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>

    /* Ensure print CSS hides action buttons */
    @media print {
      .no-print { display: none; }
    }
</style>

  
</head>
<?php
include __DIR__ . '/../includes/admin_nav.php'; ?>


<body class="bg-dark text-white p-4">
  <div class="container">
    <h2 class="mb-4 text-center">Manage Users</h2>

    <!-- Search + Export/Print Buttons -->
    <div class="d-flex mb-4 align-items-center no-print">
      <form method="GET" class="flex-grow-1 me-2">
        <div class="input-group">
          <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="Search by ID, name, email, or phone…" 
            value="<?= htmlspecialchars($search) ?>"
          >
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>
      <button class="btn btn-outline-light me-2" onclick="window.print()">Print Report</button>
      <a 
        href="?export=csv<?= $search ? '&search='.urlencode($search) : '' ?>" 
        class="btn btn-outline-light"
      >
        Download CSV
      </a>
    </div>

    <!-- Add User Form -->
    <form method="POST" class="bg-secondary p-4 rounded mb-5 text-white no-print">
      <h4 class="mb-4">Add New User</h4>
      <div class="row g-3">
        <div class="col-md-2">
          <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
        </div>
        <div class="col-md-2">
          <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
        </div>
        <div class="col-md-2">
          <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="col-md-2">
          <input type="text" name="phone" placeholder="Phone" class="form-control" required>
        </div>
        <div class="col-md-2">
          <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="col-md-2">
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
    <table class="table table-dark table-striped table-bordered text-center shadow-sm">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Role</th>
          <th>Created At</th>
          <th>Status</th>
          <th class="no-print">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($u = mysqli_fetch_assoc($users)): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= htmlspecialchars($u['first_name']) ?></td>
          <td><?= htmlspecialchars($u['last_name']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= htmlspecialchars($u['phone']) ?></td>
          <td><?= $u['role'] ?></td>
          <td><?= $u['created_at'] ?></td>
          <td><?= $u['is_blocked'] ? 'Blocked' : 'Active' ?></td>
          <td class="no-print">
            <!-- Update Role -->
            <form method="POST" class="d-inline me-1">
              <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
              <select name="new_role" class="form-select d-inline w-auto">
                <option value="user" <?= $u['role']==='user' ? 'selected' : '' ?>>User</option>
                <option value="super_admin" <?= $u['role']==='super_admin' ? 'selected' : '' ?>>Super Admin</option>
              </select>
              <button name="change_role" class="btn btn-sm btn-success">Update</button>
            </form>

            <!-- Block / Unblock -->
            <form method="POST" class="d-inline me-1">
              <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
              <input type="hidden" name="new_state" value="<?= $u['is_blocked'] ? 0 : 1 ?>">
              <button name="toggle_block"
                      class="btn btn-sm <?= $u['is_blocked'] ? 'btn-success' : 'btn-warning' ?>">
                <?= $u['is_blocked'] ? 'Unblock' : 'Block' ?>
              </button>
            </form>

            <!-- Delete User -->
            <form method="POST" class="d-inline">
              <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
              <button name="delete_user" class="btn btn-sm btn-danger"
                      onclick="return confirm('Delete this user?')">
                Delete
              </button>
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
