<head>

  

</head>

      <!-- bouton accueil -->
      <main id="main">
      <h1>Modifier mon Post</h1>


        <!-- <form method="POST" action="bdd/avis_insert_action.php"> -->
        <form method="POST" action="update_post.php">


            <textarea name="avis" id="avis" placeholder="Ecrivez une legende" cols="30" rows="10"></textarea> <br> <br>

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']) ?>"> <br> <br>

             <input type="submit" value="ENVOYER">


             <input type="submit" value="Supprimer">

        </form>
        </main>
        