<head>
    <link rel="stylesheet" href="assets/css/style_profil.css">
    <link rel="stylesheet" href="assets/css/home.css">

</head>

<!-- PROFIL -->

<?php

$stock = 0;

require("assets/bdd/bddconfig.php");

try {
    $iduser = $verif_co;

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $recup = $objBdd->prepare("SELECT * FROM `user` WHERE user.iduser = :iduser");
    $recup->bindParam(':iduser', $iduser, PDO::PARAM_STR);
    $recup->execute();


} catch (Exception $prmE) {
    die("ERREUR : " . $prmE->getMessage());
}

// PUBLICATION

try {
    $publication = $verif_co;

    $objBdd2 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    $objBdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup2 = $objBdd2->prepare("SELECT * FROM `post` WHERE iduser = :publication ");
    $recup2->bindParam(':publication', $publication, PDO::PARAM_STR);
    $recup2->execute();
    $verif2 = $recup2->fetch();
} catch (Exception $prmE) {
    die("ERREUR : " . $prmE->getMessage());
}

// ABONNE


try {
    $abonne = $verif_co;

    $objBdd3 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    $objBdd3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $recup3 = $objBdd2->prepare("SELECT * FROM `abonnement` WHERE idsuivie = :abonne ");
    $recup3->bindParam(':abonne', $abonne, PDO::PARAM_STR);
    $recup3->execute();
    $verif3 = $recup3->fetch();
} catch (Exception $prmE) {
    die("ERREUR : " . $prmE->getMessage());
}
// ABONNEMENT


try {
    $abonnement = $verif_co;

    $objBdd4 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    $objBdd4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup4 = $objBdd2->prepare("SELECT * FROM `abonnement` WHERE idsuivie = :abonnement");
    $recup4->bindParam(':abonnement', $abonnement, PDO::PARAM_STR);
    $recup4->execute();

    $verif4 = $recup4->fetch();

} catch (Exception $prmE) {

    die("ERREUR : " . $prmE->getMessage());
}

// POST

try {
    $objBdd5 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
    $objBdd5->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $recup5 = $objBdd5->query("SELECT * FROM `user`, `post`, `file` WHERE user.iduser = post.iduser AND post.idpost = file.idpost AND user.iduser = $iduser");
    
} catch (Exception $prmE) {
    die("ERREUR : " . $prmE->getMessage());
}


?>

<?php while ($message = $recup->fetch()) { ?>
    <div class="profil">
        <div class="avatar">
            <span class="iconify" data-icon="carbon:user-avatar-filled"></span>
        </div>
        <div class="info-profil">
            
            <p>@<?php echo  $message["pseudo"]; ?></p>

            <div class="abonnés">
                <?php if($iduser == $verif_co) { ?>

                    <a href="assets/php/follow_action.php?followedid=<?php echo $iduser ?>&" class="subscribe-button">Modifier Profil</a>

                <?php } else { ?>

                    <a href="assets/php/follow_action.php?followedid=<?php echo $iduser ?>&" class="subscribe-button">S'abonner</a>

                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<div class="info-compte">


    <!-- PUBLICATION -->
    <?php
    if ($verif2 == "") {
        $publication = 0;
    ?>
        <p><?php echo $publication ?> Publication</p>
    <?php
    } else {
        $publication = $recup2->rowCount();

    ?>
        <p><?php echo $publication ?> Publication</p>

    <?php
    }
    ?>

    <!-- ABONNE -->

    <?php
    if ($verif3 == "") {
        $abonne = 0;
    ?>
        <p><?php echo $abonne ?> Abonné</p>

    <?php
    } else {
        $abonne = $recup3->rowCount();
    ?>
        <p><?php echo $abonne ?> Abonné</p>
    <?php
    }
    ?>

    <!-- ABONNEMENT -->

    <?php
    if ($verif4 == "") {
        $abonnement = 0;

    ?>
        <p><?php echo $abonnement ?> Abonnement</p>

    <?php
    } else {
        $abonnement = $recup4->rowCount();

    ?>
        <p><?php echo $abonnement ?> Abonnement</p>

    <?php
    }
    ?>
</div>

<a href="assets/php/create_post.php" class="post"> Créer un post</a>

<section id="section2">
    <?php
    while ($test = $recup5->fetch()) {
    ?>

    <div class="content_post">
        <div>
            <!-- Générer image -->
            <img id="post_img" src="assets/upload/<?php echo stripslashes($test['image']); ?>" alt="image">

        </div>
        <div id="like_com">
            
            <form id="myform" method="POST" action="assets/php/like_action.php">
                
                <input name="idpost" type="hidden" value="<?php echo $test["idpost"] ?>">
                
                <?php
                
                //LIKE
                
                try {
                    $idpostlike = $test["idpost"];

                    // echo $idpostlike;
                    
                    $objBdd6 = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);
                    $objBdd6->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $recup6 = $objBdd6->query("SELECT * FROM `likes` WHERE idpost = $idpostlike AND iduser = $verif_co LIMIT 1");
                    // var_dump($recup6->fetch());
                    if($recup6->fetch() == false){
                        // var_dump($recup6->fetch());
                        $recup6 = $objBdd6->query("SELECT * FROM `likes` WHERE idpost = $idpostlike");
                    }

                    // var_dump($recup6->fetch());
                    
                    $recup6->execute();
                    
                } catch (Exception $prmE) {
                    die("ERREUR : " . $prmE->getMessage());
                }
                
                // var_dump($recup6->fetch());

                while ($likes = $recup6->fetch()) {

                    echo $likes['iduser'];

                    if( $likes['iduser'] == $verif_co){
                
                        echo '<div class="like"></div>';

                    }else{

                        echo '<div class="heart"></div>';

                    }
                    ?>



                <?php    
                }
                ?>

                
            </form>
            
            <div><span class="iconify" data-icon="bi:chat" style="color: #2b2238;" data-width="30"></span></div>

            
        </div>
    </div>
<?php
}
?>
</section>



<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
<script src="assets/js/script_heart.js"></script>