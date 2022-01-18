<?php
  include 'config.php';
  session_start();

  if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password']){
    try{
      $password_request = $bdd->prepare('UPDATE tabusers SET cryptpasswd = :cryptpasswd WHERE token = :token');
      $password_request->execute(array('cryptpasswd' => hash('sha256',$_POST['password']),'token' => $_POST['token']));
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
  else{
    header("Location: email_modify_password.php?nmuser=" . $_POST['token'] . "&error=password_dont_correspond");
    exit;
  }

  header('Location: ConnexionIndex.php?msg=succes');
  exit;
?>
