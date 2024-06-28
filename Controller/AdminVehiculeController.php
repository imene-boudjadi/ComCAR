<?php

include_once '../Model/VehiculeModel.php';
require_once '../View/AdminVehiculeView.php'; 
require_once '../View/AdminEditVehView.php'; 
require_once '../View/AdminNewVehiculeView.php'; 
require_once '../View/AdminNewMarqueView.php'; 
require_once '../View/AdminEditerMarque.php';
require_once '../View/AdminMarqueView.php';

class AdminVehiculeController{

    public function AfficherTableVehicules(){
        $VehiculeModel = new VehiculeModel();
        $Vehicules = $VehiculeModel->getAllVehicules();
        $TableVeh = new AdminVehiculeView();
        $TableVeh->afficherVehicules($Vehicules);
    }

    public function AddVehiculeForm(){
        $VehiculeModel = new VehiculeModel();
        $Marques = $VehiculeModel->getAllMrques();
        $AdminNewVehiculeView = new AdminNewVehiculeView();
        $AdminNewVehiculeView->FormAddVehicule($Marques);
    }

    public function AddVehicule($modele,$image,$version,$annee,$moteur,$performance,$dimensions,$puissance,$capacite,$consommation,$tarif,$marque){
        $VehiculeModel = new VehiculeModel();
        $VehiculeModel->AjoutVehicule($modele,$image,$version,$annee,$moteur,$performance,$dimensions,$puissance,$capacite,$consommation,$tarif,$marque);
        $Vehicules = $VehiculeModel->getAllVehicules();
        $TableVeh = new AdminVehiculeView();
        $TableVeh->afficherVehicules($Vehicules);
    }

    public function DeleteVehicule($id_vehicule){
        $VehiculeModel = new VehiculeModel();
        $VehiculeModel->supprVehicule($id_vehicule);
        $Vehicules = $VehiculeModel->getAllVehicules();
        $TableVeh = new AdminVehiculeView();
        $TableVeh->afficherVehicules($Vehicules);
    }

    public function EditVehiculeForm($id_vehicule){
        $VehiculeModel = new VehiculeModel();
        $Vehicule = $VehiculeModel->getEditVehicule($id_vehicule);
        $marques= $VehiculeModel ->getAllMrques();
        $EditForm = new AdminEditVehView();
        $EditForm->FormEditVeh($Vehicule,$marques);
    }

    public function EditVehicule($id_vehicule,$modele,$version,$annee,$moteur,$performance,$dimensions,$puissance,$capacite,$consommation,$tarif,$marque,$pathimage){
        $VehiculeModel = new VehiculeModel();
        $VehiculeModel->ModifierVehicule($id_vehicule,$modele,$version,$annee,$moteur,$performance,$dimensions,$puissance,$capacite,$consommation,$tarif,$marque,$pathimage);
        $Vehicules = $VehiculeModel->getAllVehicules();
        $TableVeh = new AdminVehiculeView();
        $TableVeh->afficherVehicules($Vehicules);
    }

    public function AddMarqueForm(){
        $AdminNewMarqueView = new AdminNewMarqueView();
        $AdminNewMarqueView->FormAddMarque();
    }

    public function AfficherTabMarques(){
        $VehiculeModel = new VehiculeModel();
        $Marques = $VehiculeModel->getAllMrquesWithInfos();
        $TableVeh = new AdminMarqueView();
        $TableVeh->afficherAllMarques($Marques);
    }
    
    public function AddMarque($NomMarque,$PaysOrigine,$SiegeSocial,$AnneeCreation,$ImageLogo){
        $VehiculeModel = new VehiculeModel();
        $VehiculeModel->AjoutMarque($NomMarque,$PaysOrigine,$SiegeSocial,$AnneeCreation,$ImageLogo);
        $Marques = $VehiculeModel->getAllMrquesWithInfos();
        $TableVeh = new AdminMarqueView();
        $TableVeh->afficherAllMarques($Marques);
    }

    public function DeleteMarque($id_marque){
        $VehiculeModel = new VehiculeModel();
        $VehiculeModel->supprMarque($id_marque);
        $Marques = $VehiculeModel->getAllMrquesWithInfos();
        $TableVeh = new AdminMarqueView();
        $TableVeh->afficherAllMarques($Marques);
    }

    public function EditMarqueForm($id_marque){
        $VehiculeModel = new VehiculeModel();
        $marque = $VehiculeModel->getEditMarque($id_marque);
        $EditForm = new AdminEditerMarque();
        $EditForm->FormEditMarque($marque);
    }

    public function EditMarque($id_marque,$NomMarque,$PaysOrigine,$SiegeSocial,$AnneeCreation,$image){
        $VehiculeModel = new VehiculeModel();
        $VehiculeModel->ModifierMarque($id_marque,$NomMarque,$PaysOrigine,$SiegeSocial,$AnneeCreation,$image);
        $Marques = $VehiculeModel->getAllMrquesWithInfos();
        $TableVeh = new AdminMarqueView();
        $TableVeh->afficherAllMarques($Marques);
    }

    public function GetMarqueById($id_marque){
        $VehiculeModel = new VehiculeModel();
        $marque = $VehiculeModel->getEditMarque($id_marque);
        return $marque;
    }

    public function GetVehiculeById($id_vehicule){
        $VehiculeModel = new VehiculeModel();
        $Vehicule = $VehiculeModel->getEditVehicule($id_vehicule);
        return $Vehicule;
    }
    
}

?>