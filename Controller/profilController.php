<?php

require_once('../Model/LoginModel.php');
require_once('../Model/AvisModel.php');
require_once '../View/ProfilView.php';

class profilController {
    public function AfficherProfilPage() {
        $ProfilView = new ProfilView();
        $ProfilView->AffichProfilPage();
    }

    public function AfficherInfosPersonnelles($adresse){
        $LoginModel = new LoginModel();
        $infos = $LoginModel->FindInfosPerson($adresse);
        return $infos;
    }

    public function getVehFavoris($adresse){
        $AvisModel = new AvisModel();
        $vehicules = $AvisModel->getFavorisveh($adresse);
        return $vehicules;
    }

    public function AfficherProfilPageFromadmin($iduser){
        $LoginModel = new LoginModel();
        $infos = $LoginModel -> FindInfosPersonbyid($iduser);
        $ProfilView = new ProfilView();
        $ProfilView->AfficherProfilPageFromadmin($infos); //la page profil que ladmin peut voir 
    }


}

?>