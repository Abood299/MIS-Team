<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Business Hub - Sign Up</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body,
    html {
      width: 100%;
      height: 100%;
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
    }
    .split-screen {
      display: flex;
      height: 100vh;
    }
    /* Left Section with HTML Image */
    .left {
      flex: 1;
      position: relative;
      overflow: hidden;
    }
    /* The image is set via an <img> tag, change its src directly */
    .bg-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }
    /* Dark overlay for readability */
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 2;
    }
    /* Content placed over the overlay */
    .left-content {
      position: absolute;
      top: 0;
      left: 0;
      z-index: 3;
      padding: 60px 40px;
      color: #fff;
    }
    .left-content h1 {
      font-size: 3rem;
      margin-bottom: 20px;
      font-weight: 700;
    }
    .left-content p {
      font-size: 1.2rem;
      line-height: 1.6;
      max-width: 400px;
    }
    .left-content .contact-info {
      margin-top: 40px;
      font-size: 0.95rem;
      line-height: 1.4;
    }
    /* Right Section: Sign-Up Form */
    .right {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f2f2f2;
    }
    .form-wrapper {
      background: #ffffff;
      width: 90%;
      max-width: 400px;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .form-wrapper h2 {
      margin-bottom: 24px;
      font-size: 1.8rem;
      color: #333;
      font-weight: 700;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
      padding: 12px 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
      width: 100%;
      transition: border-color 0.2s ease;
    }
    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="password"]:focus {
      border-color: #5E2950;
      outline: none;
    }
    form button[type="submit"] {
      margin-top: 8px;
      padding: 14px;
      border: none;
      border-radius: 4px;
      background-color: #5E2950; /* updated */
      color: #fff;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    form button[type="submit"]:hover {
      background-color:  #EC522D;
    }
    .extra-links {
      margin-top: 16px;
      font-size: 0.9rem;
      color: #777;
    }
    .extra-links a {
      color: #5E2950; /* updated */
      text-decoration: none;
      margin-left: 5px;
    }
    .extra-links a:hover {
  color: #EC522D; /* your theme orange */
}
    /* Password visibility toggle */
    .password-container {
  position: relative;
}

.password-container input {
  width: 100%;
  padding-right: 40px; /* space for the icon */
}

.toggle-password {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 18px;
  color: #555;
}
    /* Responsive for mobile devices */
    @media (max-width: 850px) {
      .split-screen {
        flex-direction: column;
      }
      .left,
      .right {
        flex: none;
        width: 100%;
        height: auto;
      }
      .left-content {
        padding: 40px 20px;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="split-screen">
    <!-- Left Section: Image inserted via HTML with an <img> tag -->
    <div class="left">
      <!-- Change the image source below to use your own image -->
      <img src="images/reg.jpg" alt="Business Hub Image" class="bg-image">
      <div class="overlay"></div>
      <div class="left-content">
        <h1>Business Hub</h1>
        <p>
        Join Business Hub — your access to premium services at JU Business School.  
We offer smart tools to help students succeed academically and professionally.

        </p>
        <div class="contact-info">
          <p>Call us: +962 (06) 456-7890</p>
          <p>Email: support@businesshub.com</p>
        </div>
      </div>
    </div>
    <!-- Right Section: Sign-Up Form -->
    <div class="right">
      <div class="form-wrapper">
        <h2>Create Account</h2>
        <form id="signupForm" method="POST" action="signup.php">
          <input type="text" id="fullName" placeholder="Full Name" required>
          <input type="text" id="ssn" placeholder="Student ID" required>
          <input type="email" id="email" placeholder="Email Address" required>
         <!-- Password field with eye icon -->
<div class="password-container">
  <input type="password" id="password" placeholder="Password" required>
  <span id="togglePassword" class="toggle-password">&#128065;</span>
</div>

<!-- Confirm Password field with eye icon -->
<div class="password-container">
  <input type="password" id="confirmPassword" placeholder="Confirm Password" required>
  <span id="toggleConfirmPassword" class="toggle-password">&#128065;</span>
</div>
          <button type="submit">Sign Up</button>
        </form>
        <div class="extra-links">
          <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    // Basic client-side sign-up form validation
    document.getElementById('signupForm').addEventListener('submit', function(event) {
      event.preventDefault();
      
      const fullName = document.getElementById('fullName').value.trim();
      const ssn = document.getElementById('ssn').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      
      if (!fullName || !ssn || !email || !password || !confirmPassword) {
        alert('Please fill out all fields.');
        return;
      }
      
      // Validate SSN format (example: 123-45-6789)
      const ssnPattern = /^\d{3}-?\d{2}-?\d{4}$/;
      if (!ssnPattern.test(ssn)) {
        alert('Please enter a valid SSN (e.g., 123-45-6789).');
        return;
      }
      
      if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
      }
      
      alert('Account created successfully!\nWelcome to Business Hub, ' + fullName + '!');
      // In production, send form data to your backend here.
      // window.location.href = '/dashboard.html';
    });
 // Toggle Password Visibility
document.getElementById("togglePassword").addEventListener("click", function () {
  const password = document.getElementById("password");
  const type = password.type === "password" ? "text" : "password";
  password.type = type;
  this.textContent = type === "password" ? "👁️" : "🙈";
});

document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
  const confirm = document.getElementById("confirmPassword");
  const type = confirm.type === "password" ? "text" : "password";
  confirm.type = type;
  this.textContent = type === "password" ? "👁️" : "🙈";
});

  </script>
</body>
</html>
