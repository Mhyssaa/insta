<?php

  
$pseudo = htmlspecialchars($_POST["pseudo"]);
 
$messageLegend =  htmlspecialchars($_POST["legende"]);

 
require("bddconfig.php");


try{

   
    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
   
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $PDOinsert = $objBdd->prepare("INSERT INTO `post` (`pseudo`, `legend`) VALUES (:pseudo , :messageLegend) ");
  
    $PDOinsert->bindParam(':pseudo' , $pseudo , PDO::PARAM_STR);
    
    $PDOinsert->bindParam(':messageLegend' , $messageLegend , PDO::PARAM_STR);
    
    $PDOinsert->execute();

     
    header('Location: ../index.php');

}catch( Exception $prmE){

    
    die("ERREUR : " . $prmE->getMessage());

}