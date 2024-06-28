<?php

require_once '../Controller/AccueilController.php';

session_start();
if(isset($_POST['logout'])){
    session_destroy();
    $accueilController = new AccueilController();
    $accueilController->AfficherPageAccueil();
}
else{
        $accueilController = new AccueilController();
        $accueilController->AfficherPageAccueil(); 
}

?>
