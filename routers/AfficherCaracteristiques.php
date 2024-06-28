<?php
 
include('../Controller/CaracteristiquesController.php');
    $Admincontroller = new LoginAdminController();    
    $Admincontroller->afficherLoginForm();
// recuperer l id
$idVehicule = isset($_GET['id_vehicule']) ? $_GET['id_vehicule'] : null;
if ($idVehicule) {
    // trouver les caracteristiques
    $CaracteristiquesController = new CaracteristiquesController();
    $CaracteristiquesController->AfficherCaracteristiquesVeh($idVehicule);
} else {
    echo "id_vehicule vide";
}
?>
