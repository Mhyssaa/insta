<?php
session_start();

  
$pseudo = htmlspecialchars($_SESSION["logged_in"]["pseudo"]);
$iduser = htmlspecialchars($_SESSION["logged_in"]["iduser"]);
 
$messageLegend =  htmlspecialchars($_POST["legende"]);
// rajouté pour test
$tmpName = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$error = $_FILES['file']['error'];
//  fin rajout test
require("bddconfig.php");


try{

   
    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
   
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $PDOinsert = $objBdd->prepare("INSERT INTO `post` (`pseudo`, `legende`,`iduser`) VALUES (:pseudo , :messageLegend, :iduser)" );
  
    $PDOinsert->bindParam(':pseudo' , $pseudo , PDO::PARAM_STR);
    $PDOinsert->bindParam(':messageLegend' , $messageLegend , PDO::PARAM_STR);
    $PDOinsert->bindParam(':iduser' , $iduser , PDO::PARAM_STR);
    
    $PDOinsert->execute();

    $idpost = $objBdd->lastInsertId();
     
    if(isset($_FILES['file'])){

        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
        $maxSize = 4000000;

        
        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
    
            $uniqueName = uniqid('', true);
            $file = $uniqueName.".".$extension;
            
            move_uploaded_file($tmpName, '../upload/'.$file);

              $PDOinsertFile = $objBdd->prepare("INSERT INTO `file` (`image`, `idpost`,`idcompte`) VALUES (:file , :idpost, :iduser)" );
              $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
   
              $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $PDOinsertFile->bindParam(':file' , $file , PDO::PARAM_STR);
              $PDOinsertFile->bindParam(':idpost' , $idpost , PDO::PARAM_STR);
              $PDOinsertFile->bindParam(':iduser' , $iduser , PDO::PARAM_STR);
    
            $PDOinsertFile->execute();
           
            
            header("Location: ../index.php");

        

        }
    }

       
    header('Location: ../index.php');

}catch( Exception $prmE){

    die("ERREUR : " . $prmE->getMessage());

}