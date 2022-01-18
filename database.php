<?php

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "huissier";

  $connection = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password, array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));

  $result = $connection->query("SELECT * FROM tabusers");

    while($row = $result->fetch()){
      echo $row['nmuser'];
    }
?>
