<?php

require_once('../View/Template.php');
require_once('../Controller/CaracteristiquesController.php');


class GuideAchatView extends Template{
    public function GuideAchat($Conseils){
        ?>

    <div class="container">
  
        <div class="d-flex justify-content-center">
            <h1 class="mt-5 text-center display-4;" style="margin-top:2%;margin-left3%; color:#8D6A9F">Guide d'achat de véhicules</h1>
        </div>
 
        <p class="lead text-center" style="margin-top:4%;margin-left:-6%;">L'achat d'un véhicule est une décision importante. Il est important de bien se renseigner avant de choisir.</p>
        <p class="lead text-center" style="margin-top:-1%; margin-bottom:4%;">Voici quelques conseils qui vous aideront à bien choisir votre véhicule :</p>
        <div  style = "background-color:#EEEEEE; max-width:85%; margin-left:5%;border:1px solid black">
            <div style = "max-width:95%; margin-top:-3%; margin-bottom:2%;margin-left:2.5%;">
    <?php
        foreach ($Conseils as $Conseil) {
    ?>
                <h4 class="text-center mb-3" style="margin-top:5%;"><?php echo $Conseil['titreConseil']; ?></h4>
                <p class="text-center"><?php echo $Conseil['Conseil']; ?></p>
    <?php
        }
    ?>
            </div>
        </div>
 
        <p class="lead text-center" style="margin-bottom:3%;margin-top:6%;margin-left:-7%;">En suivant ces conseils, vous serez en mesure de choisir le véhicule qui vous convient le mieux.</p>
        <p class="lead text-center" style="margin-bottom:5%;margin-top:6%;margin-left:-7%;">vous pouvez choisir un vehicule et aller vers sa page de description</p>
        <?php
        $CaracteristiquesController = new CaracteristiquesController();
        $CaracteristiquesController->ListeAllVehCaracteristiques();
        ?>
        <p class="lead text-center" style="margin-top:5%;margin-bottom:-2%;margin-left:-7%;">Besoin de conseils personnalisés ou d'informations supplémentaires ?</p>
        <a href="../routers/Contact.php">
            <button type="button" class="btn btn-primary mt-5" style="background-color: #8D6A9F; color: white; border-color: black; margin-left: 37%;margin-top:-10%;width:20%;height:7vh;">Contactez-nous</button>
         </a>
    
 </div>
 <!-- ajouter un select pour choisir un vehicule et aller vers sa page de recherche -->
</body>
</html>
    <?php
    }
    public function AfficherGuideAchatPage($Conseils){
        $this->entetePage("Guide d'achat");
        $this->AfficherLogo();
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){
            $this->profilButton();
            $this->logoutButton();
        }
        else{
            $this->afficherLoginButton();
        }
        // $this->afficherLoginButton();
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        $this->GuideAchat($Conseils);
        $this->AffichPiedPage();
    }
}

?>