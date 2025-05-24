<?php
session_start();
require_once 'includes/db.php'; // Adjust path if needed

$userId = $_SESSION['user_id'] ?? 0;
$count = 0;

// Use your original logic for swapCount
if ($userId) {
  $stmt = $conn->prepare("SELECT COUNT(*) FROM swap_offers WHERE receiver_id = ? AND status = 'pending'");
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();
}

echo json_encode(['swapCount' => (int)$count]);
