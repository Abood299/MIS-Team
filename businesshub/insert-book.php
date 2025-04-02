<?php
include 'connect.php';

$title = $_POST['title'];
$author = $_POST['author'];
$major = $_POST['major'];
$image_url = $_POST['image_url'];

$final_image_path = ''; // This will be stored in the DB

// Handle uploaded file (if any)
if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = __DIR__ . '/uploads/';
    $web_path = 'uploads/'; // This will be saved in DB

    $image_name = basename($_FILES['image_file']['name']);
    $target_path = $upload_dir . $image_name;
    $final_image_path = $web_path . $image_name;

    // Create folder if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) {
        echo "Error uploading file.";
        exit;
    }
}

// Insert into DB
$sql = "INSERT INTO books (title, author, major, image) 
        VALUES ('$title', '$author', '$major', '$final_image_path')";

if (mysqli_query($conn, $sql)) {
    echo "Book added successfully!<br>";
    echo '<a href="add-book-form.html">Add Another</a>';
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
