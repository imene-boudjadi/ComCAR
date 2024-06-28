<?php

require_once '../Model/VehiculeModel.php';
require_once '../View/LogoMarquesView.php';
require_once '../View/MarquesView.php';
require_once '../View/DetailsLogosMarquesView.php';


class MarquesController{

    public function LogoMarquesPrincipales(){
        $VehiculeModel = new VehiculeModel();
        $logosMarques = $VehiculeModel->getLogosPrincipalMarques();
        $LogoMarquesView = new LogoMarquesView();
        $LogoMarquesView->afficherLogosMarquesPrincipales($logosMarques);
    }

    public function RecupererAllMarques(){
        $VehiculeModel = new VehiculeModel();
        $logosMarques = $VehiculeModel->getAllMrques();
        return $logosMarques;
    }

    public function RecupererModelesParMarque($idmarque){
        $VehiculeModel = new VehiculeModel();
        $Modeles = $VehiculeModel->getAllModeleOfMarque($idmarque);
        return $Modeles;
    }

    public function RecupererVersionsParModele($idmodele){
        $VehiculeModel = new VehiculeModel();
        $versions = $VehiculeModel->getAllVersionsOfModele($idmodele);
        return $versions;
    }

    public function RecupererAnneesParModeleANDversion($idmodele,$idVersion){
        $VehiculeModel = new VehiculeModel();
        $annees = $VehiculeModel->getAllAnneesOfModeleANDversion($idmodele,$idVersion);
        return $annees;
    }

    public function AffichMarquesPage($AvisPage){
        $MarquesView = new MarquesView();
        $MarquesView->AfficherMarquesPage($AvisPage);        
    }

    public function LogoMarquesPrincipalesPM($AvisPage){ // avec logo grand et le nom 
        $VehiculeModel = new VehiculeModel();
        $logosMarques = $VehiculeModel->getLogosPrincipalMarques();
        $DetailsLogosMarquesView = new DetailsLogosMarquesView();
        $DetailsLogosMarquesView->afficherDLogosMarquesPrincipales($logosMarques,$AvisPage);
    }

    public function getNoteM($idMarque){
            $VehiculeModel = new VehiculeModel();
            $note= $VehiculeModel->getNoteMarque($idMarque);
            return $note;
    }
}

?>