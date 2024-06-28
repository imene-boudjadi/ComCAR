<?php

require_once('../Model/AvisModel.php');
require_once '../View/AdminAvisView.php';

class AdminAvisController{

    public function AfficherTableAvisVeh(){
        $AvisModel= new AvisModel();
        $Avis = $AvisModel ->getAvisVeh();
        $AdminAvisView = new AdminAvisView();
        $AdminAvisView -> AffichTableAvisVeh($Avis);
    }

    public function AfficherTableAvisMarque(){
        $AvisModel= new AvisModel();
        $Avis = $AvisModel ->getAvisMarques();
        $AdminAvisView = new AdminAvisView();
        $AdminAvisView -> AffichTableAvisMarque($Avis);
    }

    public function valideravis($idavis){ //avis vehicule
        $AvisModel= new AvisModel();
        $rep= $AvisModel -> Valideravisveh($idavis);
        return $rep;
    }

    public function valideravisM($idavis){ //avis marque
        $AvisModel= new AvisModel();
        $rep= $AvisModel -> ValideravisM($idavis);
        return $rep;
    }

    public function deletecomm($idavis){ //avis vehicule
        $AvisModel= new AvisModel();
        $AvisModel -> refuseAvisVeh($idavis);
    }

    public function deletecommM($idavis){ //avis marque
        $AvisModel= new AvisModel();
        $AvisModel -> refuseAvisM($idavis);
    }


}

?>