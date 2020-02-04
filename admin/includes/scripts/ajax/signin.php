<?php
session_start();
require_once('../../../../config.php');
require_once('../../../../functions.php');

$data = array(
    "id" => "",
    "login" => "", 
    "mdp" => "",
    "isValid" => true,
    "loginErr" => "",
    "mdpErr" => "",
    "signInErr" => false
);

if(!empty($_POST)) {
    
    $data['login'] = checkInput($_POST['login']);  
    $data['mdp'] = checkInput($_POST['mdp']);     

    if(empty($data["login"])) {
        $data["loginErr"] = 'Le login est obligatoire';
        $data["isValid"] = false;
    }
    if(empty($data["mdp"])) {
        $data["mdpErr"] = 'Le mot de passe est obligatoire';
        $data["isValid"] = false;
    }

    if($data['isValid']) {
        $db = Database::connect();
        $statement = $db->prepare('
        SELECT login,mdp
        FROM login
        WHERE login = ?;');

        $statement->execute(array($data['login']));
        Database::disconnect();
        while ($verif = $statement->fetchObject()) {
            $login = $verif->login;
            $mdp = $verif->mdp;
        }
        if (($data['login'] != $login) || ($data['mdp'] != $mdp)) {
            $data['isValid'] = false;
            $data['signInErr'] = true;
        } else {
            $_SESSION['role'] = 'admin';
        }
    } 
    echo json_encode($data); 
}
?>