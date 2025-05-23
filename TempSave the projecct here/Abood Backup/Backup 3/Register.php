<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Adjust the path below if your register.php is in a different folder
include('includes/db.php');

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name']  ?? '');
    $phone      = trim($_POST['phone']      ?? '');
    $email      = trim($_POST['email']      ?? '');
    $password   = $_POST['password']        ?? '';
    $confirm    = $_POST['confirm_password']?? '';

    // Validation
    if (!$first_name || !$last_name || !$phone || !$email || !$password || !$confirm) {
        $errors[] = 'All fields are required.';
    }
    if ($phone && !preg_match('/^\d{10}$/', $phone)) {
        $errors[] = 'Phone number must be exactly 10 digits.';
    }
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    // Password rules
    if ($password && strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }
    if ($password && !preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password must include at least one lowercase letter.';
    }
    if ($password && !preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must include at least one uppercase letter.';
    }
    if ($password && $password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    // Check for existing email
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'That email is already registered.';
        }
        $stmt->close();
    }

    // Insert into database (plain-text password)
    if (empty($errors)) {
        $stmt = $conn->prepare(
          "INSERT INTO users (first_name, last_name, email, phone, password, role)
           VALUES (?, ?, ?, ?, ?, 'user')"
        );
        $stmt->bind_param("sssss",
          $first_name,
          $last_name,
          $email,
          $phone,
          $password
        );

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = 'Database error: ' . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Business Hub - Register</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <style>
    /* Reset */
    * { margin:0; padding:0; box-sizing:border-box; }
    body, html { width:100%; height:100%; font-family:'Roboto', sans-serif; background-color:#f2f2f2; }
    .split-screen { display:flex; height:100vh; }
    /* Left Section */
    .left { flex:1; position:relative; overflow:hidden; }
    .bg-image { position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:1; }
    .overlay { position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:2; }
    .left-content { position:absolute; top:0; left:0; z-index:3; padding:60px 40px; color:#fff; }
    .left-content h1 { font-size:3rem; margin-bottom:20px; font-weight:700; }
    .left-content p { font-size:1.2rem; line-height:1.6; max-width:400px; }
    .left-content .contact-info { margin-top:40px; font-size:0.95rem; line-height:1.4; }
    /* Right Section */
    .right { flex:1; display:flex; align-items:center; justify-content:center; background:#f2f2f2; }
    .form-wrapper { background:#fff; width:90%; max-width:400px; padding:40px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center; }
    .form-wrapper h2 { margin-bottom:24px; font-size:1.8rem; color:#333; font-weight:700; }
    .form-errors { text-align:left; margin-bottom:16px; }
    .form-errors p { color:#d9534f; margin:4px 0; }
    .form-success { color:#28a745; margin-bottom:16px; }
    form { display:flex; flex-direction:column; gap:16px; }
    form input[type="text"], form input[type="email"], form input[type="password"], form input[type="tel"] {
      padding:12px 16px; border:1px solid #ddd; border-radius:4px; font-size:1rem; width:100%; transition:border-color 0.2s ease;
    }
    form input:focus { border-color:#5E2950; outline:none; }
    form button[type="submit"] { margin-top:8px; padding:14px; border:none; border-radius:4px; background-color:#5E2950; color:#fff; font-size:1rem; font-weight:500; cursor:pointer; transition:background-color 0.3s ease; }
    form button[type="submit"]:hover { background-color:#EC522D; }
    .extra-links { margin-top:16px; font-size:0.9rem; color:#777; }
    .extra-links a { color:#5E2950; text-decoration:none; margin-left:5px; }
    .extra-links a:hover { color:#EC522D; }
    .password-container { position:relative; }
    .password-container input { width:100%; padding-right:40px; }
    .toggle-password { position:absolute; top:50%; right:10px; transform:translateY(-50%); cursor:pointer; font-size:18px; color:#555; }
    @media (max-width:850px) { .split-screen { flex-direction:column; } .left, .right { width:100%; height:auto; } .left-content { padding:40px 20px; text-align:center; } }
  </style>
</head>
<body>
  <div class="split-screen">
    <div class="left">
      <img src="images/reg.jpg" alt="Business Hub Image" class="bg-image">
      <div class="overlay"></div>
      <div class="left-content">
        <h1>Business Hub</h1>
        <p>Join Business Hub — your access to premium services at JU Business School.
        We offer smart tools to help students succeed academically and professionally.</p>
        <div class="contact-info">
          <p>Call us: +962 (06) 456-7890</p>
          <p>Email: support@businesshub.com</p>
        </div>
      </div>
    </div>
    <div class="right">
      <div class="form-wrapper">
        <h2>Create Account</h2>

        <!-- server-side errors -->
        <?php if (!empty($errors)): ?>
          <div class="form-errors">
            <?php foreach ($errors as $e): ?>
              <p>&bull; <?=htmlspecialchars($e)?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if ($success): ?>
          <div class="form-success">Registration successful! <a href="user_login.php">Log in</a></div>
        <?php endif; ?>

        <div id="clientErrors" class="form-errors" style="display:none;"></div>

        <form id="signupForm" method="POST" action="">
          <input type="text" name="first_name" placeholder="First Name" value="<?=htmlspecialchars($_POST['first_name']??'')?>" required>
          <input type="text" name="last_name" placeholder="Last Name" value="<?=htmlspecialchars($_POST['last_name']??'')?>" required>
          <input type="tel" name="phone" placeholder="Phone Number" maxlength="10" pattern="\d{10}" title="10-digit phone" value="<?=htmlspecialchars($_POST['phone']??'')?>" required>
          <input type="email" name="email" placeholder="Email Address" value="<?=htmlspecialchars($_POST['email']??'')?>" required>
          <div class="password-container">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span id="togglePassword" class="toggle-password">👁️</span>
          </div>
          <div class="password-container">
            <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
            <span id="toggleConfirmPassword" class="toggle-password">👁️</span>
          </div>
          <button type="submit">Sign Up</button>
        </form>
        <div class="extra-links"><p>Already have an account? <a href="user_login.php">Log In</a></p></div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('signupForm').addEventListener('submit', function(event) {
      const errors = [];
      const phone = this.phone.value.trim();
      const pwd   = this.password.value;
      const cpwd  = this.confirm_password.value;

      // client-side phone check
      if (!/^\d{10}$/.test(phone)) {
        errors.push('Phone must be 10 digits.');
      }
      // password rules
      if (pwd.length < 8) {
        errors.push('Password must be at least 8 characters.');
      }
      if (!/[a-z]/.test(pwd)) {
        errors.push('Password must include at least one lowercase letter.');
      }
      if (!/[A-Z]/.test(pwd)) {
        errors.push('Password must include at least one uppercase letter.');
      }
      if (pwd !== cpwd) {
        errors.push('Passwords do not match.');
      }

      if (errors.length) {
        event.preventDefault();
        const errDiv = document.getElementById('clientErrors');
        errDiv.innerHTML = errors.map(e => `<p>&bull; ${e}</p>`).join('');
        errDiv.style.display = 'block';
      }
    });

    document.getElementById('togglePassword').addEventListener('click', function(){
      const p = document.getElementById('password');
      p.type = p.type === 'password' ? 'text' : 'password';
      this.textContent = p.type === 'password' ? '👁️' : '🙈';
    });
    document.getElementById('toggleConfirmPassword').addEventListener('click', function(){
      const p = document.getElementById('confirmPassword');
      p.type = p.type === 'password' ? 'text' : 'password';
      this.textContent = p.type === 'password' ? '👁️' : '🙈';
    });
  </script>
</body>
</html>
