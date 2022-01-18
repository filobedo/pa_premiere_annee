<?php
  include 'header.php';
  include 'config.php';

  //VERIFICATION QUE L'USER A BIEN LA PERMISSION D'ACCEDER A LA PAGE
  if($isAdmin['cdtype_user'] != 'hui'){
    header('Location: homePage.php');
    exit;
  }
?>
<main>
  <section class="container_fluid container_fluid_homePage">
    <div class="row d-flex justify-content-center">
      <div class="col-md-3 col_homePage">
        <div class="row d-flex justify-content-center title_my_row">
          <h3>Nouvelle plage horaire</h3>
        </div>
        <div class="row d-flex justify-content-center">
          <form method="POST" action="rdv_management_verification.php">
            <input type='date' name="rdv_day" />
            <input type="time" name="rdv_hours" />
            <input type="submit" class="btn btn-secondary" value="Ajouter" />
          </form>
        </div>
        <div class="row d-flex justify-content-center">
          <h3 id="rdv_validation_title">Validation rendez-vous</h3>
        </div>
        <div class="row d-flex justify-content-center">
          <div id="form_elegant_rdv_validation" class="form-elegant">
            <div class="card">
              <nav>
                <ul class="nav nav-pills flex-column">
                <?php

                  $waiting_rdv_request = $bdd->prepare('SELECT horaire.idhrdv,dtdebrdv,nom,prenom,iddossier FROM horaire,tabusers,rdv WHERE rdv.okconfirm = 0 AND rdv.oksuppr = 0 AND rdv.idhrdv = horaire.idhrdv AND horaire.nmuser_huissier = ? AND rdv.nmuser = tabusers.nmuser');
                  $waiting_rdv_request->execute(array($_SESSION['nmuser']));

                  while($rdv = $waiting_rdv_request->fetch()){
                ?>
                  <li class="d-flex justify-content-center">
                    <div class="nav_item_position">
                      <form method="POST" class="validation_form" action="user_rdv_management_validation.php">
                        <p>Le <?php echo $rdv['dtdebrdv']; ?> </p>
                        <p>Par <?php echo $rdv['nom'] . ' ' . $rdv['prenom'];?> - Dossier n°<?php echo $rdv['iddossier'];?></p>
                        <div class="space"></div>
                        <input type="submit" class="btn btn-secondary btn-sm" value="Accepter" name="validation" />
                        <input type="submit" class="btn btn-secondary btn-sm" value="Refuser" name="validation" />
                        <input type="hidden" value="<?php echo $rdv['idhrdv'];?>" name="idhrdv" />
                      </form>
                    </div>
                  </li>
                <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
      <?php
      // date_default_timezone_set('Europe/Paris');
      // echo date('H:i'). ' HEURE ACTUELLE<br>';
      // echo strtotime(date('H:i')) . ' HEURE ACTUELLE CONVERTIE<br>';
      // echo strtotime('21:26'). '<br>';
      // echo strtotime('19:00'). '<br>';
      // echo strtotime(date('d/m/Y')) . ' DATE ACTUELLE<br>';
      // echo strtotime('07/04/2019'). ' DATE DU 07<br>';
      // echo strtotime('05/04/2019'). ' DATE DU 05<br>';

      if(isset($_GET['error']) && $_GET['error'] == 'rdv_always_taken'){
        echo '<p class="p_display_error">La plage horaire est déjà enregistré !</p>';
      }

      if(isset($_GET['msg']) && $_GET['msg'] == 'succes'){
        echo '<p class="p_display_error">Plage horaire enregistré avec succes !</p>';
      }

      if(isset($_GET['error']) && $_GET['error'] == 'rdv_not_valide'){
        echo '<p class="p_display_error">Le rendez-vous n\'est pas valide !</p>';
      }

    ?>
</main>

<?php
  include 'footer.php';
?>
