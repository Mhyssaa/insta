<head>
    <link rel="stylesheet" href="assets/css/style_profil.css">
    <link rel="stylesheet" href="assets/css/home.css">
    
</head>

<?php 
    $iduser = $_SESSION["logged_in"]["iduser"];
?>


<div class="profil">
    <div class="avatar">
        <span class="iconify" data-icon="carbon:user-avatar-filled"></span>
    </div>
    <div class="info-profil">
        <p>@<?php echo  $_SESSION["logged_in"]["pseudo"]; ?>
            <br>
        <span class="description">description </span> 
        </p>
    </div>
</div>

<div class="info-compte">
    <p>0 Publication</p>
    <p>0 Abonnés</p>
    <p>0 Abonnement</p>
</div>

<a href="assets/php/create_post.php" class="post"> Créer un post</a>


<?php
    require("assets/bdd/bddconfig.php");
    
    try {
        $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
        $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $recup = $objBdd->query("SELECT * FROM `user`, `post`, `file` WHERE user.iduser = post.iduser AND post.idpost = file.idpost AND user.iduser = $iduser");
        
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



<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
<script src="assets/js/script_heart.js"></script>


