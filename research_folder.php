<?php

  include 'config.php';
  session_start();

  $research_folder_request = $bdd->prepare("SELECT tabusers.nom,tabusers.prenom,tabusers.gender,lbc,lnkdossiers.iddossier FROM tabusers,tabdossiers_type,lnkdossiers,dossiers WHERE
                                            dossiers.iddossier = lnkdossiers.iddossier AND lnkdossiers.nmuser_huissier = :nmuser_huissier AND tabusers.nmuser = lnkdossiers.nmuser_client
                                            AND dossiers.cdtype = tabdossiers_type.cdtype AND tabusers.prenom LIKE :prenom OR dossiers.iddossier = lnkdossiers.iddossier
                                            AND lnkdossiers.nmuser_huissier = :nmuser_huissier AND tabusers.nmuser = lnkdossiers.nmuser_client AND dossiers.cdtype = tabdossiers_type.cdtype
                                            AND tabusers.nom LIKE :nom");

  $research_folder_request->execute(array('nmuser_huissier'=>$_SESSION['nmuser'],'prenom'=>$_GET['value'],'nom'=>$_GET['value']));

  while($research_folder = $research_folder_request->fetch()){
    $gender = $research_folder['gender'] == 1 ? "Monsieur" : "Madame";
    echo "<li onclick='finFile(" . $research_folder['iddossier'] . ")' class='d-flex justify-content-center'>";
    echo "<div class='nav_item_position'>";
    echo "<p data-toggle='modal' data-target='#folderModal' data-whatever='@mdo'>" . ' Dossier n°: ' . $research_folder['iddossier']  . '<br>' . $gender . ' ' . $research_folder['nom'] . ' ' . $research_folder['prenom'] . "</p>";
    echo "<p>" . $research_folder['lbc'] . "</p>";
    echo "</div>";
    echo "</li>";
  }
?>
