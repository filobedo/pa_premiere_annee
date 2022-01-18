<?php
  //include 'header.php';
  // include 'config.php';

  // Suppression des rdv passés
  $rdv_passed_request = $bdd->query("SELECT idhrdv,dtdebrdv FROM horaire WHERE available = 1");

  date_default_timezone_set('Europe/Paris');

  while($rdv_passed = $rdv_passed_request->fetch()){
    if($rdv_passed['dtdebrdv'] < date("Y-m-d H:i:s")){
      $rdv_passed_delete = $bdd->prepare("DELETE FROM horaire WHERE idhrdv = ?");
      $rdv_passed_delete->execute(array($rdv_passed['idhrdv']));
    }
  }
  // echo $id;

  $rdv_verification_max_request = $bdd->prepare('SELECT count(iddossier) as nbrrdv FROM rdv WHERE iddossier = ? AND okconfirm = 0 AND oksuppr = 0');
  $rdv_verification_max_request->execute(array($id));
  $rdv_verification_max =  $rdv_verification_max_request->fetch();
?>
<form  method="POST" action="rdv_taken_by_user.php">
  <select multiple class="form-control" name="rdv" <?php if($rdv_verification_max['nbrrdv'] >= 4)echo 'disabled'; ?> > <!--disabled si le client à plus de 4 demandes-->
    <option value="default" selected <?php if($rdv_verification_max['nbrrdv'] >= 4)echo 'disabled';?>>Horaire...</option>
    <?php
      $rdv_available_display_request = $bdd->prepare('SELECT idhrdv,dtdebrdv FROM horaire WHERE available = 1 AND nmuser_huissier = ? ORDER BY dtdebrdv');
      $rdv_available_display_request->execute(array($user_folder['nmuser_huissier']));
      while($rdv_available_display = $rdv_available_display_request->fetch()){
    ?>
    <option value="<?php echo $rdv_available_display['idhrdv']; if($rdv_verification_max['nbrrdv'] >= 4)echo 'disabled';?>"><?php echo $rdv_available_display['dtdebrdv']; ?></option>
    <?php } ?>
  </select>
    <input type="hidden" value="<?php echo $id;?>" name="iddossier"/>
    <div class="space"></div>


    <input class="btn btn-secondary" type="submit" value="Valider" <?php if($rdv_verification_max['nbrrdv'] >= 4){echo 'disabled/>';?>
      <i>Vous avez ateint la limite de demande en attente sur ce dossier...</i>
    <?php }
     else echo '>' ?>
</form>
