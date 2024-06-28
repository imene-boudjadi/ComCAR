<?php

include('../Controller/CaracteristiquesController.php');

session_start();
// recuperer l id
$idMarque = isset($_GET['id_marque']) ? $_GET['id_marque'] : null;
if ($idMarque) {
    // trouver les infos/details de la marque
    $CaracteristiquesController = new CaracteristiquesController();
    $CaracteristiquesController->AfficherCaracteristiquesMarques($idMarque);
} else {
    // echo "id_marque vide";
}
?>
