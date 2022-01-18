function finFile(iddossier){
  let xhr = new XMLHttpRequest();

  // const folder = document.getElementById(iddossier).id;
  console.log(iddossier);
  // const folder = document.getElementById('dosssier').innerHTML;
  xhr.open('GET', 'homePageDossier_verif.php?folder=' + iddossier);


  // Lorsqu'un réponse est émise par le serveur
  xhr.onreadystatechange = function() {
    if (xhr.status == 200 && xhr.readyState == 4) {
      document.getElementById('info_doss').innerHTML = xhr.responseText;
      console.log(xhr.responseText);
      document.getElementById('iddossier_lb').innerHTML = "Dossier n°" + iddossier;
      if(document.getElementById('verif_type_file').value == 1){
        document.getElementById('close_button').setAttribute("onclick","close_directory(" + iddossier + ")");
        document.getElementById('close_button').innerHTML = 'Clore le dossier';
        // xhr.responseText contient exactement ce que la page PHP renvoi
      }
      else{
        document.getElementById('close_button').setAttribute("onclick","open_directory(" + iddossier + ")");
        document.getElementById('close_button').innerHTML = 'Réouvrir le dossier';
      }
    }
  };
  xhr.send('');
  // console.log('test');
}


function close_directory(iddossier){
  let xhr = new XMLHttpRequest();
  // const folder = document.getElementById(iddossier).id;
  console.log(iddossier);
  // const folder = document.getElementById('dosssier').innerHTML;
  xhr.open('GET', 'close_directory_verif.php?folder=' + iddossier + '&statut=1');


  // Lorsqu'un réponse est émise par le serveur
  xhr.onreadystatechange = function() {
    if (xhr.status == 200 && xhr.readyState == 4) {
      // document.getElementById('info_doss').innerHTML = "dossier clos";
      console.log(xhr.responseText);
      // document.getElementById('close_button').RemoveAttribute('');
      finFile(iddossier);
    }
  }
  xhr.send();
}


function open_directory(iddossier){
  let xhr = new XMLHttpRequest();

  // const folder = document.getElementById(iddossier).id;
  console.log(iddossier);
  // const folder = document.getElementById('dosssier').innerHTML;
  xhr.open('GET', 'close_directory_verif.php?folder=' + iddossier + '&statut=2');

  xhr.onreadystatechange = function() {
    if (xhr.status == 200 && xhr.readyState == 4) {
      console.log(xhr.responseText);
      // document.getElementById('info_doss').innerHTML = "dossier réouvert";
      finFile(iddossier);
    }
  }
  // xhr.send('');
  // console.log('test');
  // xhr.open('POST','homePageDossier_verif.php');
  // xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoding');
  // xhr.send('folder=' + iddossier + '&statut=2'); //BODY
  xhr.send();
}

function research_folder_by_search_input(){
  const research_input = document.getElementById('research_folder_input').value;

  var research = new XMLHttpRequest();

  research.open('GET','research_folder.php?value=' + research_input + '%');

  research.onreadystatechange = function(){
    if(research.status == 200 && research.readyState == 4){
      document.getElementById('display_open_folder').innerHTML = research.responseText;
    }
  };
  research.send('');
}


// function transform(idname){
//   var cible = document.getElementById('close_button');
//       var newtag = document.createElement("p");
//       // newtag.setAttribute('type', 'text');
//       newtag.setAttribute('id', 'close_button')
//       cible.parentNode.replaceChild(newtag,cible);
// }
