<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "business_hub2";

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>
