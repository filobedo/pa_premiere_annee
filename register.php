<?php
  try{
    $base = new PDO('mysql:host=eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=w4il7azumiv2xt1p','g33r61swshdedkxg','p61cycjkchky0cvm',array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e){
    die('Erreur : ' .$e->getMessage());
  }

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $email = $_POST['email'];

  try{
    $request = $base->prepare('SELECT count(email) as nb_user FROM utilisateur WHERE email =?');
    $request->execute(array($email));
    $nb_user = $request->fetch();
  }
  catch(Exception $e){
      die('Erreur : ' .$e->getMessage());
  }

  if($nb_user['nb_user'] != 0){
    header('Location: /HTML-CSS/registerIndex.php?error_alreadyExist=1');
    die();
  }

  if(isset($firstname) && !empty($firstname) && isset($lastname) && !empty($lastname) && isset($password) && !empty($password) && isset($password2) && !empty($password2) && isset($email) && !empty($email)){
    if($password == $password2){
      try{
        $request = $base->prepare("INSERT INTO utilisateur(prenom,nom,email,password) VALUES(:firstname,:lastname,:email,:password)");
        $request->execute(array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'password'=>$password));
      }
      catch(Exception $e){
        die('Erreur : ' .$e->getMessage());
      }
      session_start();

      $_SESSION['email'] = $email;

      header('Location: /HTML-CSS/registerSucces.php');
      die();
    }
    else{
      header('Location: /HTML-CSS/registerIndex.php?error_pass=1');
      die();
    }
  }
  else{
    header('Location: /HTML-CSS/registerIndex.php?error_register=1');
    die();
  }


?>
