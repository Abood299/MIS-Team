<?php
// notifications.php (deprecated standalone page—now redirects into the offcanvas)
session_start();
if (empty($_SESSION['user_id'])) {
  header('Location: user_login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Notifications</title>
  <!-- Bootstrap 5 CSS -->
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet">
</head>
<body>

<?php 
// Include your normal header (which contains the offcanvas markup #notifPanel)
include 'includes/header.php'; 
?>

<!-- Bootstrap JS bundle (includes Offcanvas plugin) -->
<script 
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>
<script>
// As soon as the page loads, show the offcanvas notifications panel:
document.addEventListener('DOMContentLoaded', () => {
  const panelEl = document.getElementById('notifPanel');
  if (panelEl) {
    const bsOffcanvas = new bootstrap.Offcanvas(panelEl);
    bsOffcanvas.show();
  }
});
</script>
</body>
</html>
