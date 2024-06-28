<?php

require_once('../Controller/AdminAvisController.php');
require_once('../Controller/LoginAdminController.php');



session_start();
if($_SESSION['adresseAdmin']!=[]){
$AdminAvisController = new AdminAvisController();

if (isset($_GET['idAvis'])) { // refuser commentaire vehicule
    $idavis = $_GET['idAvis'];
    $AdminAvisController->deletecomm($idavis); //suppression logique
    $AdminAvisController->AfficherTableAvisVeh();
    
}
elseif (isset($_POST['dataavis'])) { // valider avis veh
    $idavis = $_POST['dataavis'];
    $rep = $AdminAvisController->valideravis($idavis);
    header('Content-Type: application/json');
    echo json_encode($rep);

} elseif($_POST['dataavisM']){ //valider avis marque
    $idavis = $_POST['dataavisM'];
    $rep = $AdminAvisController->valideravisM($idavis);
    header('Content-Type: application/json');
    echo json_encode($rep);
}
elseif (isset($_GET['idAvisM'])) { // refuser commentaire marque
    $idavis = $_GET['idAvisM'];
    $AdminAvisController->deletecommM($idavis); 
    $AdminAvisController->AfficherTableAvisMarque();

} 
elseif (isset($_GET['afficheMarques'])) { // debloquer uer
    $AdminAvisController->AfficherTableAvisMarque();


}
else {
    // Afficher table des avis
    $AdminAvisController->AfficherTableAvisVeh();
}
}else{
    $Admincontroller = new LoginAdminController();    
    $Admincontroller->afficherLoginForm();
}
?>