<?php
  session_start();
  include 'config.php';

  if($_POST['rdv'] == 'default'){
    header('Location: liste_dossier.php?error=rdv_missing');
    exit;
  }

  $rdv_verification_max_request = $bdd->prepare('SELECT count(iddossier) as nombre_rdv FROM rdv WHERE iddossier = ? AND okconfirm = 0 AND oksuppr = 0');
  $rdv_verification_max_request->execute(array($_POST['iddossier']));
  $rdv_verification_max = $rdv_verification_max_request->fetch();

  if($rdv_verification_max['nombre_rdv'] >= 4){
    header('Location: liste_dossier.php?error=too_much_rdv');
    exit;
  }

  $user_taken_rdv_request = $bdd->prepare('INSERT INTO rdv(idhrdv,iddossier,nmuser) VALUES(:idhrdv,:iddossier,:nmuser)');
  $user_taken_rdv_request->execute(array('idhrdv'=>$_POST['rdv'],'iddossier'=>$_POST['iddossier'],'nmuser'=>$_SESSION['nmuser']));

  $rdv_available_update = $bdd->prepare('UPDATE horaire SET available = 0 WHERE idhrdv = ?');
  $rdv_available_update->execute(array($_POST['rdv']));

  header('Location: liste_dossier.php?msg=succes');
  exit;
?>
