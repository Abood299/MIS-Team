<?php
session_start();
session_unset();   // Clear all session variables
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: admin_login_page.php");
exit;
?>
<script>
  // Double protection against back button after logout
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
