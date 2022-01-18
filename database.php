<?php

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "huissier";

  $connection = new PDO('mysql:host=eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=w4il7azumiv2xt1p','g33r61swshdedkxg','p61cycjkchky0cvm', array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));

  $result = $connection->query("SELECT * FROM tabusers");

    while($row = $result->fetch()){
      echo $row['nmuser'];
    }
?>
