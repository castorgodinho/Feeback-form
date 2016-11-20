<?php
  unset($_SESSION['name']);
  session_destroy();
  header("location: feedback_login.php");
?>
