<?php
require_once('../../../config.php');
require_once('../../../functions.php');

$nom = $prenom = $email = $message = $rgpd = "";

if(!empty($_POST)) {
    $isValid = true;
    $nom = checkInput($_POST["nom"]);
    $prenom = checkInput($_POST["prenom"]);
    $email = checkInput($_POST["email"]);
    $message = checkInput($_POST["message"]);
  
    $rgpd = true;
    $ip = '192.168.1.1';

    if(empty($nom)) {
        echo('Le nom est obligatoire');
        $isValid = false;
    }
    if(empty($prenom)) {
        print('Le prénom est obligatoire');
        $isValid = false;
    }
    if(empty($email)) {
        print('L\'email est obligatoire');
        $isValid = false;
    }
    if(empty($message)) {
        print('Le message est obligatoire');
        $isValid = false;
    }
    if(!$rgpd) {
        print('Veuillez valider les conditions');
        $isValid = false;
    }

    if($isValid) {
        $db = Database::connect();
        $statement = $db->prepare('
        INSERT INTO contacts (nom,prenom,email,message,RGPD,datecontact,ip)
        VALUES (?,?,?,?,?,NOW(),?)');

        $statement->execute(array($nom,$prenom,$email,$message,$rgpd,$ip));
        Database::disconnect();
    } else {
        print('marchepas');
    }
   
}
?>