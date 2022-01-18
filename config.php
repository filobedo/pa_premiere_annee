<?php

  try{
    $bdd = new PDO('mysql:host=localhost;dbname=dbhuissier','huissier','Q111fr3d6l3m',array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e){
    die('Error:'. $e->getMessage());
  }

?>
