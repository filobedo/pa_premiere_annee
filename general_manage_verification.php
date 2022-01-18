<?php
  include 'config.php';

  if($_POST['submit_choice'] == 'Ajouter'){

    if(empty($_POST['newcdtype']) || empty($_POST['lbc']) || empty($_POST['prix'])){
      header('Location: general_manage.php?error=input_unset');
      exit;
    }

    $insert_type_folder = $bdd->prepare('INSERT INTO tabdossiers_type(cdtype,lbc,prix) VALUES(:cdtype,:lbc,:prix)');
    $insert_type_folder->execute(array('cdtype'=>$_POST['newcdtype'],'lbc'=>$_POST['lbc'],'prix'=>$_POST['prix']));

    header('Location: general_manage.php?msg=add_succes');
    exit;
  }
  else{

    if($_POST['folder_type_existing'] == 'default'){
      header('Location: general_manage.php?error=deleting_error');
      exit;
    }
    
    $delete_type_folder = $bdd->prepare('DELETE FROM tabdossiers_type WHERE cdtype = ?');
    $delete_type_folder->execute(array($_POST['folder_type_existing']));

    header('Location: general_manage.php?msg=delete_succes');
    exit;
  }
?>
