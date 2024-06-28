<?php

require_once '../Controller/LoginAdminController.php';

session_start();
$Admincontroller = new LoginAdminController();

if (isset($_POST['submit'])) {
    $Admincontroller->AfficherAccueilAdmin($_POST['adresse'],$_POST['password']);
}
elseif(isset($_POST['logout'])){
    session_destroy();
    $Admincontroller = new LoginAdminController();    
    $Admincontroller->afficherLoginForm();
}
else{
    if ($_SESSION['adresseAdmin'] != []){
        $Admincontroller->AfficherAccueilAdmin($_SESSION['adresseAdmin'] ,$_SESSION['passAdmin']);
    }
    else{
        $Admincontroller->afficherLoginForm();
    }
    
   
    
}

?>