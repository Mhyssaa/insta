

<?php 

// recup des saisies POST de l'utilisateur
$nom = htmlspecialchars($_POST["nom"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$pseudo = htmlspecialchars($_POST["pseudo"]);
$email = htmlspecialchars(strtolower($_POST["email"]));
$mdp=  htmlspecialchars(strval($_POST["mdp"]));
$confirm_password = htmlspecialchars(strval($_POST["mdp2"]));


$avatar = "avatar.png";

// on regarde si les variables ne sont pas vide
if( $nom != "" && $prenom != "" && $email != ""  && $mdp != ""  && $pseudo != "" && $confirm_password != "")  {

    // on regarde si la saisie des mots de passe sont identiques
    if( $mdp == $confirm_password){

        // on bcrypt le mot de passe de l'utilisateur 
        $hash_password = password_hash( $mdp, PASSWORD_BCRYPT);

        require("../bdd/bddconfig.php");

        try {

            // Connecte a la base mysql
            $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
            // En cas de problème renvoie dans le catch avec l'erreur
            $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // ici on prepare notre requête SQL
            $PDOinsertuserweb = $objBdd->prepare("INSERT INTO  `user` (nom, prenom, email, mdp, pseudo) VALUES (:nom, :prenom, :email, :mdp, :pseudo)");
            // on initialise notre :nom avec la variable qui récup le nom
            $PDOinsertuserweb->bindParam(':nom', $nom, PDO::PARAM_STR);
            // on initialise notre :prenom avec la variable qui récup le prenom
            $PDOinsertuserweb->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            // on initialise notre :email avec la variable qui récup le email
            $PDOinsertuserweb->bindParam(':email', $email, PDO::PARAM_STR);
            
            $PDOinsertuserweb->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);

            // on initialise notre :password avec la variable qui récup le password
            $PDOinsertuserweb->bindParam(':mdp', $hash_password, PDO::PARAM_STR);
            // on execute la requête
            $PDOinsertuserweb->execute();

            // renvoie l'id du dernier utilisateur crée
            $lastId = $objBdd->lastInsertId();
            






            header("Location: ../../index.php");
    
        } catch (Exception $prmE) {
            die('Erreur : ' . $prmE->getMessage());
        }

    }

}else{
    header("Location: ../inscription.php");
}
