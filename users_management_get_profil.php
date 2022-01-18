<?php
  include 'config.php';

  $idadresse = $_GET['idadresse'];

  $user_profil_request = $bdd->prepare('SELECT gender,nom,prenom,addrmail,dtnaissance,notel,okactif,cdtype_user,num_rue,nom_rue,lbville as ville FROM tabusers INNER JOIN tabadresses,tabvilles WHERE tabusers.idadresse = ? AND tabusers.idadresse = tabadresses.idadresse AND tabadresses.idville = tabvilles.idville');
  $user_profil_request->execute(array($idadresse));
  $user_profil = $user_profil_request->fetch();

  $gender = $user_profil['gender'] == 1 ? "Monsieur" : "Madame";

  echo "<div class='row d-flex justify-content-center title_my_row'>";
  echo "<h3>" . $gender . " " . $user_profil['nom'] . " " . $user_profil['prenom'] . "</h3>";
  echo "</div>";

  echo "<form method='POST' action='users_manangement_modify' name='modify_form'>";
  echo "<div id='users_management_input_row' class='form-group row'>";
  echo "<div class='mx-auto'>";

  echo "<div class='form-group'>";
  echo "<select id='gender' name='gender'>";
  echo "<option value='" . (($user_profil['gender'] == "1") ? "M." : "Mme.") . "' default>" . (($user_profil['gender'] == "1") ? "M." : "Mme.") . "</option>";
  echo "<option value='" . (($user_profil['gender'] == "1") ? "Mme." : "M.") . "'>" . (($user_profil['gender'] == "1") ? "Mme." : "M.") . "</option>";
  echo "</select>";
  echo "</div>";

  echo "<div class='form-group users_management_display_input_inline_block'>";
  echo "<input id='nom' type='text' class='form-control' placeholder='Nom' aria-label='lastname' aria-describedby='basic-addon1' name='lastname' value='" . $user_profil['nom'] . "'/>";
  echo "<input id='prenom' type='text' class='form-control' placeholder='Prénom' aria-label='firstname' aria-describedby='basic-addon1' name='firstname' value='" . $user_profil['prenom'] . "'/>";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<input id='dtnaissance' type='date' class='form-control input_display_users_right' aria-label='birthday' aria-describedby='basic-addon1' name='birthday' value='" . $user_profil['dtnaissance'] . "'/>";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<input id='addrmail' type='text' class='form-control input_display_users_right' placeholder='Mail' aria-label='email' aria-describedby='basic-addon1' name='email' value='" . $user_profil['addrmail'] . "' />";
  echo "</div>";

  echo "<div id='users_management_address_and_num_div' class='form-group'>";
  echo "<input id='users_management_address_num_input' type='number' class='form-control' placeholder='N° rue' aria-label='address_num' aria-describedby='basic-addon1' name='address_num' value='" . $user_profil['num_rue'] . "'/>";
  echo "<input id='users_management_address_input' type='text' class='form-control' placeholder='Adresse' aria-label='address' aria-describedby='basic-addon1' name='address' value='" . $user_profil['nom_rue'] . "' />";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<input id='ville' type='text' class='form-control input_247px' placeholder='Ville' aria-label='tow' aria-describedby='basic-addon1' name='town' value='" . $user_profil['ville'] . "'/>";
  echo "</div>";

  echo "<div class='form-group'>";
  echo "<input id='notel' type='text' class='form-control input_247px' placeholder='Numéro de téléphone' aria-label='num_tel' aria-describedby='basic-addon1' name='num_tel' value='" . $user_profil['notel'] . "'/>";
  echo "</div>";

  echo "<div class='form-group display_input_inline_block'>";
  echo "<select id='cdtype_user' class='padding_select' name='cdtype_user'>";
  echo "<option value='" . $user_profil['cdtype_user'] . "' default>" . $user_profil['cdtype_user'] . "</option>";
  echo "<option value='" . (($user_profil['cdtype_user'] == "hui") ? "cli" : "hui") . "'>" . (($user_profil['cdtype_user'] == "hui") ? "cli" : "hui") . "</option>";
  echo "</select>";
  echo "<select id='okactif' class='padding_select' name='okactif'>";
  echo "<option value='" . (($user_profil['okactif'] == "1") ? "Activé" : "Désactivé") . "' default>" . (($user_profil['okactif'] == "1") ? "Activé" : "Désactivé") . "</option>";
  echo "<option value='". (($user_profil['okactif'] == "1") ? "Désactivé" : "Activé") . "'>". (($user_profil['okactif'] == "1") ? "Désactivé" : "Activé") . "</option>";
  echo "</select>";
  echo "</div>";

  echo "</div>";
  echo "</div>";

  echo "</form>";

  echo "<div class='row d-flex justify-content-center'>";
  echo "<input type='button' class='btn btn-secondary' onclick='user_modify(" . $idadresse . ")' value='Modifier'/>";
  echo "</div>";
?>
