<?php
  include 'config.php';

  // Verification de l'email dans le POST
  if(!isset($_POST['login']) || empty($_POST['login'])){
    header('Location: ConnexionIndex.php?error=email_missing');
    exit;
  }

  //Verification du format de l'email
  if(!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)){
    header('Location: ConnexionIndex.php?error=email_format');
    exit;
  }

  try{
    $adress_mail_request = $bdd->prepare('SELECT nmuser,token FROM tabusers WHERE nmuser = ?');
    $adress_mail_request->execute(array($_POST['login']));
  }
  catch(Exception $e){
    die($e->getMessage());
  }

  if($adress_mail = $adress_mail_request->fetch()){
    $token = $adress_mail['token'];
    // $_SESSION['nmuser'] = $_POST['login'];
    include 'emailSend.php';
    header('Location: ConnexionIndex.php?msg=succes_email_password');
    exit;
  }
  else{
    header('Location: ConnexionIndex.php?error=login_dont_exist');
    exit;
  }
?>
