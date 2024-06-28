<?php

require_once('../Controller/CaracteristiquesController.php');

if (isset($_GET['dataMarque']) && isset($_GET['dataMarquee'])) {
    $idmarque = $_GET['dataMarque'];
    $AvisPage =$_GET['dataMarquee'];
    $CaracteristiquesController = new CaracteristiquesController();
    $CaracteristiquesController->AfficherInfosMarque($idmarque);
    echo '<a href="../routers/MarqueDetails.php?id_marque=' . $idmarque . '" style="margin-left:50%;margin-top:2% !important;color:#8D6A9F;"><b>Consulter la page marque pour plus de détails...</b></a>';
    $CaracteristiquesController->getPrincipalesVeh($idmarque,$AvisPage);
    $CaracteristiquesController->ListeVehbyMarque($idmarque,$AvisPage);
} else {
    echo json_encode(['errorrr']);
}

?>
