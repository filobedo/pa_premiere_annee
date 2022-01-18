<?php
  session_start();
  include 'config.php';


  $id = $_GET['folder'];
  // $id = 'clem@outlook.com';

  $user_folder_request = $bdd->prepare("SELECT dossiers.description, dossiers.dtdeb, tabusers.nom, tabusers.prenom, tabusers.gender, tabdossiers_statut.lbc as statut, tabdossiers_type.lbc as type,dossiers.dtcrea, lnkdossiers.nmuser_huissier,dossiers.dtfin FROM tabusers, dossiers, tabdossiers_statut, tabdossiers_type,lnkdossiers
  WHERE dossiers.iddossier = ? AND dossiers.iddossier = lnkdossiers.iddossier AND lnkdossiers.nmuser_huissier = tabusers.nmuser AND dossiers.cdstatut = tabdossiers_statut.cdstatut AND dossiers.cdtype = tabdossiers_type.cdtype");

  $user_folder_request->execute(array($id));
  while($user_folder = $user_folder_request->fetch()){
    echo '<section class="container-fluid"> <div class="row">'. '<div class="col-md-12"><h3>' . $user_folder['description'] . '</span><h5> [' . $user_folder['type'] . ']</h5></section>';
    echo '<div></div><i id="size_date">' . substr($user_folder['dtdeb'],0, -9) . '</i><div></div></h3>';
    echo 'responsable du dossier : ' . $user_folder['nom'] . ' ' . $user_folder['prenom'] . '<div></div>';
    echo 'Statut : ' . $user_folder['statut'] . '</div></div><div></div>';
    if($user_folder['dtfin'] != '0000-00-00 00:00:00')
      echo 'date de fin du dossier : ' . $user_folder['dtfin'] ;



    if($user_folder['statut'] != 'clos'){
      $file_pj_request = $bdd->prepare("SELECT nmrep,nmfic,nmfic_checksum,nmuserfic FROM tabpj,dossiers WHERE dossiers.iddossier = tabpj.iddossier AND dossiers.iddossier = ?");
      $file_pj_request->execute(array($id));


      echo '<p>Les pièces jointes liées au dossier : </p>';

      $j = 1;
      while($file_pj = $file_pj_request->fetch()){
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        echo '<a id="' . $file_pj['nmfic'] . '" href="' . $file_pj['nmrep'].$file_pj['nmfic'] . ' " download="' . $file_pj['nmuserfic'] . '">' . $file_pj['nmuserfic'] . '</a> <input type="button" id="' . $file_pj['nmfic'] . '_button" value="Suppression du fichier" onclick="delete_file(\'' .  $file_pj['nmfic'] . '\')" /><div></div>';
      }
      echo '<p>Envoyer un fichier : '; include 'envoi_file.php';
    }
    if($user_folder['statut'] != 'clos'){
      echo '<input type="hidden" id="verif_type_file" value="1">';
    }
    else{
      echo '<input type="hidden" id="verif_type_file" value="0">';
    }
  }


  // http_response_code(200);

?>
