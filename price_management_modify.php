<?php
  include 'config.php';

  $doc_request_modify = $bdd->prepare('UPDATE tabdossiers_type SET prix = :price WHERE cdtype = :cdtype');
  $doc_request_modify->execute(array('price'=>$_POST['price'],'cdtype'=>$_POST['cdtype']));

  header('Location: general_manage.php?status=validate');
  exit;

 ?>
