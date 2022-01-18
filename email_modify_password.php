<?php
  include 'header.php';
?>

<main>
    <section class="d-flex justify-content-center">
      <section id="change_password_form">
        <form method="POST" action="email_modify_password_verification.php">
          <h3>Nouveau mot de passe</h3>
          <div id="change_password_input_row" class="form-group row">
            <div class="col-xs-2">
              <label>Mot de passe</label><div></div>
              <input type="password" class="form-control connexion_input" placeholder="Mot de passe" aria-label="Password" aria-describedby="basic-addon1" name="password"><div class="space"></div>
            </div>
            <div class="col-xs-2">
              <label>Confirmation</label><div></div>
              <input type="password" class="form-control connexion_input" placeholder="Confirmation" aria-label="Confirm" aria-describedby="basic-addon1" name="confirm_password"><div class="space"></div>
            </div>
          </div>
          <input type="hidden" value="<?php echo $_GET['nmuser'];?>" name="token" />
          <input type="submit" class="btn btn-primary" value="Valider"/>
        </form>
        <div class="space"></div>
      </section>
    </section>

    <?php
      if(isset($_GET['error']) && $_GET['error'] == 'password_dont_correspond'){
        echo '<p class="p_display_error">Les nouveaux mots de passes renseignés ne correpondent pas !</p>';
      }

      if(isset($_GET['error']) && $_GET['error'] == 'succes'){
        echo '<p class="p_display_error">Votre mot de passe a été modifié avec succès !</p>';
      }
    ?>
</main>

<?php
  include 'footer.php';
?>
