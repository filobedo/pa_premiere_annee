<?php
  include 'config.php';
  session_start();

  try{

    $delete_lnkdossiers_request = $bdd->prepare('DELETE FROM lnkdossiers WHERE nmuser_client = ?');
    $delete_lnkdossiers_request->execute(array($_SESSION['nmuser']));

    $select_address_request = $bdd->prepare('SELECT idadresse FROM tabusers WHERE nmuser = ?');
    $select_address_request->execute(array($_SESSION['nmuser']));
    $select_address = $select_address_request->fetch();

    $delete_request = $bdd->prepare('DELETE FROM tabusers WHERE nmuser = ?');
    $delete_request->execute(array($_SESSION['nmuser']));

    $delete_address_request = $bdd->prepare('DELETE FROM tabadresses WHERE idadresse = ?');
    $delete_address_request->execute(array($select_address['idadresse']));
  }
  catch(Exception $e){
    die($e->getMessage());
  }

  header('Location: ConnexionIndex.php?msg=account_deleted');
  exit;
?>
