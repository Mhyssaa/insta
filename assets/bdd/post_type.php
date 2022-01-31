<?php

// $iduser = htmlspecialchars ($_GET["id"]);



// require("bddconfig.php");


// try{

// if(isset($_POST['insert'])) {
                
//                 $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);    

//                 $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//                 $type = $_POST['type'];
                
//                  $recup = $objBdd->query("UPDATE INTO `user` (`type`) VALUES (`$type`) WHERE `iduser` = $iduser");
                      
   
//     header('Location: ../../index.php');
// }

// }catch( Exception $prme){

//   die("ERREUR : " . $prme->getMessage());
// }

?>



<!-- ***************************************************test******************************************************************************************************* -->

<?php



require("bddconfig.php");

if(isset($_POST['insert'])) {
   $id = htmlspecialchars($_GET["id"]);
   echo $id;
   $types = htmlspecialchars( $_POST['type']);
 try{

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
 
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->prepare("UPDATE `user` SET `type` = :types WHERE `iduser` = $id ");
    
    $recup->bindParam(':types' , $types , PDO::PARAM_STR);

    // $recup->bindParam(':iduser' , $iduser , PDO::PARAM_STR);
   
    $recup->execute();

    header('Location: ../../index.php?page=gestion_utilisateur');
   
 }catch( Exception $prmE){

    
    die("ERREUR : " . $prmE->getMessage());

 }
}







