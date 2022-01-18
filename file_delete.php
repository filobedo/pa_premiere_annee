<?php
  session_start();
  include 'config.php';

  // $suppr_request = $bdd->prepare("SET SQL_SAFE_UPDATES = 0;");

  $suppr_auth = $bdd->query("SET SQL_SAFE_UPDATES = 0");

	$suppr_request = $bdd->prepare("DELETE FROM tabpj WHERE nmfic = ?");
	$suppr_request->execute(array($_GET['file']));

  // $suppr_request = $bdd->prepare("SET SQL_SAFE_UPDATES = 1;");
  // $suppr_request->execute();
  unlink('fichier/' . $_GET['file']);
  echo 'fichier supprimé';
  exit;
?>
