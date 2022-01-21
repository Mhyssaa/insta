<head>
    <link rel="stylesheet" href="assets/css/style_profil.css">
</head>


<div class="profil">
    <div class="avatar">
        <span class="iconify" data-icon="carbon:user-avatar-filled"></span>
    </div>
    <div class="info-profil">
        <p>@Pseudo 
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

<p class="post">Créer un post</p>


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
<section class="center">
    <?php
    while ($messageSimple = $recup->fetch()) {
    ?>
        <div>
            <div class="card">
                <img src="assets/upload/<?php echo stripslashes($messageSimple['image']); ?>" class="image_post" alt="image" >
            </div>
            <div>
                <span class="iconify" data-icon="dashicons:heart" style="color: #c276b7;" data-width="50"></span>
                <span class="iconify" data-icon="bi:chat" style="color: #2b2238;" data-width="50"></span>
            </div>
        </div>
        <?php
    }
    ?>
</section>


<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>