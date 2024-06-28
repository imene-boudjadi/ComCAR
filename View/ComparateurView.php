<?php

require_once('../View/Template.php');
require_once('../Controller/ComparateurController.php');

class ComparateurView extends Template{
    public function afficherPageComparateur($infos){
        $this->entetePage("Comparateur");
        $this->AfficherLogo();
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){
            $this->profilButton();
            $this->logoutButton();
        }
        else{
            $this->afficherLoginButton();
        }
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        echo '<div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 50px; margin-top:-10%;color:#8D6A9F"> Comparateur de véhicules </h1></div>';
        $ComparateurController = new ComparateurController;
        $ComparateurController->FormComparaison();
        if ($infos) {
    
                $ComparView = new ComparView();
                $ComparView->afficherResComparaison($infos);
                // $ComparateurController = new ComparateurController();
                // $ComparateurController->Comparer($infos);
               
        } else {
            // echo "Aucune donnée reçue.";
        }
        $this->AffichPiedPage();
    }
}

?>