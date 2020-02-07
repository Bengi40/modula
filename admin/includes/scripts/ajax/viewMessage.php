<?php
require_once('../../../../config.php');
require_once('../../../../functions.php');

$data = array(
    "id" => "",
    "nom" => "", 
    "prenom" => "",
    "email" => "", 
    "message" => "", 
    "date" => "",
    "heure" => ""
);

if(!empty($_POST)) {
    
    $data['id'] = $_POST['id'];    

    if($data['id'] != 0 ) {
        $db = Database::connect();
        $statement = $db->prepare('
        select id,nom,prenom,email,message,date,heure 
        FROM contacts
        WHERE id = ?;');

        $statement->execute(array($data['id']));
        Database::disconnect();
        while ($info = $statement->fetchObject()) {
            $data['nom'] = $info->nom;
            $data['prenom'] = $info->prenom;
            $data['email'] = $info->email;
            $data['message'] = $info->message;
            $data['date'] = dateFr($info->date);
            $data['heure'] = $info->heure;
        }
    } 
    echo json_encode($data); 
}
?>