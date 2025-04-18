<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../includes/db.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Query the user by email
    $query  = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user   = mysqli_fetch_assoc($result);

    if ($user && $password === $user['password']) {
        if ($user['role'] === 'super_admin') {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];

            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'Access denied. Only Super Admins can log in.';
        }
    } else {
        $_SESSION['login_error'] = 'Invalid email or password.';
    }

    header('Location: admin_login_page.php');
    exit;
} else {
    header('Location: admin_login_page.php');
    exit;
}
?>
