

<?php
  session_start();
  include 'config.php';

// if ($_FILES['file']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
// else{


	$ficname  = $_SESSION['nmuser']. "-" . date('Y-m-d H:i:s');


	//le renommer et stocker des valeures pour la bdd
	$file_name = $_FILES['fichier']['name'];     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$file_type = $_FILES['fichier']['type'];     //Le type du fichier. Par exemple, cela peut être « image/png ».
	$file_size = $_FILES['fichier']['size'];     //La taille du fichier en octets.
	$file_error = $_FILES['fichier']['error'];    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

  // var_dump($file_error);
  $maxSize = 8*1024*1024;   //8Mo

  if($file_size == 0){
    header('Location: liste_dossier.php?error=no_file');
    exit;
  }

  if($file_size > $maxSize){
    header('Location: liste_dossier.php?error=file_to_high');
    exit;
  }

	//déplacer le fichier
	$REP_SOURCE = $_FILES['fichier']['tmp_name']; //le répertoire tampon du fichier
	$REP_CIBLE = "fichier/".$ficname;
  var_dump($REP_SOURCE);
  sleep(2);
	if(move_uploaded_file($REP_SOURCE, $REP_CIBLE)){
    echo 'DONE';
  }
  else{
    echo 'ERROR';
  }

	$checksum = hash_file('md5', $REP_CIBLE); // pour vérifier lors du téléchargement du fichier que se soit bien le meme
	$requete = ("INSERT INTO  tabpj(nmhost,nmrep,nmfic,nmfic_checksum,nmuserfic,nboct,cdtype_mine,iddossier) VALUES('VPS','fichier/',:nmfic,:nmfic_checksum,:nmuserfic,:nboct,:cdtype_mine,:iddossier)");
	$req = $bdd->prepare($requete);
	$req->execute(array(
		"nmfic_checksum"  => $checksum,
		"nmfic" => $ficname, //nom du fichier stocké sur le serveur
		"nmuserfic" => $file_name, //vrai nom du fichier de l'user avec extension
		"nboct" => $file_size, //taille du fichier
		"cdtype_mine" => $file_type, //type du fichier
		"iddossier" => $_POST['id'] //id du dossier attribué
		// "dtcreafic" => STR_TO_DATE(CURRENT_TIMESTAMP, '%d-%m-%Y %h:%i:%s')
	));

  header('Location: liste_dossier.php?upload=ok');
  exit;

?>
