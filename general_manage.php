<?php
  include 'config.php';
  include 'header.php';

  if($isAdmin['cdtype_user'] != 'hui'){
    header('Location: homePage.php');
    exit;
  }
?>

<main>
  <section class="container-fluid container_fluid_homePage">
    <div class="row d-flex justify-content-center">
      <div class="col-md-3 col_homePage">
        <div class="row d-flex justify-content-center title_my_row">
          <h3>Types de dossier</h3>
        </div>
        <div class="row d-flex justify-content-center">
          <form class="general_manage_form" method="POST" action="general_manage_verification.php">
            <input type="text" placeholder="Abréviation du type dossier" name="newcdtype" />
            <input type="text" placeholder="Nom complet du type dossier" name="lbc" />
            <input type="number" placeholder="Prix de référence" name="prix" />
            <input class="btn btn-secondary" type="submit" value="Ajouter" name="submit_choice" /><br><br>
            <select class="form-control" name="folder_type_existing">
              <option value="default" default>Sélectionner un type à supprimer</option>
              <?php
                $folder_type_request = $bdd->query('SELECT cdtype,lbc FROM tabdossiers_type');

                while($type = $folder_type_request->fetch()){
              ?>
                  <option value="<?php echo $type['cdtype']; ?>"><?php echo $type['lbc']; ?></option>
              <?php } ?>
            </select>
            <div></div>
            <div class="space"></div>
            <input class="btn btn-secondary" type="submit" value="Supprimer" name="submit_choice" />
          </form>
          <?php
          if(isset($_GET['msg']) && $_GET['msg'] == 'add_succes'){
            echo 'Ajout effectué !';
          }

          if(isset($_GET['msg']) && $_GET['msg'] == 'delete_succes'){
            echo 'Suppression effectuée !';
          }

          if(isset($_GET['error']) && $_GET['error'] == 'input_unset'){
            echo 'Les champs ne sont pas remplis !';
          }

          if(isset($_GET['error']) && $_GET['error'] == 'deleting_error'){
            echo 'Le type de dossier à supprimer n\'est pas correct !';
          }?>
        </div>
      </div>


      <div class="col-md-4 col_homePage">
        <div class="row d-flex justify-content-center title_my_row">
          <h3> Gestion des prix </h3>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="form-elegant" >
            <div class="card">
              <nav>
                <ul class="nav nav-pills flex-column">
                  <?php

                    $doc_price_request = $bdd->query('SELECT cdtype,lbc,prix FROM tabdossiers_type');

                    while($doc_price = $doc_price_request->fetch()){
                  ?>
                      <li>
                        <div id="nav_item_position_general_manage">
                          <form class="general_manage_form" method="POST" action="price_management_modify.php">
                            <label><?php echo $doc_price['lbc'];?></label>
                            <input type="number" class="form-control" value="<?php echo $doc_price['prix'];?>" name="price" />
                            <input type="hidden" value="<?php echo $doc_price['lbc'];?>" name="type"/>
                            <input type="hidden" value="<?php echo $doc_price['cdtype'];?>" name="cdtype"/>
                            <div class="space"></div>
                            <input class="btn btn-secondary" type="submit" value="Modifier" />
                          </form>
                        <div class="space"></div>
                      </div>
                    </li>
              <?php }


          ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
</main>

<?php
  include 'footer.php';
?>
