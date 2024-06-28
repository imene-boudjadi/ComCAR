<?php

require_once('../Controller/DiaporamaController.php');
require_once('../Controller/MenuController.php');
require_once('../Controller/MarquesController.php');
require_once('../Controller/ComparateurController.php');
require_once('../View/Template.php');

class AccueilView extends Template{

    public function AfficherPageAccueil() {

        $this->entetePage("Accueil");

        // Afficher le logo 
        $this->AfficherLogo();

        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){
          
            $this->profilButton();
            $this->logoutButton();
        }
        else{
            $this->afficherLoginButton();
        }

        // Réseaux sociaux (les liens)
        $this->AfficherReseauxSociaux();

        // Afficher Diaporama
        $this->AffichDiapo();

        // Afficher le menu 
        $this->AffichMenu();

        // Zones de contenu
        echo '<h1 style=" display: flex;align-items: center; justify-content: center; margin-top:3%;margin-left:-3%;">Bienvenue sur le site ComCar</h1>';

        // zone 1
        $MarquesController = new MarquesController();
        $MarquesController->LogoMarquesPrincipales();
        // zone 2
        $ComparateurController = new ComparateurController();
        $ComparateurController->FormComparaison();
        // zone 3
        ?>
        <!-- class="btn btn-primary" style="background-color: red; color: white; border-color: red; margin-left: -60%;" /> -->
        <a href="../routers/Guides d'achat.php">
            <button type="button" class="btn btn-primary" style="background-color: #8D6A9F; color: white; border-color: black; margin-left: 39%;margin-top:8%;width:20%;height:7vh;">Consulter le guide d'achat</button>
        </a>
        <?php
        $ComparateurController = new ComparateurController();
        $ComparateurController->AfficherPlusRechComp();

        // Footer
        $this->AffichPiedPage();
    }

}

?>