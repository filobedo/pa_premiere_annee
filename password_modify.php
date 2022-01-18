<?php
  include 'config.php';
  session_start();

  try{
    $password_request = $bdd->prepare('SELECT cryptpasswd FROM tabusers WHERE nmuser = ?');
    $password_request->execute(array($_SESSION['nmuser']));
    $user_password = $password_request->fetch();
  }
  catch(Exception $e){
    die($e->getMessage());
  }

  if(hash('sha256',$_POST['old_password']) == $user_password['cryptpasswd']){
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password']){
      try{
        $password_modify = $bdd->prepare('UPDATE tabusers SET cryptpasswd = :cryptpasswd WHERE nmuser = :nmuser');
        $password_modify->execute(array('cryptpasswd' => hash('sha256',$_POST['password']),'nmuser' => $_SESSION['nmuser']));
      }
      catch(Exception $e){
        die($e->getMessage());
      }
    }
    else{
      header('Location: user_profil.php?error=password_dont_correspond');
      exit;
    }
  }
  else{
    header('Location: user_profil.php?error=wrong_old_password');
    exit;
  }

  header('Location: user_profil.php?msg=password_modify_succes');
  exit;
?>
