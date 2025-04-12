<?php
session_start();
include('../includes/db.php'); // Database connection

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' LIMIT 1");
$user = mysqli_fetch_assoc($result);

// Now we check plain text directly
if ($user && trim($password) === trim($user['password'])) {
    if ($user['role'] === 'admin' || $user['role'] === 'super_admin') {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Access denied. You are not an admin.";
    }
} else {
    echo "Invalid email or password.";
}
?>
