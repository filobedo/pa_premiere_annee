<?php
  session_start();

  echo '<h2> Afin de terminer votre inscription, veuillez confirmer votre compte en cliquant sur le lien reçu à l\'adresse mail suivante : ';
  echo $_SESSION['email'].'</h2>';
?>
