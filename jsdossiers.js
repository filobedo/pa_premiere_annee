


function research(iddossier){
  var xhr = new XMLHttpRequest();

  // const folder = document.getElementById(iddossier).id;
  console.log(iddossier);
  // const folder = document.getElementById('dosssier').innerHTML;
  xhr.open('GET', 'liste_dossiers_verif.php?folder=' + iddossier);


  // Lorsqu'un réponse est émise par le serveur
  xhr.onreadystatechange = function() {
      if (xhr.status == 200 && xhr.readyState == 4) {
          document.getElementById('section1').innerHTML = xhr.responseText;
          console.log(xhr.responseText);
          // xhr.responseText contient exactement ce que la page PHP renvoi
      }
  };
  xhr.send('');
  // console.log('test');
}


//supprimer un fichier
function delete_file(nmfic){
  var delete_file_xhr = new XMLHttpRequest();

  // const folder = document.getElementById(iddossier).id;
  console.log(nmfic);
  // const folder = document.getElementById('dosssier').innerHTML;
  delete_file_xhr.open('GET', 'file_delete.php?file=' + nmfic);


  // Lorsqu'un réponse est émise par le serveur
  delete_file_xhr.onreadystatechange = function() {
    const children = document.getElementById(nmfic);
    const button_children = document.getElementById(nmfic + "_button");
    const parent = children.parentNode;

      if (delete_file_xhr.status == 200 && delete_file_xhr.readyState == 4) {
          // parent.innerHTML = delete_file_xhr.responseText;
          parent.removeChild(children);
          parent.removeChild(button_children);
          alert('fichier supprimé');

      }
  };
  delete_file_xhr.send('');
  // console.log('test');
}


// function envoi_file(){
//   var xhr_file = new XMLHttpRequest();
//
//
//   console.log(iddossier);
//
//   xhr_file.open('GET', 'liste_dossiers_verif.php?folder=' + iddossier);
//
//
//   // Lorsqu'un réponse est émise par le serveur
//   xhr_file.onreadystatechange = function() {
//       if (xhr_file.status == 200 && xhr_file.readyState == 4) {
//           document.getElementById('section1').innerHTML = xhr_file.responseText;
//           console.log(xhr_file.responseText);
//           // xhr.responseText contient exactement ce que la page PHP renvoi
//       }
//   };
//   xhr_file.send('');
//   // console.log('test');
//
// }


// Methode jquery envoi de fichier
// $("form#files").submit(function(){
//
//     var formData = new FormData($(this)[0]);
//
//     $.ajax({
//         url: window.location.pathname,
//         type: 'POST',
//         data: formData,
//         async: false,
//         success: function (data) {
//             alert(data)
//         },
//         cache: false,
//         contentType: false,
//         processData: false
//     });
//
//     return false;
// });
//
// <form id="files" method="post" enctype="multipart/form-data">
//     <input name="image" type="file" />
//     <button>Submit</button>
// </form>
