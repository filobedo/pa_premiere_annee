<?php
  include 'header.php';
?>

<main>
    <section id="page_content_connexion" class="d-flex justify-content-center">
      <section id="connexion_form">
        <form method="POST" action="Connexion.php">
          <h3>Connexion</h3>
          <div id="connexion_input_row" class="form-group row">
            <div class="col-xs-2">
              <label>Email</label><div></div>
              <input type="text" class="form-control connexion_input" placeholder="Identifiant" aria-label="Username" aria-describedby="basic-addon1" name="username"><div class="space"></div>
            </div>
            <div class="col-xs-2">
              <label>Mot de passe</label><div></div>
              <input type="password" class="form-control connexion_input" placeholder="Mot de passe" aria-label="Username" aria-describedby="basic-addon1" name="password"><div class="space"></div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary" value="Connexion"/>
        </form>
        <div class="space"></div>
        <a href="inscription.php"><button type="button" class="btn btn-secondary btn-sm">Inscription</button></a>
        <button data-toggle="modal" data-target="#forgotten_password_modal" data-whatever="@mdo" type="button" class="btn btn-secondary btn-sm">Mot de passe oublié</button></a>
      </section>
    </section>

    <div class="modal fade" id="forgotten_password_modal" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Veuillez saisir votre identifiant / email</h5>

          </div>
          <form method="POST" action="password_forgotten_verification.php">
            <div class="modal-body" id="mail_input">
                <input type="text" class="form-control" placeholder="Identifiant" aria-label="Email" aria-describedby="basic-addon1" name="login" />
            </div>
            <div id="bouton_suppr" class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

</main>

<?php
  if(isset($_GET['error']) && $_GET['error'] == 'account_missing'){
    echo '<p class="p_display_error">Identifiant/Mot de passe incorrect !</p>';
  }

  if(isset($_GET['error']) && $_GET['error'] == 'disabled'){
    echo '<p class="p_display_error">Votre compte n\'est pas activé !</p>';
  }

  if(isset($_GET['msg']) && $_GET['msg'] == 'disconnect'){
    echo '<p class="p_display_error">Vous êtes déconnecté !</p>';
  }

  if(isset($_GET['msg']) && $_GET['msg'] == 'account_deleted'){
    echo '<p class="p_display_error">Votre compte a bien été supprimé !</p>';
  }

  if(isset($_GET['error']) && $_GET['error'] == 'email_format'){
    echo '<p class="p_display_error">Veuillez renseigner un email valide !</p>';
  }

  if(isset($_GET['error']) && $_GET['error'] == 'email_missing'){
    echo '<p class="p_display_error">Veuillez renseigner une adresse mail</p>';
  }

  if(isset($_GET['msg']) && $_GET['msg'] == 'succes_email_password'){
    echo '<p class="p_display_error">Un email vous a été envoyé pour changer votre mot de passe !</p>';
  }

  if(isset($_GET['error']) && $_GET['error'] == 'login_dont_exist'){
    echo '<p class="p_display_error">L\'email n\'exite pas ! Si vous n\'avez pas de compte, veuillez vous incrire.</p>';
  }

  include 'footer.php';
?>
