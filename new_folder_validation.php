<?php
  include 'config.php';
  session_start();

  $new_folder_add_huissier = $bdd->prepare('UPDATE lnkdossiers SET nmuser_huissier = :nmuser_huissier WHERE iddossier = :iddossier');
  $new_folder_add_huissier->execute(array('nmuser_huissier'=>$_SESSION['nmuser'],'iddossier'=>$_POST['iddossier']));

  $update_folder_to_open_status = $bdd->prepare("UPDATE dossiers SET cdstatut = 'open' WHERE iddossier = ?");
  $update_folder_to_open_status->execute(array($_POST['iddossier']));

  header('Location: homePage.php?msg=validation_folder_succesfull');
  exit;

?>
