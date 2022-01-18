<form method="post" action="verif_file.php" enctype="multipart/form-data">
  <input type="file" placeholder="envoyer un fichier(8Mo max)" name="fichier" />
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input class="btn btn-secondary" type="submit" name="submit" value="Envoyer" />
</form>
