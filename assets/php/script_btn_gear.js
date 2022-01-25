let btngear = document.getElementById("#btngear");

let co_pseudo = document.getElementById("co_pseudo");

let post_pseudo = document.getElementById("post_pseudo");

let plop2 = 0

function ghost() {
    if (co_pseudo == post_pseudo) {
        // user.iduser == post.iduser

        btngear.style.visibility = "visible"
        plop2++

    }else{

        btngear.style.visibility = "hidden"
        plop2--

    }
}













