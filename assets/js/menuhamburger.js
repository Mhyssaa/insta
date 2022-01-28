const liensnav = document.getElementById(".liensnav");
const btnnavbar = document.getElementById(".btnnavbar");

btnnavbar.addEventListener("click", affichageNav);

let links = document.querySelectorAll(".linky");

links.forEach(linky => {
    linky.addEventListener("click", affichageNav);
});

function affichageNav() {
    console.log(liensnav);

}

/*jQuery(function($){

    $( '.btnnavbar' ).click(function(){
        $('.liensnav').toggleClass('expand');
    });

    $(document).on("click", function(e){
        if(
            $(e.target).closest(".liensnav").length == 0 &&
            $(".liensnav").hasClass("expand") &&
            $(e.target).closest(".btnnavbar").length == 0
        ){
            $('.liensnav').toggleClass('expand');
        }
    });
});*/