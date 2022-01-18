<?php

  include 'config.php';
  session_start();

  try{
    $user_request = $bdd->prepare('SELECT nmuser,idadresse,okactif FROM tabusers WHERE nmuser = :username AND cryptpasswd = :password');
    $user_request->execute(array('username' => htmlspecialchars($_POST['username']),
                            'password' => hash('sha256',$_POST['password'])
                          ));
  }
  catch(Exception $e){
    die('Erreur : '.  $e->getMessage());
  }

  $user_infos = $user_request->fetch();

  if(isset($user_infos['okactif']) && $user_infos['okactif'] == 0){
    header('Location: ConnexionIndex.php?error=disabled');
    exit;
  }


  if($user_infos['nmuser'] != NULL){
    $_SESSION['nmuser'] = $_POST['username'];
    $_SESSION['idadresse'] = $user_infos['idadresse'];
    header('Location: homePage.php');
    exit;
  }
  else{
    header('Location: ConnexionIndex.php?error=account_missing');
    exit;
  }

?>
