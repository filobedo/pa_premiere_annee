<?php
  session_start();
  include 'config.php';
  date_default_timezone_set('Europe/Paris');

  $id = $_GET['folder'];
  $choice = $_GET['statut'];
  // $id = 'clem@outlook.com';


  if ($choice == 1) {

    // $delete_pj = $bdd->prepare("DELETE FROM tabpj where iddossier = ?");
    // $suppr_auth = $bdd->query("SET SQL_SAFE_UPDATES = 0");
    $delete_dir = $bdd->prepare("UPDATE dossiers SET cdstatut = 'close' where iddossier = ?");
    $delete_dir->execute(array($id));
    $delete_dir = $bdd->prepare("UPDATE dossiers SET dtfin = ? where iddossier = ?");
    $delete_dir->execute(array(date('Y-m-d H:i:s'),$id));
    echo date('Y-m-d H:i:s');
    }
  else{
    $open_dir = $bdd->prepare("UPDATE dossiers SET cdstatut = 'open' where iddossier = ?");
    $open_dir->execute(array($id));
    $delete_dir = $bdd->prepare("UPDATE dossiers SET dtfin = '' where iddossier = ?");
    $delete_dir->execute(array($id));
    echo 'done';
  }

?>
