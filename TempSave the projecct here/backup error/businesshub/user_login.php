
<?php
// user_login.php

session_start();
require_once 'includes/db.php';

$error = '';

// Initialize login attempts counter
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_time = time();

    // Check for active lockout
    if (isset($_SESSION['lockout_time']) && $current_time < $_SESSION['lockout_time']) {
        $remaining = $_SESSION['lockout_time'] - $current_time;
        $minutes = ceil($remaining / 60);
        $error = "Too many login attempts. Please try again in $minutes minute(s).";
    } else {
        // If lockout expired, reset
        if (isset($_SESSION['lockout_time']) && $current_time >= $_SESSION['lockout_time']) {
            unset($_SESSION['lockout_time']);
            $_SESSION['login_attempts'] = 0;
        }

        // Sanitize inputs
        $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
        $password = $_POST['password'];

        // Fetch user
        $sql = "SELECT id, first_name, password 
                FROM users 
                WHERE email = '$email' 
                LIMIT 1";
        $res = mysqli_query($conn, $sql);

        $auth_ok = false;
        if ($res && mysqli_num_rows($res) === 1) {
            $user = mysqli_fetch_assoc($res);
            if ($password === $user['password']) {
                $auth_ok = true;
            }
        }

        if ($auth_ok) {
            // Reset counters on successful login
            $_SESSION['login_attempts'] = 0;
            unset($_SESSION['lockout_time']);

            // Set session and redirect
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            header('Location: booksexchange.php');
            exit;
        } else {
            // Increment on failure
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] >= 3) {
                $_SESSION['lockout_time'] = time() + 300; // 5 minutes
                $error = 'Too many login attempts. You are blocked for 5 minutes.';
            } else {
                $error = 'Invalid email or password.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Business Hub - Log In</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <base href="/businesshub/">
  <style>
    /* Reset CSS */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body, html { width:100%; height:100%; font-family:'Roboto', sans-serif; background-color:#f2f2f2; }
    .split-screen { display:flex; height:100vh; }
    .left { flex:1; position:relative; overflow:hidden; }
    .bg-image { position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:1; }
    .overlay { position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:2; }
    .left-content { position:absolute; top:0; left:0; z-index:3; padding:60px 40px; color:#fff; }
    .left-content h1 { font-size:3rem; margin-bottom:20px; font-weight:700; }
    .left-content p { font-size:1.2rem; line-height:1.6; max-width:400px; }
    .left-content .contact-info { margin-top:40px; font-size:0.95rem; line-height:1.4; }
    .right { flex:1; display:flex; align-items:center; justify-content:center; background:#f2f2f2; }
    .form-wrapper { background:#ffffff; width:90%; max-width:400px; padding:40px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center; }
    .form-wrapper h2 { margin-bottom:24px; font-size:1.8rem; color:#333; font-weight:700; }
    .alert { padding:12px; margin-bottom:16px; border-radius:4px; color:#721c24; background-color:#f8d7da; }
    form { display:flex; flex-direction:column; gap:16px; }
    form input[type="email"], form input[type="password"] {
      padding:12px 16px; border:1px solid #ddd; border-radius:4px; font-size:1rem; width:100%; transition:border-color 0.2s ease;
    }
    form input:focus { border-color:#5E2950; outline:none; }
    .remember-me { display:flex; align-items:center; gap:8px; font-size:0.9rem; color:#555; }
    form button[type="submit"] { margin-top:8px; padding:14px; border:none; border-radius:4px; background-color:#5E2950; color:#fff; font-size:1rem; font-weight:500; cursor:pointer; transition:background-color 0.3s ease; }
    form button[type="submit"]:hover { background-color:#EC522D; }
    .extra-links { margin-top:16px; font-size:0.9rem; color:#777; }
    .extra-links a { color:#5E2950; text-decoration:none; margin-left:5px; }
    .password-container { position:relative; }
    .password-container input { width:100%; padding-right:40px; }
    .toggle-password { position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer; font-size:18px; color:#555; }
    @media (max-width:850px) { .split-screen { flex-direction:column; } .left,.right { width:100%; height:auto; } .left-content { padding:40px 20px; text-align:center; } }
  </style>
</head>
<body>
  <div class="split-screen">
    <div class="left">
      <img src="images/log.jpg" alt="Business Hub Background" class="bg-image">
      <div class="overlay"></div>
      <div class="left-content">
        <h1>Business Hub</h1>
        <p>Empower your business with our innovative solutions.
        We help you stay ahead with seamless integration and smart analytics.</p>
        <div class="contact-info">
          <p>Call us: +962 (06) 456-7890</p>
          <p>Email: support@businesshub.com</p>
        </div>
      </div>
    </div>
    <div class="right">
      <div class="form-wrapper">
        <h2>Log In</h2>
        <?php if ($error): ?>
          <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="user_login.php">
          <input type="email" name="email" placeholder="Email address" required>
          <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span id="togglePassword" class="toggle-password">&#128065;</span>
          </div>
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
          </div>
          <button type="submit">Log In</button>
        </form>
        <div class="extra-links">
          <p><a href="#">Forgot Password?</a></p>
          <p>Don't have an account? <a href="Register.php">Sign Up</a></p>
        </div>
      </div>
    </div>
  </div>
  <script>
    const toggle = document.getElementById('togglePassword');
    const pwd    = document.getElementById('password');
    toggle.addEventListener('click', () => {
      const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
      pwd.setAttribute('type', type);
      toggle.textContent = type === 'password' ? '👁️' : '🙈';
    });
  </script>
</body>
</html>
