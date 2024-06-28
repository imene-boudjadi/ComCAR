<?php

require_once('../Controller/profilController.php');
require_once('../Controller/LoginController.php');
require_once('../View/Template.php');

class ProfilView extends Template{

    public function AfficherInfos($infos){
        if ($infos) {
            ?>
      
        <div style="background-color: #EEEEEE; max-width: 70%; margin-left: 14%; border: 1px solid black;">
    <div style="max-width: 95%; margin-top: 2%; margin-bottom: 2%; margin-left: 2.5%;">
        <div style="display: flex; flex-direction: row;">
            <div style="flex: 0 0 30%;"><h5 style="margin-top: 0%;">Nom :</h5></div>
            <div style="flex: 0 0 70%;"><p><?php echo $infos['NomUser']; ?></p></div>
        </div>
        <div style="display: flex; flex-direction: row;">
            <div style="flex: 0 0 30%;"><h5 style="margin-top: 0%;">Prenom :</h5></div>
            <div style="flex: 0 0 70%;"><p><?php echo $infos['PrenomUser']; ?></p></div>
        </div>
        <div style="display: flex; flex-direction: row;">
            <div style="flex: 0 0 30%;"> <h5 style="margin-top: 0%;">Adresse Mail : </h5></div>
            <div style="flex: 0 0 70%;">  <p ><?php echo $infos['Adresse_mail']; ?></p></div>
        </div>
        <div style="display: flex; flex-direction: row;">
            <div style="flex: 0 0 30%;"><h5 style="margin-top: 0%;">Username :</h5></div>
            <div style="flex: 0 0 70%;"><p><?php echo $infos['username']; ?></p></div>
        </div>
        <div style="display: flex; flex-direction: row;">
            <div style="flex: 0 0 30%;"><h5 style="margin-top: 0%;">Sexe :</h5></div>
            <div style="flex: 0 0 70%;"><p><?php echo $infos['Sexe']; ?></p></div>
        </div>
        <div style="display: flex; flex-direction: row;">
            <div style="flex: 0 0 30%;"><h5 style="margin-top: 0%;"> Date de naissance :</h5></div>
            <div style="flex: 0 0 70%;"><p><?php echo $infos['DateNaissance']; ?></p></div>
        </div>
    </div>
</div>
            <?php
        }
    }

    public function AffichvehFavoris($vehicules){
        echo' <h2 style="display: flex; align-items: center; justify-content: center; margin-top: 3%; margin-left: -3%;">Vos véhicules Favoris</h2>';
        if($vehicules){
        echo '<div class="d-flex flex-wrap justify-content-center" style="margin-left:0%;margin-top:-5%; width:80%;height:40%;">';
        foreach ($vehicules as $vehicule) {
            ?>
            <a href="../routers/Comparateur.php?id_vehicule=<?= $vehicule['idVehicule']; ?>" class="btn btn-primary" style="background-color: #CAF0FF; border : none; margin-left: 15%; margin-top:10%;width:35%;">
                <img src="<?= $vehicule['ImageVehicule']; ?>" alt="vehicule" width="330" height="200" style="margin-left:0%;">
                
                <h4 style="color:#333333; margin-top:3%;"><?php echo $vehicule['ModeleVehicule']; ?></h4>
            </a>    
        <?php
        }
        echo '</div> ';
    }else{
        echo '<h6 style="color:#8D6A9F; margin-top:3%; margin-left:38%;">Vous n\'avez pas de véhicules favoris.</h6>';
    }
    }
    public function AffichProfilPage() {

        $this->entetePage("Profil");
        $this->AfficherLogo();
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){
            // $this->profilButton();
            $this->logoutButton();
        }
        // else{
        //     $this->afficherLoginButton();
        // }
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        $adresse=$_SESSION['adresse'];
        $profilController = new profilController();
        $infos= $profilController->AfficherInfosPersonnelles($adresse);
        $vehicules = $profilController->getVehFavoris($adresse);
        echo '<h1 class="mt-5 text-center display-4" style="margin-top:2%;margin-left:3%; color:#8D6A9F;margin-bottom:3%;">Bienvenue ' . $infos["NomUser"] . ' ' . $infos["PrenomUser"] . '</h1>';
        $this->AfficherInfos($infos);
        $this->AffichvehFavoris($vehicules);
        $this->AffichPiedPage();
    }

    public function AfficherProfilPageFromadmin($infos){
        $this->entetePage("Profil user");
        echo '<div>';
        // echo '<div style="margin-top:3%;">';
        echo '<ul class="menuUser" style="list-style-type: none;  padding: 0;overflow: hidden;  background-color: #333333; width: 75%; margin-top:5%;  margin-left: 10%;">';
            echo '<li style="float: left;"><a href="../routers/admin.php">Accueil</a></li>';
            echo '<li style="float: left;"><a href="../routers/AdmingestionVehicule.php">Gestion Véhicules</a></li>';
            echo '<li style="float: left;"><a href="../routers/AdminAvisGestion.php">Gestion Avis</a></li>';
            echo '<li style="float: left;"><a href="../routers/AdminGestionUser.php">Gestion utilisateurs</a></li>';
            echo '<li style="float: left;"><a href="../routers/AdminGestionNews.php">Gestion News</a></li>';
            echo '<li style="float: left;"><a href="#">Gestion Paramètres</a></li>';
        echo '<style>
                .menuUser li a{display: block; color: white;text-align: center;text-decoration: none;padding: 13px 35.5px;}
                .menuUser li a:hover { color: #333333; background-color: #DCDCDC;} 
            </style>';
        echo '</ul>';
        echo '</div>';
        echo '<form method="post" action="../routers/Admin.php">';
        echo '<button name="logout" value="logout" class="btn btn-outline-danger btn-sm" type="submit" style="margin-left: 76%;margin-top:0%;width:8%;height:7vh; margin-right:3%;">déconnexion</Button>';
        echo '</form>';
        echo '<h1 class="mt-5 text-center display-4" style="margin-top:2%;margin-left:3%; color:#8D6A9F;margin-bottom:3%;">Profil de ' . $infos["NomUser"] . ' ' . $infos["PrenomUser"] . '</h1>';
        $this->AfficherInfos($infos);
        
    }

}

?>