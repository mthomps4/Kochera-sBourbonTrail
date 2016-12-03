<?php
  session_start();
  unset($_SESSION['username']);
  session_destroy();// Destroying All Sessions
  header("Location: /"); // Redirecting To Home Page
?>
