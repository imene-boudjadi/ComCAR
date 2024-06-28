<?php

require_once('../Controller/MarquesController.php');
require_once('../Controller/ComparateurController.php');

if (isset($_GET['dataMarque'])) {
    $idmarque = $_GET['dataMarque'];
    $MarquesController = new MarquesController();
    $modeles = $MarquesController->RecupererModelesParMarque($idmarque);
    header('Content-Type: application/json');
    echo json_encode($modeles);

}elseif(isset($_GET['dataModele'])){
    $idmodele = $_GET['dataModele'];
    $MarquesController = new MarquesController();
    $versions = $MarquesController->RecupererVersionsParModele($idmodele);
    header('Content-Type: application/json');
    echo json_encode($versions);

}elseif(isset($_GET['dataModelee']) && ($_GET['dataVersion']) ){
    $idmodele = $_GET['dataModelee'];
    $idVersion = $_GET['dataVersion'];
    $MarquesController = new MarquesController();
    $annees = $MarquesController->RecupererAnneesParModeleANDversion($idmodele,$idVersion);
    header('Content-Type: application/json');
    echo json_encode($annees);

}elseif(isset($_GET['dataVehicule']) && ($_GET['dataVehiculee']) ){
    $Infosveh = $_GET['dataVehicule'];
    $ComparateurController = new ComparateurController();
    $ResComparaison = $ComparateurController->Comparer($Infosveh);
    header('Content-Type: application/json');
    echo json_encode($ResComparaison);

}else {
    echo json_encode(['error (pas de parametre)']);
}

?>
