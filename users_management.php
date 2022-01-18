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
        <div class="col-md-2 col_homePage">
          <div class="row d-flex justify-content-center title_my_row">
            <h3>Clients</h3>
          </div>
          <div class="row d-flex justify-content-center search_bar">
            <div class="col-xs-2">
              <input id="research_user_input" onchange="research_users_by_search_input()" class="form-control" type="search" placeholder="Rechercher" aria-label="Search">
            </div>
          </div>
          <div class="row d-flex justify-content-center">
            <div class="form-elegant">
              <div class="card">
                <nav>
                  <ul id="display_users" class="nav nav-pills flex-column">
                    <?php

                      $users_request = $bdd->query('SELECT nmuser,gender,nom,prenom,idadresse FROM tabusers');

                      while($users = $users_request->fetch()){
                        if($users['nmuser'] != $_SESSION['nmuser']){
                          $gender = $users['gender'] == 1 ? "Monsieur" : "Madame";
                    ?>
                          <li onclick="search_user(<?php echo $users['idadresse'];?>)" class="d-flex justify-content-center">
                            <div class="nav_item_position_users">
                              <p><?php echo $gender . ' ' . $users['nom'] . ' ' . $users['prenom'];?></p>
                            </div>
                          </li>
                  <?php
                      }
                    }
                  ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <div id="user_infos" class="col-md-5 col_homePage">
          <h5 id="users_select_message"><i>Veuillez sélectionner un client</i></h5>
      </div>
    </section>

      <?php
        if(isset($_GET['status']) == 'validate'){
          echo 'Le compte a bien été modifié !';
        }
      ?>
    <script src="users_management.js"></script>
</main>

<?php
  include 'footer.php';
?>
