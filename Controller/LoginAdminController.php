<?php

require_once '../Model/LoginModel.php'; 
require_once '../View/AdminAcceilview.php'; 
require_once '../View/AdminFormView.php';

class LoginAdminController{

    private function AdminLoginVerif($adresse,$password) // LoginModel
    {
        $LoginModel = new LoginModel();
        $admin = $LoginModel->AdminLoginVerif($adresse,$password);
        return $admin;
    }

    public function AfficherAccueilAdmin($adresse,$password){
        if ($this->AdminLoginVerif($adresse, $password) == []){
            $this->afficherLoginForm();
        }else {
            session_start();
            $_SESSION['adresseAdmin'] = $adresse;
            $_SESSION['passAdmin'] = $password;
            $interface = new AdminAcceilview();
            $interface->afficherAdminAcceuil(); 
        }
    }

    public function afficherLoginForm(){
        $LoginForm = new AdminLoginFormView();
        $LoginForm->AfficheFormAdmin();
    }
}

?>