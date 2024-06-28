<?php

include_once '../Model/ComparaisonModel.php';
include_once '../Model/VehiculeModel.php';
require_once('../View/ComparaisonsView.php');
require_once('../View/FormComparaisonsView.php');
require_once('../View/ComparateurView.php');
require_once('../View/DetailsvehiculeView.php');
require_once('../View/DetailsVehView.php');
require_once('../View/ComparView.php');


class ComparateurController{
    public function AfficherPlusRechComp(){
        $ComparaisonModel = new ComparaisonModel();
        $Comparaisons = $ComparaisonModel->PlusRechercheComparaison();
        $ComparaisonsView = new ComparaisonsView();
        $ComparaisonsView->afficherPlusRechComp($Comparaisons);
    }

    public function FormComparaison(){
        $FormComparaisonsView = new FormComparaisonsView();
        $FormComparaisonsView->afficherFormComparaison();
    }

    public function AfficherPageComparateur($infos){
        $ComparateurView = new ComparateurView();
        $ComparateurView->afficherPageComparateur($infos);
    }

    public function Comparer($data){
        $ComparaisonModel = new ComparaisonModel();
        $Comparaisons = $ComparaisonModel->ComparerVehicules($data);
        // $ComparView = new ComparView();
        // $ComparView->afficherResComparaison($Comparaisons);
        // return $comp;
        return $Comparaisons;
    }

    public function AfficherInfosVeh($id_vehicule){
        $VehiculeModel = new VehiculeModel();
        $InfosVeh = $VehiculeModel->getCaracteristiqueVeh($id_vehicule);
        $DetailsvehiculeView = new DetailsvehiculeView();
        $DetailsvehiculeView->afficherDetailss($InfosVeh);
    }

    public function AfficherPlusRechCompbyid($idVehicule){
        $ComparaisonModel = new ComparaisonModel();
        $Comparaisons = $ComparaisonModel->PlusRechercheComparaisonbyid($idVehicule);
        $DetailsVehView = new DetailsVehView();
        $DetailsVehView->afficherPlusRechCompveh($Comparaisons);
    }

    public function getNote($idVehicule){
        $VehiculeModel = new VehiculeModel();
        $note= $VehiculeModel->getNoteVehicule($idVehicule);
        return $note;
    }

}

?>