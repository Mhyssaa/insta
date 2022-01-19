<?php

$id = htmlspecialchars($_POST["idpost"]);
echo $id;

$pseudo = htmlspecialchars(addslashes($_POST["pseudo"]));
$messageLegend = htmlspecialchars(addslashes($_POST["legende"]));

require("bdd/bddconfig.php");

try{

    $objBdd = new PDO("mysql:host=$bddserver;dbname=$bddname;charset=utf8", $bddlogin, $bddpass);  
 
    $objBdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recup = $objBdd->prepare("UPDATE `post` SET `pseudo` = :pseudo , `legende` = :messageLegende WHERE `idpost` = $id ");
    
    $recup->bindParam(':pseudo' , $pseudo , PDO::PARAM_STR);
    
    $recup->bindParam(':messageLegend' , $messageLegend , PDO::PARAM_STR);
   
    $recup->execute();
    
    header('Location: index.php');

}catch( Exception $prmE){

    die("ERREUR : " . $prmE->getMessage());

}