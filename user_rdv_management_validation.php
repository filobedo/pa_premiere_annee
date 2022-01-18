<?php
  include 'config.php';

  if($_POST['validation'] == 'Accepter'){
    $user_rdv_validate_request = $bdd->prepare('UPDATE rdv SET okconfirm = 1 WHERE idhrdv = ?');
    $user_rdv_validate_request->execute(array($_POST['idhrdv']));

    header('Location: rdv_management.php?msg=accepted');
    exit;
  }
  else{
    $user_rdv_validate_request = $bdd->prepare('UPDATE rdv SET oksuppr = 1 WHERE idhrdv = ?');
    $user_rdv_validate_request->execute(array($_POST['idhrdv']));

    header('Location: rdv_management.php?msg=refused');
    exit;
  }

?>
