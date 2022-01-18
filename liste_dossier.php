<?php
  include 'header.php';
  include 'config.php';

  if($isAdmin['cdtype_user'] == 'hui'){
    header('Location: homePage.php');
    exit;
  }
 ?>

<main>


    <section class="container-fluid container_fluid_homePage">
      <div class="row d-flex justify-content-center">
        <div class="col-md-2 col_homePage">
          <div class="row d-flex justify-content-center title_my_row">
            <h3>Mes dossiers</h3>
          </div>

          <div class="row d-flex justify-content-center">
            <div class="form-elegant" >
              <div class="card">
                <nav>
                  <ul id="display_users" class="nav nav-pills flex-column ">

                    <?php
                      $requete = "SELECT dossiers.iddossier, dossiers.description,dossiers.cdstatut FROM dossiers,tabusers,lnkdossiers,tabdossiers_statut
                      where tabusers.nmuser = ? AND tabusers.nmuser = lnkdossiers.nmuser_client AND lnkdossiers.iddossier = dossiers.iddossier AND dossiers.cdstatut = tabdossiers_statut.cdstatut AND dossiers.cdstatut !='close'";
                      $req = $bdd->prepare($requete);

                      $req->execute(array($_SESSION['nmuser']));
                      while($folder = $req->fetch()){

                        if($folder['cdstatut'] != "new"){
                          echo '<li  onclick="research(' . $folder['iddossier'] . ')" class="d-flex justify-content-center">';
                          echo '<div class="nav_item_position_folders">';
                          echo '<p>Dossier ' . $folder['iddossier'] . ' :<br>' . $folder['description'] . '</p>';
                          echo '</div></li>';
                        }
                        else{
                          echo '<li class="nav-item_en_cours">';
                          echo '<div id="en_cours" class="nav_item_position_folders_yellow">';
                          echo '<p>Dossier ' . $folder['iddossier'] . ' :<br>' . $folder['description'] . '<br>(En attente de validation)</p>';
                          echo '</div></li>';
                        }
                      }
                    ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>


        <div id="section1" class="col-md-5 col_homePage"> <!--le dossier-->
          <!-- <div id="section1" class="dossier"> -->
            <h3 class="row d-flex justify-content-center title_my_row">Choisissez un dossier</h3>

          </div>
        </div>
      </div>
    </section>

    <section id='end'> <!--pour placer le footer correctement-->
      <!-- <input type="button" onclick="mafonction()"/>
      gdqsgqgfqgiu -->
    </section>
    <script src="jsdossiers.js"> </script>
  </main>

  <?php include 'footer.php'; ?>
