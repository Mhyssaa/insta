
// let textarea = document.getElementById("legende");
// textarea.addEventListener('keyup',textCounter);

// function textCounter() {
//   console.log(textarea.value);
// }




    // document.getElementById('legende').addEventListener('keyup', function() {
    //     document.getElementById('compteur').innerHTML = legende.value.length;
    // });




    let nbMax=200; 
function longueur() {
   txt=document.formulaire.legende.value;
  if (txt.length>nbMax) {
    document.formulaire.legende.value=txt.substring (0,nbMax);
    txt=document.formulaire.legende.value;
  }
  document.formulaire.value=nbMax-txt.length;
  setTimeout("longueur()", 10);
}