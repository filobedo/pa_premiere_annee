<?php
  include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <body>
    <section class="container-fluid">
    <canvas id="canvas" width="500" height="800">Votre navigateur ne permet pas l'affichage du tableau</canvas>

      <?php

        $doc_price_request = $bdd->query('SELECT cdtype,lbc,prix FROM tabdossiers_type');

        while($doc_price = $doc_price_request->fetch()){
      ?>

      <form method="POST" action="price_management_modify.php">
        <label><?php echo $doc_price['lbc'];?></label>
        <input type="number" class="form-control" value="<?php echo $doc_price['prix'];?>" name="price" />
        <input type="hidden" value="<?php echo $doc_price['lbc'];?>" name="type"/>
        <input type="hidden" value="<?php echo $doc_price['cdtype'];?>" name="cdtype"/>
        <input type="submit" value="Modifier" />
      </form>
  <?php } ?>

      <a href="homePage.php"><input type="button" value="Retour" /></a>
    </section>

    <?php


      if(isset($_GET['status']) == 'validate'){
        echo 'Le tableau a bien été modifié.';
      }
    ?>
    <script src="canvas.js"></script>
  </body>
</html>
