<?php 

require_once('../View/Template.php');
require_once('../Controller/MarquesController.php');

class MarquesView extends Template{
    public function AfficherMarquesPage($AvisPage){
        if ($AvisPage == "true"){
            $this->entetePage("Avis");
        }else{
            $this->entetePage("Marques");
        }
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
        $MarquesController = new MarquesController();
        $MarquesController->LogoMarquesPrincipalesPM($AvisPage);
        $this->AffichPiedPage();
    }
}


?>