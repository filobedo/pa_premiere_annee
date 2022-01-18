<?php
  session_start();
  include 'config.php';


  $research_user_request = $bdd->prepare("SELECT nmuser,gender,nom,prenom,idadresse FROM tabusers WHERE tabusers.nom LIKE :value OR tabusers.prenom LIKE :value OR tabusers.addrmail LIKE :value");

  $research_user_request->execute(array("value"=>$_GET['value']));

  while($users = $research_user_request->fetch()){
    $gender = $users['gender'] == 1 ? "Monsieur" : "Madame";
    echo "<li onclick='search_user(" . $users['idadresse'] . ")' class='d-flex justify-content-center'>";
    echo "<div class='nav_item_position_users'>";
    echo "<p>" . $gender . " " . $users['nom'] . " " . $users['prenom'] . "</p>";
    echo "</div>";
    echo "</li>";
  }
?>
