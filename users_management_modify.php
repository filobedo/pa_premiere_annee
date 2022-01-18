<?php
  include 'config.php';

  $gender = $_GET['gender'] == 'M.' ? 1 : 0;
  $okactif = $_GET['okactif'] == 'Activé' ? 1 : 0;


  $user_modify_request = $bdd->prepare('UPDATE tabusers,tabadresses,tabvilles SET gender = :gender,nom = :nom,prenom = :prenom,addrmail = :addrmail,dtnaissance = :dtnaissance,notel = :notel,okactif = :okactif,cdtype_user = :cdtype_user,num_rue = :num_rue,nom_rue = :nom_rue,lbville = :ville WHERE tabusers.idadresse = :idadresse AND tabusers.idadresse = tabadresses.idadresse AND tabadresses.idville = tabvilles.idville');
  $user_modify_request->execute(array('gender'=>$gender,
                                      'nom'=>$_GET['nom'],
                                      'prenom'=>$_GET['prenom'],
                                      'addrmail'=>$_GET['addrmail'],
                                      'dtnaissance'=>$_GET['dtnaissance'],
                                      'notel'=>$_GET['notel'],
                                      'okactif'=>$okactif,
                                      'cdtype_user'=>$_GET['cdtype_user'],
                                      'num_rue'=>$_GET['num_rue'],
                                      'nom_rue'=>$_GET['adresse'],
                                      'ville'=>$_GET['ville'],
                                      'idadresse'=>$_GET['idadresse']
                                ));
?>
