<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  </head>
  <body>
    <h1>Inscription</h1>
    <form method="POST" action="register.php">
      <input type="text" name="firstname" placeholder="Prénom" />
      <input type="text" name="lastname" placeholder="Nom" /><br><br>
      <input type="password" name="password" placeholder="Mot de passe" /><br><br>
      <input type="password" name="password2" placeholder="Confirmation mot de passe" /><br><br>
      <input type="text" name="email" placeholder="Adresse Mail" /><br><br>
      <input type="submit" name="register_button" value="Valider" />
    </form>
  </body>
</html>

<?php
  if(isset($_GET['error_pass']) == 1){
    echo '<br>Les mots de passes ne correspondent pas !';
  }
  if(isset($_GET['error_register']) == 1){
    echo '<br>Le formulaire d\'inscription n\'est pas complet !';
  }
  if(isset($_GET['error_alreadyExist']) == 1){
    echo '<br>Cette adresse e-mail existe déjà !';
  }

?>
