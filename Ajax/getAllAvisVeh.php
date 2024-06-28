<?php

require_once('../Controller/AvisController.php');

if(isset($_GET['datavehicule'])){  // tous les avis veh
    $idvehicule = $_GET['datavehicule'];
    $AvisController = new AvisController();
    $AvisController->FindAllAvisVeh($idvehicule);
}elseif(isset($_GET['datamarque'])){ // tous les avis marques
    $idmarque = $_GET['datamarque'];
    $AvisController = new AvisController();
    $AvisController->FindAllAvisMarque($idmarque);
}

?>