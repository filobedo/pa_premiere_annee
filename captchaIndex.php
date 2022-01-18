<?php
  session_start();

  if(isset($_POST['user_entry_captcha'])){
    if($_POST['user_entry_captcha'] == $_SESSION['captcha']){
      echo 'Done !';
    }else{
      echo 'Mauvais captcha !';
    }
  }
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Captcha</title>
  </head>
  <body>
      <form method="POST">
        <input type="text" name="user_entry_captcha" />
        <input type="submit" name="envoyer" /><br><br>
        <img src="captchaV2.php" />
      </form>
  </body>
</html>
