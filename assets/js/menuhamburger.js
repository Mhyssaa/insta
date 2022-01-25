const liensnav = document.getElementById("liensnav");
const btnnavbar = document.getElementById("btnnavbar");

btnnavbar.addEventListener("click", affichageNav);

let links = document.querySelectorAll(".linky");

links.forEach(linky => {
    linky.addEventListener("click", affichageNav);
});

function affichageNav() {
    console.log(liensnav);

}