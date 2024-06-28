<?php

require_once '../Controller/LoginController.php';



//inscription user 

session_start();
$LoginController = new LoginController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $adresse = $_POST['adresse'];
    $sexe = $_POST['sexe'];
    $dateNaiss = $_POST['datNaiss'];
    $password = $_POST['password'];
    // le cas ou il ya la photo
    if (isset($_FILES["photo"]) && $_FILES["photo"]["size"] > 0) {
        $nomfile = $_FILES["photo"]["name"];
        $pathmonprojet = dirname(__FILE__) . "/Images/";
        if (!is_dir($pathmonprojet)) { 
            mkdir($pathmonprojet, 0755, true);
        }
        $path = $pathmonprojet . $nomfile;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
        $pathimage = "../Images/" . $nomfile;
    } else {
        $pathimage = null;
    }
    
    header('Content-Type: application/json');
    //check date de naissance  -- au moins 18ans
    $dateNaisances = new DateTime($dateNaiss);
    $DateAct = new DateTime();
    $age = $DateAct->diff($dateNaisances)->y; //y for year 

    if ($age < 18) {
        echo json_encode('Date de naissance incorrecte.');
        exit; //fin
    }
    
        //
    // Vérifier si le user existe déjà
    $user = $LoginController->FindExisteUser($adresse,$username,$password);
    if ($user) { //user exuste deja 
        echo json_encode('utilisateur existe deja');
    } else {
        // vérifier si adresse ou username existe deja
        $userr = $LoginController->FindAdresseUsername($adresse,$username);
        if ($userr){
            echo json_encode('username ou adresse existe déjà');
        }
        else{ // inscription 
            $LoginController->Inscription($nom, $prenom, $username, $adresse, $sexe, $dateNaiss, $password, $pathimage);
            echo json_encode('Inscription reussite, veuillez attendre que l administrateur valide votre inscription pour acceder a votre compte.');
        }
    }
} else {
    $LoginController->afficherUserSignupForm();
}

?>