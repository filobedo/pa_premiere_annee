<?php

  include 'config.php';

  $activate_account_request = $bdd->prepare("UPDATE tabusers SET okactif = 1 WHERE token = ?");
  $activate_account_request->execute(array($_GET['nmuser']));


  header('Location: ConnexionIndex.php');
  exit;
?>
