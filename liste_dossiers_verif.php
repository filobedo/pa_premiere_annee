<?php
  session_start();
  include 'config.php';


  $id = $_GET['folder'];
  // $id = 'clem@outlook.com';

  $user_folder_request = $bdd->prepare("SELECT dossiers.description, dossiers.dtdeb, tabusers.nom, tabusers.prenom, tabusers.gender, tabdossiers_statut.lbc as statut, tabdossiers_type.lbc as type,dossiers.dtcrea, lnkdossiers.nmuser_huissier FROM tabusers, dossiers, tabdossiers_statut, tabdossiers_type,lnkdossiers
  WHERE dossiers.iddossier = ? AND dossiers.iddossier = lnkdossiers.iddossier AND lnkdossiers.nmuser_huissier = tabusers.nmuser AND dossiers.cdstatut = tabdossiers_statut.cdstatut AND dossiers.cdtype = tabdossiers_type.cdtype");

  $user_folder_request->execute(array($id));
  while($user_folder = $user_folder_request->fetch()){
    $gender = $user_folder['gender'] == 1 ? "Monsieur" : "Madame";
    echo '<div class="row d-flex justify-content-center title_my_row">';
    echo '<p id=title_folder><h3>' . $user_folder['description'] . '</h3></p>';
    echo '<h5><span class="badge badge-dark">' . $user_folder['type'] . '</span></h5>';
    echo '</div>';

    echo '<div id="scroll_folder" class="form-elegant" >';
    echo '<div id=under_srcoll>';
    echo '<div></div>';
    echo '<div class="form-group">';
    echo '<i id="size_date">Début du dossier le : ' . substr($user_folder['dtdeb'],0, -9) . '</i>';
    echo '<br><i>Statut : ' . $user_folder['statut'] . '</i>';
    echo '</div>';
    echo '<div></div>';

    echo '<div class="form-group">';
    echo '<h5>responsable du dossier : </p>' . $gender . ' ' . $user_folder['nom'] . ' ' . $user_folder['prenom'] . '</p></h5>';
    echo '</div>';
    echo '<div></div>';

    if($user_folder['statut'] != 'clos'){
      $rdv_date_request = $bdd->prepare("SELECT dtdebrdv FROM horaire,rdv,dossiers WHERE rdv.iddossier = dossiers.iddossier AND rdv.idhrdv = horaire.idhrdv AND rdv.iddossier = ? AND rdv.okconfirm = 1 AND rdv.oksuppr = 0");

      $rdv_date_request->execute(array($id));
      echo '<div class="form-group">';
      echo '<h5>Les prochaines rendez-vous : </h5>';
      while($rdv_date = $rdv_date_request->fetch()){
        echo '<p>' . $rdv_date['dtdebrdv'] . '</p><div></div>';
      }
      echo '</div>';
      echo '<div class="form-group">';
      echo '<label><h5>Prendre un rendez-vous sur ce dossier :</h5></label>' . ' ';include 'user_rdv.php';
      echo '</div>';
      // echo $user_folder['dtcrea']; // identique à dtdeb

      $file_pj_request = $bdd->prepare("SELECT nmrep,nmfic,nmfic_checksum,nmuserfic FROM tabpj,dossiers WHERE dossiers.iddossier = tabpj.iddossier AND dossiers.iddossier = ?");
      $file_pj_request->execute(array($id));

      echo '<div class="form-group">';
      echo '<h5>Les pièces jointes liées au dossier : </h5>';

      $j = 1;
      while($file_pj = $file_pj_request->fetch()){
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        echo '<div><a id="' . $file_pj['nmfic'] . '" href="' . $file_pj['nmrep'].$file_pj['nmfic'] . ' " download="' . $file_pj['nmuserfic'] . '">' . $file_pj['nmuserfic'] . '</a> <input class="btn btn-secondary" type="button" id="' . $file_pj['nmfic'] . '_button" value="Suppression du fichier" onclick="delete_file(\'' .  $file_pj['nmfic'] . '\')" /><div></div><div>';
      }
      echo '</div>';
      echo '<div class="form-group">';
      echo '<p>Envoyer un fichier : '; include 'envoi_file.php';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  }


?>
