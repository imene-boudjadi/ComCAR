<?php

require_once '../Controller/profilController.php';
require_once '../Controller/LoginController.php';

session_start();
if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){ // sesssion existe -- il est connecter le user 
          
    $profilController = new profilController();
    $profilController->AfficherProfilPage();
}
else{
    $LoginController = new LoginController();
    $LoginController->afficherUserLoginForm();
}