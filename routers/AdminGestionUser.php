<?php

require_once('../Controller/AdminUserController.php');
require_once('../Controller/LoginAdminController.php');



session_start();
if($_SESSION['adresseAdmin']!=[]){
$AdminUserController = new AdminUserController();

if (isset($_GET['idUserSuppr'])) { // supprimer user
    $iduser = $_GET['idUserSuppr'];
    $AdminUserController->deleteUser($iduser);
    $AdminUserController->AfficherTableUser();
    
} elseif (isset($_POST['datauser'])) { // bloquer user
    $iduser = $_POST['datauser'];
    $rep = $AdminUserController->bloque($iduser);
    header('Content-Type: application/json');
    echo json_encode($rep);

} elseif (isset($_POST['datauserDebloqu'])) { // debloquer uer
    $iduser = $_POST['datauserDebloqu'];
    $rep = $AdminUserController->debloque($iduser);
    header('Content-Type: application/json');
    echo json_encode($rep);

} elseif(isset($_POST['datauserValid'])){ //valider inscription 
    $iduser = $_POST['datauserValid'];
    $rep = $AdminUserController->validerInsc($iduser);
    header('Content-Type: application/json');
    echo json_encode($rep);
}
else {
    // Afficher la table des users
    $AdminUserController->AfficherTableUser();
}
}else{
    $Admincontroller = new LoginAdminController();    
    $Admincontroller->afficherLoginForm();
}
?>
