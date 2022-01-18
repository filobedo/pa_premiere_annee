<?php
  include 'config.php';

  $tabusers_request = $bdd->query('SELECT nmuser,prenom,nom FROM tabusers');


  $excel_fic = fopen('export.csv','r+');

  fseek($excel_fic,0,SEEK_END);


  while($users_row = $tabusers_request->fetch()){
    $tabusers_infos = $users_row['nmuser'] . ';' . $users_row['prenom'] . ';' . $users_row['nom'] . "\r\n";
    fputs($excel_fic,$tabusers_infos);
  }
   fclose($excel_fic);
?>
