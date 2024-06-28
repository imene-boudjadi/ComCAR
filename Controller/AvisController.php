<?php

include_once '../Model/AvisModel.php';
include_once '../Model/LoginModel.php';
include_once '../View/AvisView.php';

class AvisController{

    public function FindTop3AvisVeh($idVehicule){
        $AvisModel = new AvisModel();
        $Avis = $AvisModel->getTop3AvisVeh($idVehicule);
        // return $Avis;
        $AvisView= new AvisView();
        $AvisView->Afficher3topAvisVeh($Avis);
    }

    public function FindTop3AvisMarque($idmarque){
        $AvisModel = new AvisModel();
        $Avis = $AvisModel->getTop3AvisMarque($idmarque);
        // return $Avis;
        $AvisView= new AvisView();
        $AvisView->Afficher3topAvisMarque($Avis);
    }

    public function FindAllAvisVeh($idVehicule){
        $AvisModel = new AvisModel();
        $Avis = $AvisModel->getAllAvisVeh($idVehicule);
        $AvisView= new AvisView();
        $AvisView->AfficherAllAvisVeh($Avis);
    }

    public function FindAllAvisMarque($idmarque){
        $AvisModel = new AvisModel();
        $Avis = $AvisModel->getAllAvisMarque($idmarque);
        $AvisView= new AvisView();
        $AvisView->AfficherAllAvisMarque($Avis);
    }

    public function Apprecierveh($idAvis,$adresse){
        $AvisModel = new AvisModel();
        $rep = $AvisModel->Appreciervehicule($idAvis,$adresse);
        return $rep;
    }
    
    public function ApprecierMarque($idAvis,$adresse){
        $AvisModel = new AvisModel();
        $rep = $AvisModel->ApprecierM($idAvis,$adresse);
        return $rep;
    }

    public function getAppr($idAvis,$adresse){
        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $AvisModel = new AvisModel();
        $Appr = $AvisModel->getAppr($idAvis,$user['idUser']);
        return $Appr;
    }

    public function getApprM($idAvis,$adresse){
        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $AvisModel = new AvisModel();
        $Appr = $AvisModel->getApprM($idAvis,$user['idUser']);
        return $Appr;
    }

    public function DeApprecierveh($idAvis,$adresse){
        $AvisModel = new AvisModel();
        $rep = $AvisModel->DeAppreciervehicule($idAvis,$adresse);
        return $rep;
    }

    public function DeApprecierMarque($idAvis,$adresse){
        $AvisModel = new AvisModel();
        $rep = $AvisModel->DeApprecierM($idAvis,$adresse);
        return $rep;
    }

    public function getFavorisVehiculeuser($idvehicule, $adresseuser){
        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresseuser);
        $AvisModel = new AvisModel();
        $rep = $AvisModel->getFavorisVehiculeuser($idvehicule,$user['idUser']);
        return $rep;
    }

    public function AddFavoris($idvehicule,$adresse){
        $AvisModel = new AvisModel();
        $rep = $AvisModel->addfavorisveh($idvehicule,$adresse);
        return $rep;
    }

    public function RemoveFavoris($idvehicule,$adresse){
        $AvisModel = new AvisModel();
        $rep = $AvisModel->removefavorisveh($idvehicule,$adresse);
        return $rep;
    }

    public function AfficherPageVehiculeAvis($id_vehicule,$Npage){
        $AvisModel = new AvisModel();
        $Avis = $AvisModel->getAllAvisVeh($id_vehicule);
        $AvisView= new AvisView();
        $AvisView->AfficherpagevehAvis($Avis,$Npage,$id_vehicule);
    }


    public function getNotevehbyuser($idVehicule,$adresse){

        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $AvisModel = new AvisModel();
        $note = $AvisModel->getNoteVehbyUser($idVehicule, $user['idUser']);
        return $note;       

    }

    public function getNoteMbyuser($idmarque,$adresse){

        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $AvisModel = new AvisModel();
        $note = $AvisModel->getNoteMarquebyUser($idmarque, $user['idUser']);
        return $note;       

    }

    public function AddNote($idvehicule,$adresse,$note){
        $AvisModel = new AvisModel();
        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $rep = $AvisModel->AddNoteVeh($user['idUser'],$idvehicule,$note);
        return $rep;
    }
    
    public function AddNoteM($idmarque,$adresse,$note){
        $AvisModel = new AvisModel();
        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $rep = $AvisModel->AddNoteMarque($user['idUser'],$idmarque,$note);
        return $rep;
    }

    public function AddAvis($idvehicule,$adresse,$avis){
        $AvisModel = new AvisModel();
        $LoginModel = new LoginModel();
        $user=$LoginModel->FindInfosPerson($adresse);
        $rep = $AvisModel->AddAvisVeh($idvehicule,$user['idUser'],$avis);
        return $rep;
    }
}

?>