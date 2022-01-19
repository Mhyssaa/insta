<?php

if( $verif_co != 0){
    
  header("Location: index.php");
    
}

?>

<head>

<link rel="stylesheet" href="assets/css/update_post_form.css">

</head>

     
      <main id="main">
      <h1>Modifier mon Post</h1>

        <form method="POST" action="update_post.php">


            <textarea name="legende" id="legende" placeholder="Écrivez une légende" onKeyUp="textCounter()"></textarea> <br> <br>
            <!-- <p><span id="counter">0</span> / 200</p> -->
            <input type="submit" value="Envoyer" class="envoyer">


            

        </form>
         <input type="submit" value="Supprimer" class="supprimer">
        </main>

        <script src="assets/js/text-counter.js"></script>