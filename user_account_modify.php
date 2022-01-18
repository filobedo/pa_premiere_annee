<?php
  include 'config.php';
  session_start();

  // Verification de l'email dans le POST
  if(!isset($_POST['addrmail']) || empty($_POST['addrmail'])){
    header('Location: user_profil.php?error=email_missing');
    exit;
  }

  //Verification du format de l'email
  if(!filter_var($_POST['addrmail'], FILTER_VALIDATE_EMAIL)){
    header('Location: user_profil.php?error=email_format');
    exit;
  }

  //ADDRESS

  if(!isset($_POST['num_rue']) || empty($_POST['num_rue']) || is_int($_POST['num_rue'])){
    header('Location: user_profil.php?error=address_num_missing');
    exit;
  }

  if(!isset($_POST['nom_rue']) || empty($_POST['nom_rue'])){
    header('Location: user_profil.php?error=address_missing');
    exit;
  }

  //VERIFICATION EXISTENCE VILLE

  $verif_town = $bdd->prepare('SELECT lbville FROM tabvilles where lbville = ?');
  $verif_town->execute(array($_POST['lbville']));

  if(!$verif_town->fetch()){
    header('Location: user_profil.php?error=town_dont_exist');
    exit;
  }

  //VERIFICATION NUMERO DE TEL

  if(!isset($_POST['notel']) || empty($_POST['notel'])){
    header('Location: user_profil.php?error=num_tel_missing');
    exit;
  }


  $user_modify_account_request = $bdd->prepare('UPDATE tabusers SET addrmail = :addrmail,notel = :notel,dtmaj = :dtmaj WHERE nmuser = :nmuser');
  $user_modify_account_request->execute(array('addrmail'=>$_POST['addrmail'],'notel' => $_POST['notel'],'dtmaj' => date("d-m-Y H:i:s"),'nmuser' => $_SESSION['nmuser']));

  $user_modify_address_request = $bdd->prepare('UPDATE tabadresses SET num_rue = :num_rue, nom_rue = :nom_rue, idville = (SELECT idville FROM tabvilles WHERE lbville = :lbville) WHERE idadresse = (SELECT idadresse FROM tabusers WHERE nmuser = :nmuser)');
  $user_modify_address_request->execute(array('num_rue' => $_POST['num_rue'],'nom_rue' => $_POST['nom_rue'],'lbville' => $_POST['lbville'],'nmuser' => $_SESSION['nmuser']));

  header('Location: user_profil.php?msg=modify_succes');
  exit;
 ?>
