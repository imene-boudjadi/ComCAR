<?php

require_once '../Controller/LoginController.php';

session_start();
$LoginController = new LoginController(); //login pour le user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = $LoginController->login($_POST['adresse'],$_POST['password']); //apres connexion il peut acceder au profil
    if ($res!=null){
        header('Content-Type: application/json'); 
        echo json_encode('login reussit');
    }
    else{
        echo json_encode('username/adresse ou mot de pass incorrect.');
    }
}
else{
    $LoginController->afficherUserLoginForm();
}

?>