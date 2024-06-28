<?php

require_once '../Controller/profilController.php';


session_start();
if (isset($_GET['idUser'])) {
    $iduser = $_GET['idUser'];
    $profilController = new profilController();
    $profilController->AfficherProfilPageFromadmin($iduser);
} else {
    header('Location: ../routers/AdminGestionUser.php');
    exit();
}

?>