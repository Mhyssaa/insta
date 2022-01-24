<head>

    <link rel="stylesheet" href="assets/css/home.css">

</head>

<body>

    <main>

        <section id="section1">

            <h1 id="titre">Bonjour</h1>
            <div id="barre"></div>

        </section>

            <?php

                require("assets/bdd/bddconfig.php");
                
                try {

                    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

                    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $recup = $objBdd->query("SELECT * FROM `user`, `post`, `file` WHERE user.iduser = post.iduser AND post.idpost = file.idpost ORDER BY DATE DESC ");

                } catch (Exception $prmE) {

                    die("ERREUR : " . $prmE->getMessage());
                }

            ?>
            
        <section id="section2">

            <?php

            while ($messageSimple = $recup->fetch()) {

            ?>

                <div class="content_post">
                    
                    <div>
                        
                        <!-- Générer pseudo + Lien de la popup pour qu'elle apparaisse -->
                        <div id="histoire" data-modal="<?php echo $messageSimple["idpost"] ?>" class="btn"><h2 id="post_pseudo">@<?php echo stripslashes($messageSimple["pseudo"]); ?></h2></div>

                    </div>

                        <!-- Page popup -->
                        <div id="<?php echo $messageSimple["idpost"] ?>" class="popup">

                            <!-- Générer l'image -->
                            <section id="section1p"><img id="popup_img" src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" alt="image" ></section>

                            <section id="section2p">

                                <div id="pseudo_btnferme">

                                    <!-- Générer pseudo -->
                                    <div class="marge"><h2 id="post_pseudo">@<?php echo stripslashes($messageSimple["pseudo"]); ?></h2></div>

                                    <!-- Croix pour fermer popup -->
                                    <div class="btnferme">
                                        <span class="iconify " data-icon="ep:circle-close-filled" style="color: #c276b7;" data-width="30"></span>
                                    </div>

                                </div>

                                <!-- Générer la légende -->
                                <div class="marge" id="legende"><p><?php echo stripslashes($messageSimple["legende"]); ?></p></div>

                                <div id="barre_rose2"></div>

                                <div class="marge" id="like_com">

                                    <!-- Animation coeur pour liker -->
                                    <div class="heart heart2"></div>

                                </div>

                                <!-- COMMENTAIRES -->
                                <!-- Ajouter un commentaire -->
                                <?php

                                    require("assets/bdd/bddconfig.php");

                                    try {

                                        $idpost = $messageSimple["idpost"];

                                        $objBdd2 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
                                        $objBdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $recup2 = $objBdd2->prepare("SELECT * FROM  `post`, `commentaire` WHERE post.idpost = commentaire.idpost AND post.idpost = :idpost  ORDER BY commentaire.idcommentaire DESC ");
                                        $recup2->bindParam(':idpost' , $idpost , PDO::PARAM_STR);
                                        $recup2->execute();


                                        
                                    } catch (Exception $prmE) {

                                        die("ERREUR : " . $prmE->getMessage());
                                    }

                                ?>


                                <!-- Affichage des commentaires ici -->
                                <div class="marge">Liste des commentaires

                                <?php
                                
                                while ($plop = $recup2->fetch()) {
                                ?>

                                    
                                        <div class="pseudo_utilisateur">
                                                    
                                            <div><?php echo stripslashes($plop["pseudo"]); ?></div>

                                        </div>

                                        <div class="commentaire_utilisateur">
                                                
                                            <p><?php echo stripslashes($plop["commentaire"]); ?></p>
                                                    
                                        </div>
                                <?php
                                }
                                ?>

                                </div>

                                <form method="POST" action="assets/bdd/commentaire_action.php"> 

                                    <textarea maxlength="255" name="commentaire" class="marge textarea" id="arena" placeholder="Ajouter un commentaire" cols="100" rows="10" autofocus="" required=""></textarea>    
                                        
                                    <input type="hidden" name="pseudo" value="<?php echo $_SESSION["logged_in"]["pseudo"]?>">
                                    <input type="hidden" name="idpost" value="<?php echo $messageSimple["idpost"]?>">
                                    <input type="hidden" name="iduser" value="<?php echo $_SESSION["logged_in"]["iduser"]?>">

                                    <input type="submit" value="Soumettre" id="envoyer">

                                </form>

                            </section>

                        </div>


                    <!-- PAGE HOME               -->

                    <div>
                        <!-- Générer image -->
                        <img id="post_img" src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" alt="image" >

                    </div>

                    <div id="like_com">

                        <!-- Animation coeur pour liker -->
                        <div class="heart"></div>

                        <!-- Ajouter un commentaire -->
                        <div><span class="iconify" data-icon="bi:chat" style="color: #2b2238;" data-width="30"></span></div>

                    </div>

                </div>

            <?php
            }
            ?>

        </section>

    </main>
    
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
    <script src="assets/js/script_heart.js"></script>
    <script src="assets/js/script_popup.js"></script>
</body>
</html>