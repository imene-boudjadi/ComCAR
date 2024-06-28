<?php

require_once '../Controller/MarquesController.php';
require_once '../Controller/AvisController.php';


session_start();
if(isset($_GET['id_vehicule'])){ // details vehicule
    $id_vehicule = $_GET['id_vehicule'];
    $AvisController = new AvisController();
    $Npage = 1; //pour le premier clique (first page des avis)
    $AvisController->AfficherPageVehiculeAvis($id_vehicule,$Npage);

} elseif(isset($_GET['Npage'], $_GET['idvehicule'])){
    $id_vehicule = $_GET['idvehicule'];
    // Npage -- nombre de pages
    $Npage = $_GET['Npage'];
    $AvisController = new AvisController();
    $AvisController->AfficherPageVehiculeAvis($id_vehicule, $Npage);
}

else{

    $MarquesController = new MarquesController();
    $AvisPage = "true"; // elle indique qu'on est dans la page avis et pas marques
    $MarquesController->AffichMarquesPage($AvisPage);
    // $AvisController = new AvisController();
    // $AvisController->AfficherAvisPage();
}

?>