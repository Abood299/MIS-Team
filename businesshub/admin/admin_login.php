<?php
session_start();
include('../includes/db.php'); // Database connection


// Only process if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = trim($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' LIMIT 1");
    $user = mysqli_fetch_assoc($result);

    if ($user && $password === trim($user['password'])) {
        if ($user['role'] === 'admin' || $user['role'] === 'super_admin') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['login_error'] = " Access denied. You are not an admin.";
        }
    } else {
        $_SESSION['login_error'] = " Invalid email or password.";
    }

    header("Location: admin_login_page.php");
    exit;
}
?>