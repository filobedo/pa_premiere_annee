<?php
  include 'header.php';
  $_SESSION['captcha'] = mt_rand(1000,9999);
  // include 'captchaV2.php';
?>

<main id="register_main">
  <section id="page_content" class="d-flex justify-content-center">
    <section id="register_form">
      <form name="register" method="POST" action="verification.php" onsubmit="return check()">
        <h3 id="create_account_title">Créer un compte</h3>
        <div class="d-flex justify-content-center">
          <div id="register_input_row" class="form-group row">
            <div id="register_align" class="mx-auto">
              <div id="div_radio_input" class="form-check form-check-inline">
                <label id="gender_radio_input_woman" class="form-check-label"><input class="form-check-input" type="radio" name="gender" value="false" />Madame</label>
                <label id="gender_radio_input_man" class="form-check-label"><input class="form-check-input" type="radio" name="gender" value="true" />Monsieur</label>
              </div>

              <div class="form-group display_input_inline_block">
                  <input type="text" class="form-control" placeholder="Prénom" aria-label="firstname" aria-describedby="basic-addon1" name="firstname" />
                  <input type="text" class="form-control" placeholder="Nom" aria-label="lastname" aria-describedby="basic-addon1" name="lastname" />
              </div>

              <div class="form-group">
                <input type="date" class="form-control" aria-label="birthday" aria-describedby="basic-addon1" name="birthday" />
              </div>

              <div class="form-group display_input_inline_block">
                <input type="text" class="form-control" placeholder="Mail" aria-label="email" aria-describedby="basic-addon1" name="email" />
                <input type="text" class="form-control" placeholder="Confirmer le mail" aria-label="confirm_email" aria-describedby="basic-addon1" name="confirm_email" />
              </div>

              <div class="form-group display_input_inline_block">
                <input type="password" class="form-control" placeholder="Mot de passe" aria-label="password" aria-describedby="basic-addon1" name="password" />
                <input type="password" class="form-control" placeholder="Confirmer le mot de passe" aria-label="confirm_password" aria-describedby="basic-addon1" name="confirm_password" />
              </div>

              <div id="address_and_num_div" class="form-group">
                <input id="address_num_input" type="number" class="form-control" placeholder="N° rue" aria-label="address_num" aria-describedby="basic-addon1" name="address_num" />
                <input id="address_input" type="text" class="form-control" placeholder="Adresse" aria-label="address" aria-describedby="basic-addon1" name="address" />
              </div>


              <div class="form-group">
                <input type="text" class="form-control input_247px" placeholder="Ville" aria-label="town" aria-describedby="basic-addon1" name="town" />
              </div>


              <div class="form-group">
                <input type="text" class="form-control input_247px" placeholder="Numéro de téléphone" aria-label="num_tel" aria-describedby="basic-addon1" name="num_tel" />
              </div>

              <div id="capcha_verif_div" class="form-group">
                <label for="captcha_verif_input"><?php echo $_SESSION['captcha'];?></label>
                <input id="captcha_verif_input" type="text" class="form-control"  placeholder="Indiquez les numéros" aria-label="verif_captcha" aria-describedby="basic-addon1" name="verif_captcha" />
              </div>

              <div class="input-group-prepend d-flex justify-content-center" id="bouton_placement">
                <input type="submit" value="Valider" name="validate_button" class="btn btn-primary">
              </div><div class="space"></div>
              <?php
                if(isset($_GET['error']) && $_GET['error'] == 'email_taken'){
                  echo '<p style="color:rgb(90,98,104);text-align:center;">L\'email est déjà utilisé ! <a href="ConnexionIndex.php"><input type="button" class="btn btn-secondary btn-sm" value="Connexion"></a></p>';
                }

                if(isset($_GET['error']) && $_GET['error'] == 'captcha_novalide'){
                  echo '<p style="color:rgb(90,98,104);text-align:center;">Le captcha n\'est pas valide !</p>';
                }
              ?>
            </div>
          </div>
        </div>
      </form>
    </section>
  </section>
  <script src="verification_register.js"></script>
</main>

<?php
  include 'footer.php';
?>
