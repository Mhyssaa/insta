let hearts = document.querySelectorAll(".heart");
let plop = 0;


hearts.forEach(element => {
    
    element.addEventListener("click", function(){
        
        document.forms["myform"].submit();
        
        element.addEventListener("click", setInterval(liker, 10000))
        
    })
    
});

function liker() {
    
    if (plop == 0){
        
        this.style =
        `
        animation: favori 1s steps(28);
        background-position: -2800px 0;
        ` 
        plop++
        
    }else{
        
        this.style =
        `
        background-position: 0 0;
        ` 
        plop--
        
    }
}