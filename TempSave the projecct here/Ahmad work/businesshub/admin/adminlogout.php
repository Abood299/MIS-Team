<?php
// /businesshub/admin/logout.php

// 1) Configure the same admin-session cookie:
session_name('ADMINSESSID');
session_set_cookie_params([
  'lifetime' => 0,
  'path'     => '/businesshub/admin/',   // ← must match your admin folder
  'domain'   => $_SERVER['HTTP_HOST'],
  'secure'   => false,                   // → true if you’re HTTPS
  'httponly' => true,
  'samesite' => 'Strict',
]);

// 2) Start and clear the session:
session_start();
$_SESSION = [];   // unset all session vars

// 3) Delete the session cookie on the client:
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),    // ADMINSESSID
      '',
      time() - 42000,    // in the past
      $params['path'],
      $params['domain'],
      $params['secure'],
      $params['httponly']
    );
}

// 4) Destroy the session data:
session_destroy();

// 5) Redirect back to your login form:
header('Location: login.php');  // adjust if your login file is named differently
exit;

?>
<script>
  // Double protection against back button after logout
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
