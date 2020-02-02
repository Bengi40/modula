<?php
require_once('../../../config.php');
require_once('../../../functions.php');

$data = array(
    "nom" => "", 
    "prenom" => "",
    "email" => "", 
    "message" => "", 
    "rgpd" => true,
    "isValid" => true,
    "nomErr" => "",
    "prenomErr" => "",
    "emailErr" => "",
    "messageErr" => "",
    "rgpdErr" => ""
);

if(!empty($_POST)) {
    
    $data["nom"] = checkInput($_POST["nom"]);
    $data["prenom"] = checkInput($_POST["prenom"]);
    $data["email"] = checkInput($_POST["email"]);
    $data["message"] = checkInput($_POST["message"]);
    $data["isValid"] = true;
  
    $data["rgpd"] = $_POST["rgpd"];
    $ip = '192.168.1.1';

    if(empty($data["nom"])) {
        $data["nomErr"] = 'Le nom est obligatoire';
        $data["isValid"] = false;
    }
    if(empty($data["prenom"])) {
        $data["prenomErr"] = 'Le prénom est obligatoire';
        $data["isValid"] = false;
    }
    if(empty($data["email"])) {
        $data["emailErr"] = 'L\'email est obligatoire';
        $data["isValid"] = false;
    } else if (!isEmail($data["email"])) {
        $data["emailErr"] = 'Ceci n\'est pas un email valide !';
        $data["isValid"] = false;
    }


    if(empty($data["message"])) {
        $data["messageErr"] = 'Le message est obligatoire';
        $data["isValid"] = false;
    }
    if(!$data["rgpd"]) {
        $data["rgdpErr"]  = 'Veuillez valider les conditions';
        $isValid = false;
    }

    if($data["isValid"]) {
        $db = Database::connect();
        $statement = $db->prepare('
        INSERT INTO contacts (nom,prenom,email,message,RGPD,datecontact,ip)
        VALUES (?,?,?,?,?,NOW(),?)');

        $statement->execute(array($data["nom"],$data["prenom"],$data["email"],$data["message"],$rgpd,$ip));
        Database::disconnect();
    } 

    echo json_encode($data);
   
}
?>