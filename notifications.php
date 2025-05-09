<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

$userId = $_SESSION['user_id'];

// 1) Fetch notifications + lookup chat_id via the shared request_id FK
$stmt = $conn->prepare(<<<SQL
  SELECT
    n.id,
    n.message,
    n.created_at,
    n.is_read,
    n.type,
    n.action_id      AS request_id,
    c.id             AS chat_id
  FROM notifications AS n
  LEFT JOIN chats AS c
    ON c.request_id = n.action_id
  WHERE n.receiver_id = ?
  ORDER BY n.created_at DESC
SQL
);
$stmt->bind_param('i', $userId);
$stmt->execute();
$notifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// 2) Mark any unread notifications as read
$upd = $conn->prepare("
  UPDATE notifications
     SET is_read = 1
   WHERE receiver_id = ?
     AND is_read = 0
");
$upd->bind_param('i', $userId);
$upd->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Notifications</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <style>
    .notification { padding:1rem; border-bottom:1px solid #eee; }
    .notification.unread { background-color:#f0f8ff; }
    .notification time { color:#999; font-size:.8rem; }
    .start-chat-btn { margin-left:.5rem; }
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
          <p>
            <?= htmlspecialchars($n['message'], ENT_QUOTES, 'UTF-8') ?>

            <?php if (!empty($n['chat_id'])): ?>
              <a href="chat.php?chat_id=<?= (int)$n['chat_id'] ?>"
                 class="btn btn-sm btn-primary start-chat-btn">
                Open Chat
              </a>
            <?php endif; ?>
          </p>
          <time><?= date('M j, Y \a\t H:i', strtotime($n['created_at'])) ?></time>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</body>
</html>
