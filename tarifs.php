<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <body>

    <?php
      $nbr_row = 0;
      $doc_price_request = $bdd->query('SELECT cdtype,lbc,prix FROM tabdossiers_type');

      while($doc_price = $doc_price_request->fetch()){
        $nbr_row += 1;
    ?>
        <input type="hidden" value="<?php echo $doc_price['prix'];?>" name="price" />
        <input type="hidden" value="<?php echo $doc_price['lbc'];?>" name="type"/>
    <?php
      }

    // télécharger un fichier csv
    $tabtype_request = $bdd->query('SELECT lbc,lb,prix FROM tabdossiers_type');
    $excel_fic = fopen('file_export/export.csv','w+');
    fseek($excel_fic,0,SEEK_END);

    while($type_row = $tabtype_request->fetch()){
    $tabusers_infos = $type_row['lbc'] . ';' . $type_row['lb'] . ';' . $type_row['prix'] . "\r\n";
    fputs($excel_fic,$tabusers_infos);
    }
    fclose($excel_fic);
    ?>

    <div class="d-flex justify-content-center">
      <canvas id="canvas" width="450" height="<?php echo $nbr_row*85;?>">Votre navigateur ne permet pas l'affichage du tableau</canvas>
    </div>

    <div class="d-flex justify-content-center">
      <a href="file_export/export.csv"><input type="button" class="btn btn-secondary btn-sm" value="Exporter les tarifs"/></a>
    </div>


    <script src="canvas.js"></script>
  </body>

<?php
  include 'footer.php';
?>
