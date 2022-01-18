function search_user(idadresse){
  var xhr = new XMLHttpRequest();

  xhr.open('GET','users_management_get_profil.php?idadresse=' + idadresse);

  xhr.onreadystatechange = function(){
    if(xhr.status == 200 && xhr.readyState == 4){
      document.getElementById('user_infos').innerHTML = xhr.responseText;
    }
  };

  xhr.send('');
}

function user_modify(idadresse){
  var xhr_modify_user = new XMLHttpRequest();
  const gender = document.getElementById('gender');
  const selectedGender = gender.options[gender.selectedIndex].value;
  const nom = document.getElementById('nom').value;
  const prenom = document.getElementById('prenom').value;
  const dtnaissance = document.getElementById('dtnaissance').value;
  const addrmail = document.getElementById('addrmail').value;
  const num_rue = document.getElementById('users_management_address_num_input').value;
  const adresse = document.getElementById('users_management_address_input').value;
  const ville = document.getElementById('ville').value;
  const notel = document.getElementById('notel').value;
  const okactif = document.getElementById('okactif');
  const selectedOkactif = okactif.options[okactif.selectedIndex].value;
  const cdtype_user = document.modify_form.cdtype_user;
  const selectedCdtype_user = cdtype_user.options[cdtype_user.selectedIndex].value;

  console.log(selectedGender);
  console.log(nom);
  console.log(prenom);
  console.log(dtnaissance);
  console.log(addrmail);
  console.log(num_rue);
  console.log(adresse);
  console.log(notel);
  console.log(selectedOkactif);
  console.log(selectedCdtype_user);

  xhr_modify_user.open('GET','users_management_modify.php?idadresse=' + idadresse + '&gender=' + selectedGender + '&nom=' + nom + '&prenom=' + prenom + '&dtnaissance=' + dtnaissance + '&addrmail=' + addrmail + '&num_rue=' + num_rue + '&adresse=' + adresse + '&ville=' + ville + '&notel=' + notel + '&okactif=' + selectedOkactif + '&cdtype_user=' + selectedCdtype_user);

  xhr_modify_user.onreadystatechange = function(){
    if(xhr_modify_user.status == 200 && xhr_modify_user.readyState == 4){
      search_user(idadresse);
      research_users_by_search_input();
      alert('Modification effectuée !');
    }
  };

  xhr_modify_user.send('');
}

function research_users_by_search_input(){
  const research_input = document.getElementById('research_user_input').value;
  console.log(research_input);
  var research_users = new XMLHttpRequest();

  research_users.open('GET','research_users.php?value=' + research_input + '%');

  research_users.onreadystatechange = function(){
    if(research_users.status == 200 && research_users.readyState == 4){
      document.getElementById('display_users').innerHTML = research_users.responseText;
    }
  };
  research_users.send('');
}
