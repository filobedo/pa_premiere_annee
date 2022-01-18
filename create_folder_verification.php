<?php
  include 'config.php';
  session_start();

  $_POST['nom'] = trim($_POST['nom']);

  if($_POST['folder_type'] == 'default' || empty($_POST['nom'])){
    header('Location: homePage.php?error=open_folder_failed');
    exit;
  }

  $bdd->beginTransaction();
  $bdd->exec('LOCK TABLE dossiers WRITE');

  $insert_folder_request = $bdd->prepare('INSERT INTO dossiers(cdtype,description) VALUES(:cdtype,:name)');
  $insert_folder_request->execute(array('cdtype'=>$_POST['folder_type'],'name'=>htmlspecialchars($_POST['nom'])));

  $last_id = $bdd->query('SELECT max(iddossier) as max_dossier FROM dossiers');
  $iddossier = $last_id->fetch();

  $bdd->commit();
  $bdd->exec('UNLOCK TABLE');

  $link_user_folder = $bdd->prepare("INSERT INTO lnkdossiers(nmuser_client,iddossier) VALUES(:nmuser,:last_id)");
  $link_user_folder->execute(array('nmuser'=>$_SESSION['nmuser'],'last_id'=>$iddossier['max_dossier']));


  header('Location: homePage.php?msg=create_folder_succes');
  exit;
?>
