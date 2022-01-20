<head>

    <link rel="stylesheet" href="assets/css/home.css">

</head>

<body>

    <main>

        <section id="section1">

            <h1 id="titre">Bonjour</h1>
            <div id="barre"></div>

        </section>

        <form id="form" action="assets/bdd/upload_action.php" method="POST" enctype="multipart/form-data">

            <div>
                Ajouter une image
            </div>
            
            <input id="input_file" type="file" name="file" accept=".jpg, .jpeg, .png, .gif">

            <button type="submit">Enregistrer</button> 

        </form>

            <?php

                require("assets/bdd/bddconfig.php");
                
                try {

                    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);

                    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $recup = $objBdd->query("SELECT * FROM `user`, `post`, `file` WHERE user.iduser = post.iduser AND post.idpost = file.idpost");
                    
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
                        <!-- Générer pseudo -->
                        <h2 id="post_pseudo">@<?php echo stripslashes($messageSimple["pseudo"]); ?></h2>

                    </div>

                    <div>
                        <!-- Générer image -->
                        <img id="post_img" src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" alt="image" >

                    </div>

                    <div id="like_com">

                        <div class="heart"></div>

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
</body>
</html>