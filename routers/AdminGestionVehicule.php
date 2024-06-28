<?php

include('../Controller/AdminVehiculeController.php');
require_once('../Controller/LoginAdminController.php');



session_start();
if($_SESSION['adresseAdmin']!=[]){
$AdminVehiculeController = new AdminVehiculeController();


if (isset($_GET['submit'])) {
    if ($_GET['submit'] == "Modifier vehicule") {
        $AdminVehiculeController->EditVehiculeForm($_GET['id_vehicule']);
    } 
    elseif ($_GET['submit'] == "Supprimer vehicule"){
        $AdminVehiculeController->DeleteVehicule($_GET['id_vehicule']);
    }
    elseif ($_GET['submit'] == "Modifier_marque"){
        $AdminVehiculeController->EditMarqueForm($_GET['id_marque']);
    }
    elseif ($_GET['submit'] == "Supprimer_marque"){
        $AdminVehiculeController->DeleteMarque($_GET['id_marque']);
    }
}else {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['edit'])){
            if (isset($_FILES["image"]) && $_FILES["image"]["size"] > 0) { // ie if j'ai entre une nouvelle image (je veux modifier l image)
                $nomfile = $_FILES["image"]["name"];
                $pathmonprojet = dirname(__FILE__) . "/Images/"; 
                if (!is_dir($pathmonprojet)) { // creer le dossier Images f not exist     
                    mkdir($pathmonprojet, 0755, true); // Crée le répertoire avec les permissions appropriées
                }
                $path = $pathmonprojet . $nomfile;
                move_uploaded_file($_FILES["image"]["tmp_name"], $path);
                $pathimage = "../Images/" . $nomfile;   
            } else {
                $pathimage = null; // si no image 
                $id_vehicule = $_POST['id_vehicule'];
                $vehicule = $AdminVehiculeController->GetVehiculeById($id_vehicule);
                $pathimage = $vehicule['ImageVehicule']; 
            }
            $AdminVehiculeController->EditVehicule($_POST['id_vehicule'],$_POST['modele'],$_POST['version'],$_POST['annee'],$_POST['moteur'],$_POST['performance'],$_POST['dimensions'],$_POST['puissance'],$_POST['capacite'],$_POST['consommation'],$_POST['tarif'],$_POST['marque'],$pathimage);
        }elseif (isset($_POST['add'])){  // action : post , button name : add
            if (isset($_FILES["image"])) {   
                $nomfile = $_FILES["image"]["name"];
                $pathmonprojet = dirname(__FILE__) . "/Images/"; 
                if (!is_dir($pathmonprojet)) { // creer le dossier Images f not exist     
                    mkdir($pathmonprojet, 0755, true); // Crée le répertoire avec les permissions appropriées
                }
                $path = $pathmonprojet . $nomfile;
                move_uploaded_file($_FILES["image"]["tmp_name"], $path);
                $pathimage = "../Images/" . $nomfile;           
            } else {
                $pathimage = null; // si no image 
            }
            $AdminVehiculeController->AddVehicule($_POST['modele'],$pathimage,$_POST['version'],$_POST['annee'],$_POST['moteur'],$_POST['performance'],$_POST['dimensions'],$_POST['puissance'],$_POST['capacite'],$_POST['consommation'],$_POST['tarif'],$_POST['marque']);
        }elseif (isset($_POST['addMarque'])){
            if (isset($_FILES["image"])) {
                $nomfile = $_FILES["image"]["name"];
                $pathmonprojet = dirname(__FILE__) . "/Images/"; 
                if (!is_dir($pathmonprojet)) { // creer le dossier Images f not exist     
                    mkdir($pathmonprojet, 0755, true); // Crée le répertoire avec les permissions appropriées
                }
                $path = $pathmonprojet . $nomfile;
                move_uploaded_file($_FILES["image"]["tmp_name"], $path);
                $pathimage = "../Images/" . $nomfile;           
            } else {
                $pathimage = null; // si no image 
            }
            $AdminVehiculeController->AddMarque($_POST['nom'],$_POST['pays'],$_POST['siege'],$_POST['annee'],$pathimage);
        }elseif (isset($_POST['editMarq'])){
            if (isset($_FILES["image"]) && $_FILES["image"]["size"] > 0) { // ie if j'ai entre une nouvelle image (je veux modifier le logo)
                $nomfile = $_FILES["image"]["name"];
                $pathmonprojet = dirname(__FILE__) . "/Images/"; 
                if (!is_dir($pathmonprojet)) { // creer le dossier Images f not exist     
                    mkdir($pathmonprojet, 0755, true); // Crée le répertoire avec les permissions appropriées
                }
                $path = $pathmonprojet . $nomfile;
                move_uploaded_file($_FILES["image"]["tmp_name"], $path);
                $pathimage = "../Images/" . $nomfile;           
            } else {
                // $pathimage = null; // si no image 
                $id_marque = $_POST['id_marque'];
                $marque = $AdminVehiculeController->GetMarqueById($id_marque);
                $pathimage = $marque['ImageLogo'];
            }
            $AdminVehiculeController->EditMarque($_POST['id_marque'],$_POST['nom'],$_POST['pays'],$_POST['siege'],$_POST['annee'],$pathimage);
        }
    }
    else{  
        if (isset($_GET['add_vehicule'])){
            $AdminVehiculeController->AddVehiculeForm();
        }elseif (isset($_GET['add_marque'])){
            $AdminVehiculeController->AddMarqueForm();
        }elseif (isset($_GET['afficheMarques'])){
            $AdminVehiculeController->AfficherTabMarques();
        }else{
            // Afficher la table des vehicules avec leurs informations
            $AdminVehiculeController->AfficherTableVehicules();
        }
    }  
}
}else{
    $Admincontroller = new LoginAdminController();    
    $Admincontroller->afficherLoginForm();
}

  


?>