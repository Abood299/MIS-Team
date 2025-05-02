<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../includes/db.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Get form input
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    // 2. Fetch the user from the database
    $query  = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user   = mysqli_fetch_assoc($result);

    // 3. If the account is blocked, reject immediately
    if ($user && $user['is_blocked']) {
        $_SESSION['login_error'] = 'Your account has been blocked. Contact Super Admin.';
        header('Location: admin_login_page.php');
        exit;
    }

    // 4. Validate password
    if ($user && $password === $user['password']) {
        // 5. Check role
        if ($user['role'] === 'super_admin') {
            // 6. Set session variables
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            // Combine first & last name for display
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];

            // 7. Redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Access denied. Only Super Admins can log in.';
        }
    } else {
        $_SESSION['login_error'] = 'Invalid email or password.';
    }

    // 8. On failure, redirect back to login
    header('Location: admin_login_page.php');
    exit;
} else {
    // If accessed directly, send to login page
    header('Location: admin_login_page.php');
    exit;
}
?>
