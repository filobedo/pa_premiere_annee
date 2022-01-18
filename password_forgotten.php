<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Mot de passe oublié </title>
  </head>
  <body>
    <form method="POST" action="password_forgotten_verification.php">
      <label> Veuillez saisir votre identifiant </label><br>
      <input type='text' placeholder='adresse mail' name="login" size='30' /><br>
      <input type='submit' value='Envoyer' />
    </form>
    <?php
      if(isset($_GET['msg']) && $_GET['msg'] == 'succes'){
        echo 'Votre demande de changement de mot de passe a bien été envoyé ! Vous allez recevoir un mail contenant les instructions à suivre';
      }

      if(isset($_GET['error'])){
        if($_GET['error'] == 'login_dont_exist'){
          echo "Votre identifiant n'est pas connu ! <br>Vous pouvez vous inscrire en cliquant sur le lien suivant : <a href='inscription.php'>Inscription</a>";
        }

        if($_GET['error'] == 'email_missing'){
          echo 'L\'addresse email n\'est pas renseignée !';
        }

        if($_GET['error'] == 'email_format'){
          echo 'L\'addresse email renseignée n\'est pas valide !';
        }
      }

    ?>
  </body>
</html>
