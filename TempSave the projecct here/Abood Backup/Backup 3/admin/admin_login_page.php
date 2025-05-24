<?php

session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Business Hub Super Admin LogIn</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      height: 100%;
      font-family: 'Roboto', sans-serif;
    }

    body {
      background: url('https://wallpapers.com/images/hd/4k-black-3840-x-2160-background-m63akkzljfziooyb.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5));
      z-index: 0;
    }

    .login-container {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
    }

    .login-card {
      background-color: #fff;
      width: 100%;
      max-width: 400px;
      border-radius: 8px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
      text-align: center;
    }

    .login-card h1 {
      font-size: 1.5rem;
      margin-bottom: 10px;
      font-weight: 700;
      color: #000;
    }

    .login-card p {
      font-size: 0.9rem;
      color: #444;
      margin-bottom: 24px;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .login-form input {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
      outline: none;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      font-size: 0.85rem;
    }

    .form-actions a {
      color: #666;
      text-decoration: none;
      transition: color 0.2s;
    }

    .form-actions a:hover {
      color: #000;
      text-decoration: underline;
    }

    .login-button {
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 12px;
      font-size: 1rem;
      cursor: pointer;
      transition: opacity 0.3s;
    }

    .login-button:hover {
      opacity: 0.9;
    }

    .error-box {
      background: #ffe5e5;
      color: #cc0000;
      padding: 10px;
      border: 1px solid #cc0000;
      border-radius: 5px;
      margin-bottom: 15px;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h1>Business Hub Super Admin Log In</h1>
      <p>Please fill in your unique super admin login details below</p>

      <!-- Error Display -->
      <?php if (isset($_SESSION['login_error'])): ?>
        <div class="error-box">
          <?= $_SESSION['login_error'] ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
      <?php endif; ?>

      <!-- Login Form -->
      <form class="login-form" method="POST" action="admin_login.php">
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
