<?php
  include 'config.php';
  include 'header.php';
  date_default_timezone_set("Europe/Paris");

  if(!isset($_SESSION['nmuser'])){
    header('Location: index.php');
    exit;
  }
  $isAdmin_request = $bdd->prepare('SELECT cdtype_user FROM tabusers WHERE nmuser = :nmuser');
  $isAdmin_request->execute(array('nmuser'=>$_SESSION['nmuser']));
  $isAdmin = $isAdmin_request->fetch();

  $rdv_passed_request = $bdd->prepare('SELECT idrdv,dtdebrdv FROM horaire,rdv WHERE rdv.oksuppr = 0 AND horaire.idhrdv = rdv.idhrdv AND horaire.nmuser_huissier = ?');
  $rdv_passed_request->execute(array($_SESSION['nmuser']));

  while($rdv_passed = $rdv_passed_request->fetch()){
    if($rdv_passed['dtdebrdv'] < date("Y-m-d H:i:s")){
      $rdv_passed_oksuppr = $bdd->prepare('UPDATE rdv SET oksuppr = 1 WHERE idrdv = ?');
      $rdv_passed_oksuppr->execute(array($rdv_passed['idrdv']));
    }
  }
?>

<main>
    <section class="container-fluid container_fluid_homePage">
      <div class="row d-flex justify-content-center">
        <div class="col-md-3 col_homePage">
          <div class="row d-flex justify-content-center title_my_row">
            <h3> Mes rendez-vous </h3>
          </div>
          <div class="row d-flex justify-content-center">
            <section class="form-elegant">
              <div class="card">
                <nav>
                  <ul class="nav nav-pills flex-column">
                      <p class="title_rdv">Rendez-vous du jour</p>
                      <?php
                        $i = 0;
                        if($isAdmin['cdtype_user'] == 'hui'){
                          $user_rdv_today = $bdd->prepare('SELECT dtdebrdv,iddossier,nom,prenom,gender FROM horaire,rdv,tabusers WHERE horaire.nmuser_huissier = ? AND horaire.idhrdv = rdv.idhrdv AND rdv.okconfirm = 1 AND rdv.nmuser = tabusers.nmuser AND rdv.oksuppr = 0 ORDER BY dtdebrdv');
                          $user_rdv_today->execute(array($_SESSION['nmuser']));
                        }
                        else{
                          $user_rdv_today = $bdd->prepare('SELECT dtdebrdv,iddossier,nom,prenom,gender FROM horaire,rdv,tabusers WHERE rdv.nmuser= ? AND horaire.idhrdv = rdv.idhrdv AND rdv.okconfirm = 1 AND horaire.nmuser_huissier = tabusers.nmuser AND rdv.oksuppr = 0 ORDER BY dtdebrdv');
                          $user_rdv_today->execute(array($_SESSION['nmuser']));
                        }
                        while($rdv = $user_rdv_today->fetch()){
                          $gender = $rdv['gender'] == 1 ? 'Monsieur' : 'Madame';

                          if(substr($rdv['dtdebrdv'],0,-9) == date("Y-m-d")){
                      ?>
                        <li class="d-flex justify-content-center">
                          <div class="nav_item_position">
                            <p>Dossier n°<?php echo $rdv['iddossier']; ?></p>
                            <p>Le <?php echo '<i>' . $rdv['dtdebrdv'] . '</i>';?> </p>
                            <p><?php echo $gender . ' ' . $rdv['nom'] . ' ' . $rdv['prenom']; ?></p>
                          </div>
                        </li>
                      <?php
                          }
                          else{
                            if($i == 0){
                              echo '<p class="title_rdv">Mes prochaines rendez-vous</p>';
                              $i++;
                            }
                      ?>
                        <li class="d-flex justify-content-center">
                          <div class="nav_item_position">
                            <p>Dossier n°<?php echo $rdv['iddossier']; ?></p>
                            <p>Le <?php echo '<i>' . $rdv['dtdebrdv'] . '</i>';?> </p>
                            <p><?php echo $gender . ' ' . $rdv['nom'] . ' ' . $rdv['prenom']; ?></p>
                          </div>
                        </li>
                      <?php
                          }
                        }
                        ?>
                    </ul>
                  </nav>
                </div>
              </section>
            </div>
          </div>


            <?php
              $isAdmin_request = $bdd->prepare('SELECT cdtype_user FROM tabusers WHERE nmuser = :nmuser');
              $isAdmin_request->execute(array('nmuser'=>$_SESSION['nmuser']));
              $isAdmin = $isAdmin_request->fetch();

              if($isAdmin['cdtype_user'] == 'hui'){
                $open_folder_request = $bdd->prepare("SELECT tabusers.nom,tabusers.prenom,tabusers.gender,lbc,lnkdossiers.iddossier FROM tabusers,tabdossiers_type INNER JOIN lnkdossiers,dossiers WHERE tabusers.nmuser = lnkdossiers.nmuser_client AND lnkdossiers.iddossier = dossiers.iddossier AND lnkdossiers.nmuser_huissier = :nmuser_huissier AND tabdossiers_type.cdtype = dossiers.cdtype");
                $open_folder_request->execute(array('nmuser_huissier'=>$_SESSION['nmuser']));
                $new_folder_request = $bdd->query("SELECT tabusers.nom,tabusers.prenom,tabusers.gender,lbc,lnkdossiers.iddossier FROM tabusers,tabdossiers_type INNER JOIN lnkdossiers,dossiers WHERE tabusers.nmuser = lnkdossiers.nmuser_client AND lnkdossiers.iddossier = dossiers.iddossier AND dossiers.cdstatut = 'new' AND tabdossiers_type.cdtype = dossiers.cdtype");
            ?>
            <div class="col-md-3 col_homePage">
              <div class="row d-flex justify-content-center title_my_row">
              <h3> Nouveaux dossiers </h3>
              </div>
              <div class="row d-flex justify-content-center">
                <div class="form-elegant">
                  <div class="card">
                    <nav>
                      <ul class="nav nav-pills flex-column">
                          <?php
                          while($new_folder = $new_folder_request->fetch()){
                            $gender = $new_folder['gender'] == 1 ? 'Monsieur' : 'Madame';
                         ?>
                            <li class="d-flex justify-content-center">
                              <div class="nav_item_position">
                                <p><?php echo $gender . ' ' . $new_folder['nom'] . ' ' . $new_folder['prenom'] . ' - Dossier n°: ' . $new_folder['iddossier']; ?></p>
                                <p><? echo $new_folder['lbc']; ?></p><div class="space"></div>
                                <div class="d-flex justify-content-center">
                                  <form method="POST" action="new_folder_validation.php">
                                    <input type="hidden" value="<?php echo $new_folder['iddossier']; ?>" name="iddossier" />
                                    <input type="submit" class="btn btn-secondary btn-sm" value="Accepter" />
                                  </form>
                                </div>
                              </div>
                            </li>
                          <?php
                            }

                           ?>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            <?php

              while($new_folder = $new_folder_request->fetch()){
                $gender = $new_folder['gender'] == 1 ? 'Monsieur' : 'Madame';
             ?>
                <li class="d-flex justify-content-center">
                  <div class="nav_item_position">
                    <p><?php echo $gender . ' ' . $new_folder['nom'] . ' ' . $new_folder['prenom'] . ' - Dossier n°: ' . $new_folder['iddossier']; ?></p>
                    <p><? echo $new_folder['lbc']; ?></p>
                    <form method="POST" action="new_folder_validation.php">
                      <input type="hidden" value="<?php echo $new_folder['iddossier']; ?>" name="iddossier" />
                      <input type="submit" class="btn btn-secondary btn-sm" value="Accepter" />
                    </form>
                  </div>

              <?php
                }

               ?>
            </div>


          <div class="col-md-3 col_homePage">
            <div class="row d-flex justify-content-center title_my_row">
              <h3> Mes dossiers en cours </h3>
            </div>
            <div class="row d-flex justify-content-center search_bar">
              <div class="col-xs-2">
                <input id="research_folder_input" class="form-control" type="search" onchange=" research_folder_by_search_input()" placeholder="Rechercher" size="25"/>
              </div>
            </div>
            <div class="row d-flex justify-content-center">
              <div class="form-elegant" >
                <div class="card">
                  <nav>
                    <ul id="display_open_folder" class="nav nav-pills flex-column">
                      <?php
                        while($open_folder = $open_folder_request->fetch()){
                          $gender = $open_folder['gender'] == 1 ? 'Monsieur' : 'Madame';
                      ?>
                        <li data-toggle="modal" data-target="#folderModal" data-whatever="@mdo" onclick="finFile(<?php echo $open_folder['iddossier'];?>)" class="d-flex justify-content-center">
                          <div class="nav_item_position">
                            <p><?php echo ' Dossier n°: ' . $open_folder['iddossier'] . '<br>' . $gender . ' ' . $open_folder['nom'] . ' ' . $open_folder['prenom']; ?></p>
                            <p><?php echo $open_folder['lbc']; ?></p>
                          </div>
                        </li>
                      <?php
                    }
                    ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        else{
          $user_folder_request = $bdd->prepare("SELECT tabusers.nom,tabusers.prenom,tabusers.gender,lbc,lnkdossiers.iddossier,lnkdossiers.nmuser_huissier,dossiers.description FROM tabusers,tabdossiers_type,lnkdossiers,dossiers WHERE lnkdossiers.nmuser_client = :nmuser AND tabusers.nmuser = lnkdossiers.nmuser_huissier AND dossiers.cdtype = tabdossiers_type.cdtype AND lnkdossiers.iddossier = dossiers.iddossier");
          $user_folder_request->execute(array('nmuser'=>$_SESSION['nmuser']));
        ?>
        <div class="col-md-3 col_homePage">
          <div class="row d-flex justify-content-center title_my_row">
            <h3>Mes dossiers en cours</h3>
          </div>
          <div class="row d-flex justify-content-center">
            <div  class="form-elegant">
              <div class="card">
                    <nav>
                      <ul class="nav nav-pills flex-column">
                        <?php
                          while($user_folder = $user_folder_request->fetch()){
                            $gender = $user_folder['gender'] == 1 ? 'Monsieur' : 'Madame';
                             ?>
                             <li class="d-flex justify-content-center">
                               <div class="nav_item_position">
                                 <p><?php echo $user_folder['description'] . ' [' . $user_folder['lbc'] . ']'; ?></p>
                                 <p>Votre huissier : </p>
                                 <p><?php echo ' ' . $gender . ' ' . $user_folder['nom'] . ' ' . $user_folder['prenom']; ?></p>
                               </div>
                             </li>
                          <?php }
                        }

                          ?>
                      </ul>
                    </nav>
                </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="folderModal" tabindex="-1" role="dialog" aria-labelledby="iddossier_lb" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="iddossier_lb"></h5>

              </div>
              <div class="modal-body" id="info_doss">
                <!-- Contenu du dossier -->
              </div>
              <div id="bouton_suppr" class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="close_button" class="btn btn-primary">clore le dossier</button>
              </div>
            </div>
          </div>
        </div>

            <?php

              if($isAdmin['cdtype_user'] != 'hui'){?>

                  <div class="col-md-3 col_homePage_new_folder">
                    <form method="POST" action="create_folder_verification.php">
                      <div class="row d-flex justify-content-center title_my_row">
                        <h3>Ouvrir un dossier</h3>
                      </div>
                      <div class="row d-flex justify-content-center center_new_folder_users">
                        <div class="col-xs-2">
                          <select class="form-control" name="folder_type">
                            <option value="default">Sélectionner le type de dossier</option>
                          <?php
                             $folder_type_request = $bdd->query('SELECT cdtype,lbc FROM tabdossiers_type');

                              while($type = $folder_type_request->fetch()){
                          ?>
                              <option value="<?php echo $type['cdtype']; ?>"><?php echo $type['lbc']; ?></option>
                         <?php } ?>
                          </select>
                        </div>
                      </div><div class="space"></div>
                      <div class="row d-flex justify-content-center">
                        <div class="col-xs-2">
                          <input type="text" class="form-control connexion_input" placeholder="Nom du dossier" aria-label="Username" aria-describedby="basic-addon1" name="nom"><div class="space"></div>
                        </div>
                      </div>

                      <div class="row d-flex justify-content-center">
                        <input type="submit" class="btn btn-secondary btn-sm" value="Nouveau dossier" />
                      </div>
                    </form><div class="space"></div>

                    <?php
                      if(isset($_GET['error']) && $_GET['error'] == 'open_folder_failed'){
                        echo "<p class='p_display_error'>Les champs ne sont pas correctement remplis !</p>";
                      }

                      if(isset($_GET['msg']) && $_GET['msg'] == 'create_folder_succes'){
                        echo "<p class='p_display_error'>Dossier créé avec succès !</p>";
                      }

                    ?>
                  </div>






             <?php } ?>

        </div>
      </div>
    </section>

    <script type="text/javascript" src="homePage.js"></script>
    <script type="text/javascript" src="jsdossiers.js"></script>
</main>
<div class="space"></div>

<?php
include 'footer.php';
?>
