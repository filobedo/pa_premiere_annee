<?php
  session_start();
  $_SESSION = [];
  session_destroy();
  header('Location: ConnexionIndex.php?msg=disconnect');
  exit;
?>
