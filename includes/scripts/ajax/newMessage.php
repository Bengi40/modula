<?php
require_once('../../../config.php');
require_once('../../../functions.php');

$data = array(
    "nom" => "", 
    "prenom" => "",
    "email" => "", 
    "message" => "", 
    "rgpd" => true,
    "ip" => "",
    "isValid" => true,
    "nomErr" => "",
    "prenomErr" => "",
    "emailErr" => "",
    "messageErr" => "",
    "recaptchaErr" => ""
);

if(!empty($_POST)) {
    
    $data["nom"] = checkInput($_POST["nom"]);
    $data["prenom"] = checkInput($_POST["prenom"]);
    $data["email"] = checkInput($_POST["email"]);
    $data["message"] = checkInput($_POST["message"]);
    $data["isValid"] = true;
    $data["ip"] = getIp();

    // reCaptcha
    $secret = "6LfBTNUUAAAAALh9MR_XihQYdV0o1ynihKE-dPVj";
	$response = $_POST['g-recaptcha-response'];
    $remoteip = getIp();
    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
		. $secret
		. "&response=" . $response
		. "&remoteip=" . $remoteip;

    $decode = json_decode(file_get_contents($api_url), true);
    
    if (!$decode['success'] == true) {
        $data["isValid"] = false;
        $data["recaptchaErr"] = 'Merci de prouver que vous êtes pas un robot !';
	} 

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

    if($data["isValid"]) {
        $db = Database::connect();
        $statement = $db->prepare('
        INSERT INTO contacts (nom,prenom,email,message,RGPD,datecontact,ip)
        VALUES (?,?,?,?,?,NOW(),?)');

        $statement->execute(array($data["nom"],$data["prenom"],$data["email"],$data["message"],$data["rgpd"],$data["ip"]));
        Database::disconnect();
    } 

    echo json_encode($data);
   
}
?>