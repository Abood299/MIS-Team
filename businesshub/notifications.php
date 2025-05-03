<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: user_login.php');
  exit;
}

$userId = $_SESSION['user_id'];

// 1) Fetch all notifications (newest first), including their is_read flag
$stmt = $conn->prepare("
  SELECT id, message, created_at, is_read
    FROM notifications
   WHERE receiver_id = ?
   ORDER BY created_at DESC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$notifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// 2) Now mark any unread notifications as read
$stmt = $conn->prepare("
  UPDATE notifications
     SET is_read = 1
   WHERE receiver_id = ?
     AND is_read = 0
");
$stmt->bind_param("i", $userId);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Notifications</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <style>
    .notification {
      padding: 1rem;
      border-bottom: 1px solid #eee;
    }
    /* highlight unread items */
    .notification.unread {
      background-color: #f0f8ff;
    }
    .notification time {
      color: #999;
      font-size: 0.8rem;
    }
  </style>
</head>
<body>


  <div class="container py-4">
    <h2>Notifications</h2>

    <?php if (empty($notifications)): ?>
      <p>No notifications.</p>
    <?php else: ?>
      <?php foreach ($notifications as $n): ?>
        <div class="notification<?= $n['is_read'] ? '' : ' unread' ?>">
          <p><?= htmlspecialchars($n['message']) ?></p>
          <time><?= htmlspecialchars($n['created_at']) ?></time>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>


</body>
</html>
