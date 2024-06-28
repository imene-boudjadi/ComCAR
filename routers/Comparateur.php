<?php

require_once '../Controller/ComparateurController.php';
require_once '../View/ComparView.php';

session_start();
if(isset($_GET['id_vehicule'])){ // details vehicule
    $id_vehicule = $_GET['id_vehicule'];
    $ComparateurController = new ComparateurController();
    $ComparateurController->AfficherInfosVeh($id_vehicule);

}else{ // page comparateur 

    $Infos = isset($_GET['result']) ? json_decode(urldecode($_GET['result']), true) : null;  // recuperer les donnes de comparaison (peut etre null, jai fait cette verification dans la page view de comparateur 
    $ComparateurController = new ComparateurController();
    $ComparateurController->AfficherPageComparateur($Infos);

}

?>


