<?php

include_once '../Model/VehiculeModel.php';
require_once('../View/CaracteristiquesView.php');
require_once('../View/MarqueInfosView.php');

class CaracteristiquesController{

    public function AfficherCaracteristiquesVeh($idVehicule){
        $VehiculeModel = new VehiculeModel();
        $caracteristiques = $VehiculeModel->getCaracteristiqueVeh($idVehicule);
        $CaracteristiquesView = new CaracteristiquesView();
        $CaracteristiquesView->afficherCaracteristiques($caracteristiques);
    }

    public function AfficherCaracteristiquesMarques($idMarque){
        $VehiculeModel = new VehiculeModel();
        $infosMarque = $VehiculeModel->getEditMarque($idMarque);
        $MarqueInfosView = new MarqueInfosView();
        $MarqueInfosView->afficherInfosMarques($infosMarque);
    }

    public function AfficherInfosMarque($idMarque){
        $VehiculeModel = new VehiculeModel();
        $infosMarque = $VehiculeModel->getEditMarque($idMarque);
        $MarqueInfosView = new MarqueInfosView();
        $MarqueInfosView->affichInfosMarques($infosMarque);
    }

    public function getPrincipalesVeh($idMarque,$AvisPage){
        $VehiculeModel = new VehiculeModel();
        $Vehicules = $VehiculeModel->getPrincipalesVehOfM($idMarque);
        $MarqueInfosView = new MarqueInfosView();
        $MarqueInfosView->affichVehprinc($Vehicules,$AvisPage);
    }

    public function ListeVehbyMarque($idmarque,$AvisPage){
        $VehiculeModel = new VehiculeModel();
        $Vehicules = $VehiculeModel->getvehiculesBymarque($idmarque);
        $MarqueInfosView = new MarqueInfosView();
        $MarqueInfosView->ListeVehbyMarque($Vehicules,$AvisPage);
    }

    public function ListeAllVehCaracteristiques(){
        $VehiculeModel = new VehiculeModel();
        $Vehicules = $VehiculeModel->getAllVehicules();
        $MarqueInfosView = new MarqueInfosView();
        $MarqueInfosView->ListeVehbyMarque($Vehicules);
    }

    public function getInfovehicule($idVehicule){
        $VehiculeModel = new VehiculeModel();
        $caracteristiques = $VehiculeModel->getCaracteristiqueVeh($idVehicule);
        return $caracteristiques;
    }

    
}

?>