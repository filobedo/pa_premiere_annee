<?php
  include 'config.php';
  session_start();

  date_default_timezone_set('Europe/Paris');

  $date = $_POST['rdv_day'] . ' ' . $_POST['rdv_hours'];

  if(empty($_POST['rdv_day']) || empty($_POST['rdv_hours']) || $date < date('Y-m-d H:i:s')){
    header('Location: rdv_management.php?error=rdv_not_valide');
    exit;
  }
  else{
    $rdv_request = $bdd->prepare('SELECT idhrdv FROM horaire WHERE dtdebrdv = :datedebut');
    $rdv_request->execute(array('datedebut'=>$date));

    if($rdv_request->fetch()){
      header('Location: rdv_management.php?error=rdv_always_taken');
      exit;
    }
    else{

      $rdv_insert_request = $bdd->prepare('INSERT INTO horaire(dtdebrdv,nmuser_huissier) VALUES(:datedebut,:nmuser_huissier)');
      $rdv_insert_request->execute(array('datedebut'=>$date,'nmuser_huissier'=>$_SESSION['nmuser']));

      header('Location: rdv_management.php?msg=succes');
      exit;
    }
  }

?>
