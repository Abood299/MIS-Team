<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If no user _and_ no admin, send them to the user login
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header('Location: /businesshub/user_login.php');
    exit;
}
?>
