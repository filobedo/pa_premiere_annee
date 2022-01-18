<?php
  session_start();
  include 'config.php';

  $firstname = trim($_POST['firstname']);
  $lastname = trim($_POST['lastname']);
  $email = trim($_POST['email']);
  $confirm_email = trim($_POST['confirm_email']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);
  $address = trim($_POST['address']);
  $birthday = $_POST['birthday'];
  $gender = $_POST['gender'];
  //$country = $_POST['country'];
  $num_tel = trim($_POST['num_tel']);
  $town = $_POST['town'];
  $address_num = trim($_POST['address_num']);
  $address = trim($_POST['address']);
  $verif_captcha = $_POST['verif_captcha'];
  $token = 'CFQ' . hash('sha256',$email);

  // Verification de l'email dans le POST
  if(!isset($email) || empty($email)){
    header('Location: inscription.php?error=email_missing');
    exit;
  }

  //Verification du format de l'email
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header('Location: inscription.php?error=email_format');
    exit;
  }

  //Verification email déjà existante ?
  $requete = $bdd->prepare('SELECT nmuser FROM tabusers WHERE addrmail =?');
  $requete->execute(array($email));
  //Parcourir la réponse de la bdd
  $answers = [];
  while($user = $requete->fetch()){
    $answers[] = $user;
  }

  if(count($answers) != 0){
    header('Location: inscription.php?error=email_taken');
    exit;
  }

  if($email != $confirm_email){
    header('Location: inscription.php?error=email_not_corresponding');
    exit;
  }

  //PRENOM & NOM

  if(empty($firstname)){
    header('Location: inscription.php?error=firstname_missing');
    exit;
  }

  if(empty($lastname)){
    header('Location: inscription.php?error=lastname_missing');
  }
  // PASSWORD

  if(empty($password)){
    header('Location: inscription.php?error=password_missing');
    exit;
  }

  if(strlen($password) < 6){
    header('Location: inscription.php?error=password_length');
    exit;
  }

  if($password != $confirm_password){
    header('Location: inscription.php?error=password_not_corresponding');
    exit;
  }

  // COUNTRY

  // if(!isset($country) || empty($country) || $country == 'pays'){
  //   header('Location: inscription.php?error=country_missing');
  //   exit;
  // }

  // GENDER

  if(!isset($gender) || empty($gender)){
    header('Location: inscription.php?error=gender_missing');
    exit;
  }

  //BIRTHDAY

  if(!isset($birthday) || empty($birthday)){
    header('Location: inscription.php?error=birthday_missing');
    exit;
  }

  //ADDRESS

  if(!isset($address_num) || empty($address_num) || is_int($address_num)){
    header('Location: inscription.php?error=address_num_missing');
    exit;
  }

  if(!isset($address) || empty($address)){
    header('Location: inscription.php?error=address_missing');
    exit;
  }

  //TOWN

  if(!isset($town) || empty($town)){
    header('Location: inscription.php?error=town_missing');
  }

  //VERIFICATION NUMERO DE TEL

  if(!isset($num_tel) || empty($num_tel)){
    header('Location: inscription.php?error=num_tel_missing');
    exit;
  }

  //Verification de la bonne existence de la ville dans la bdd

  $verif_town = $bdd->prepare('SELECT lbville FROM tabvilles where lbville = ?');
  $verif_town->execute(array($town));

  if(!$verif_town->fetch()){
    header('Location: inscription.php?error=town_dont_exist');
    exit;
  }

  // VERIFIFCATION CAPTCHA

  if($_SESSION['captcha'] != $verif_captcha){
    header('Location: inscription.php?error=captcha_novalide');
    exit;
  }

    //insertion nouvel utilisateur dans $bdd
  $address_request = $bdd->prepare('INSERT INTO tabadresses(num_rue,nom_rue,idville) VALUES(:address_num,:address,(SELECT idville FROM tabvilles WHERE lbville = :lbville))');
  $address_request->execute(array(
      'address_num'=>$address_num,
      'address'=>$address,
      'lbville'=>$town
    ));

  $requete = $bdd->prepare('INSERT INTO tabusers(nmuser,gender,nom,prenom,cryptpasswd,addrmail,dtnaissance,notel,idadresse,token)
                          VALUES(:email,:gender,:lastname,:firstname,:cryptpasswd,:addrmail,:birthday,:num_tel,(SELECT MAX(idadresse) FROM tabadresses),:token)');
  $gender = $gender == 'true' ? 1 : 0;
  $requete->execute(array(
      'email'=>$email,
      'gender'=>$gender,
      'lastname'=>htmlspecialchars($lastname),
      'firstname'=>htmlspecialchars($firstname),
      'cryptpasswd'=>hash('sha256',$password),
      'addrmail'=>$email,
      'birthday'=>htmlspecialchars($birthday),
      'num_tel'=>htmlspecialchars($num_tel),
      'token'=>$token
    ));

    include 'emailSend.php';
  //Redirection vers la page

  header('Location: ConnexionIndex.php');
  exit;
?>
