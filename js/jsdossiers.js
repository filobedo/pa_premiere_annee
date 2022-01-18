


function research(){
  var xhr = new XMLHttpRequest();

  // const nmuser = split(document.getElementById('dosssier').innerHTML,':');
  // console.log(nmuser[0]);
  const nmuser = document.getElementById('dosssier').innerHTML;
  console.log(nmuser);
  xhr.open('GET', 'liste_dossiers_verif.php?nmuser=' + nmuser[0]);


  // Lorsqu'un réponse est émise par le serveur
  xhr.onreadystatechange = function() {
      if (xhr.status == 200 && xhr.readyState == 4) {
          document.getElementById('section1').innerHTML = xhr.responseText;

          // xhr.responseText contient exactement ce que la page PHP renvoi
      }
  };
  xhr.send('');
  // console.log('test');
}
