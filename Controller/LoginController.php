<?php

require_once '../Model/LoginModel.php';
require_once '../Controller/AccueilController.php';
require_once '../View/UserLoginFormView.php';
require_once '../View/SignupFormView.php';

class LoginController{

    public function UserLoginVerif($adresse, $password)
    {
        $LoginModel = new LoginModel();
        $utilisateur = $LoginModel->findUser($adresse, $password);
        return $utilisateur;
    }

    public function login($adresse, $password){
        $utilisateur = $this->UserLoginVerif($adresse, $password);
        if ($utilisateur) {
            session_start();
            $_SESSION['adresse'] = $adresse;
            return $utilisateur;
            // $this->afficherUserLoginForm();
        } else {
             return null; // cest vide
            // $AccueilController = new AccueilController();
            // $AccueilController->AfficherPageAccueil();
        }
    }

    public function FindExisteUser($adresse,$username,$password){
        $LoginModel = new LoginModel();
        $utilisateur = $LoginModel->FindExisteUser($adresse, $username,$password);
        return $utilisateur;
    }

    public function FindAdresseUsername($adresse,$username){
        $LoginModel = new LoginModel();
        $user = $LoginModel->FindAdresseUsernameUser($adresse,$username);
        return $user;
    }

    public function afficherUserLoginForm(){
        $LoginForm = new UserLoginFormView();
        $LoginForm->AfficheFormLogin();
    }

    public function Inscription($nom, $prenom, $username, $adresse, $sexe, $dateNaiss, $password, $pathimage){
        $LoginModel = new LoginModel();
        $LoginModel->InscrUser($nom, $prenom, $username, $adresse, $sexe, $dateNaiss, $password, $pathimage);
    }

    public function afficherUserSignupForm(){
        $SignupForm = new SignupFormView();
        $SignupForm->affichUserSignupForm();
    }
}
?>



