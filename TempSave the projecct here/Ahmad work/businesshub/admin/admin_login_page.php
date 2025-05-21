<?php
// /businesshub/admin/login.php

// 1) Configure a dedicated admin session cookie:
session_name('ADMINSESSID');
session_set_cookie_params([
  'lifetime' => 0,                       // until browser closes
  'path'     => '/businesshub/admin/',   // ONLY sent on /businesshub/admin/ URLs
  'domain'   => $_SERVER['HTTP_HOST'],
  'secure'   => false,                   // set true if you serve over HTTPS
  'httponly' => true,
  'samesite' => 'Strict',
]);
session_start();

// 2) If form submitted, handle login:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../includes/db.php';

    $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    // adjust table/column names to match your schema:
    $stmt = $conn->prepare("
      SELECT id, password_hash
      FROM users
      WHERE email = ?
        AND role  = 'super_admin'
    ");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            // prevent fixation
            session_regenerate_id(true);
            $_SESSION['user_id']   = $id;
            $_SESSION['user_role'] = 'super_admin';
            header('Location: dashboard.php');
            exit;
        }
    }

    $_SESSION['login_error'] = 'Invalid email or password.';
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Business Hub Super Admin Log In</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <style>
    /* … your existing CSS here … */
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h1>Business Hub Super Admin Log In</h1>
      <p>Please fill in your unique super admin login details below</p>

      <?php if (isset($_SESSION['login_error'])): ?>
        <div class="error-box">
          <?= htmlspecialchars($_SESSION['login_error']) ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
      <?php endif; ?>

      <form class="login-form" method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="form-actions">
          <a href="#">forgot password?</a>
        </div>
        <button type="submit" class="login-button">Sign in</button>
      </form>
    </div>
  </div>
</body>
</html>
