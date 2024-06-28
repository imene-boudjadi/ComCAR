<?php

require_once('../View/Template.php');
require_once '../Controller/AvisController.php';
require_once '../Controller/CaracteristiquesController.php';


class AvisView extends Template{

    public function Afficher3topAvisVeh($Avis){
        $AvisController = new AvisController();
        echo '<div class="container" style="margin-bottom:3%;">';
        echo '<h4 style= "margin-left:16%;">Découvrir les avis les plus appréciés</h4>';
        if($Avis){
            foreach($Avis as $av){
                echo '<div class="card mb-2" style="max-width:70%; margin-left:15%;">';
                    echo '<div class="card-body">';
                        echo '<h6 class="card-title" style="color:#8D6A9F;">' . $av['NomUser'] . ' ' . $av['PrenomUser'] . ' : </h6>';
                        echo '<p class="card-text">' . $av['contenuAvis'] . '</p>';
                        echo '<div class="d-flex align-items-center">';
                        session_start();
                        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []) {
                            $idAvis = $av['idAvisVeh'];
                            $adresseuser = $_SESSION['adresse'];
                            $idVehicule = $av['idVehicule'];
                            $appr = $AvisController->getAppr($idAvis, $adresseuser);
                            if ($appr) {
                                echo '<button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisVeh(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            } else {
                                echo '<button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisVeh(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            }
                        }
                        echo '<p id=nbAprr class="card-text">' . $av['nbAppr'] . ' appréciations </p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
    
            echo '<button type="button" onclick="VoirAllAvis(' . $av['idVehicule'] . ')" style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600; border:none; background:none; cursor:pointer;">Voir tous les avis...</button>';
            echo '</div>';
            echo "<div id='AllAvis' style='margin-bottom: 3%;'></div>";
        } else {
            echo '<p style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600;">Aucun avis sur ce véhicule</p>';
            echo '</div>';
        }
        ?>
        
        <script type="text/javascript" src="../JavaScript/Avis.js"></script>

        <?php
    }
    
    public Function Afficher3topAvisMarque($Avis){
       $AvisController = new AvisController();
        echo '<div class="container" style="margin-bottom:3%;">';
        echo '<h4 style= "margin-left:16%;margin-top:3%;">Découvrir les avis les plus appréciés</h4>';
        if($Avis){
            foreach($Avis as $av){
                echo '<div class="card mb-2" style="max-width:70%; margin-left:15%;">';
                    echo '<div class="card-body">';
                        echo '<h6 class="card-title" style="color:#8D6A9F;">' . $av['NomUser'] . ' ' . $av['PrenomUser'] . ' : </h6>';
                        echo '<p class="card-text">' . $av['commentaire'] . '</p>';
                        echo '<div class="d-flex align-items-center">';
                        session_start();
                        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []) {
                            $idAvis = $av['idAvisMarque'];
                            $adresseuser = $_SESSION['adresse'];
                            $idmarque = $av['Codemarque'];
                            $appr = $AvisController->getApprM($idAvis, $adresseuser);
                            if ($appr) {
                                echo '<button type="button" class="appreciationButtonM" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisM(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            } else {
                                echo '<button type="button" class="appreciationButtonM" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisM(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            }
                        }
                        echo '<p id=nbAprr class="card-text">' . $av['nbAppr'] . ' appréciations </p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
    
            echo '<button type="button" onclick="VoirAllAvisM(' . $av['Codemarque'] . ')" style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600; border:none; background:none; cursor:pointer;">Voir tous les avis...</button>';
            echo '</div>';
            echo "<div id='AllAvisM' style='margin-bottom: 3%;'></div>";
        } else {
            echo '<p style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600;">Aucun avis sur cette marque.</p>';
            echo '</div>';
        }
        ?>
        
        <script type="text/javascript" src="../JavaScript/Avis.js"></script>
        <script>
            function VoirAllAvisM(idmarque) {
    $.ajax({
        url: '../Ajax/getAllAvisVeh.php',
        type: 'GET',
        data: {
            datamarque: idmarque
        },
        success: function (response) {
            console.log('reponse:', response);
            $('#AllAvisM').html(response);
        },
        error: function (xhr) {
            console.log('Erreur dans ajax');
            alert('Erreur requete' + xhr.status);
        }
    });
}

        </script>
        
        <?php
    }

    public function AfficherAllAvisVeh($Avis) {
        $AvisController = new AvisController();
        echo '<div class="container" style="margin-bottom:3%;">';
        echo '<h4 style="margin-left:16%;">Découvrir tous les avis</h4>';
        $nbAvis = 0; // pour ne pas afficher les 3 premiers avis (deja affiches)
        foreach ($Avis as $av) {
            if ($nbAvis >= 3) {
                echo '<div class="card mb-2" style="max-width:70%; margin-left:15%;">';
                    echo '<div class="card-body">';
                        echo '<h6 class="card-title" style="color:#8D6A9F;">' . $av['NomUser'] . ' ' . $av['PrenomUser'] . ' : </h6>';
                        echo '<p class="card-text">' . $av['contenuAvis'] . '</p>';
                        echo '<div class="d-flex align-items-center">';
                        session_start();
                        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []) {
                            $idAvis = $av['idAvisVeh'];
                            $adresseuser = $_SESSION['adresse'];
                            $idVehicule = $av['idVehicule'];
                            $appr = $AvisController->getAppr($idAvis, $adresseuser);
                            if ($appr) {
                                echo '<button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisVeh(' . $idAvis . ',\'' . $adresseuser. '\')">';
                                echo '<img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            } else {
                                echo '<button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisVeh(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            }
                        }
                        echo '<p id=nbAprr class="card-text">' . $av['nbAppr'] . ' appréciations </p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            $nbAvis++;
        }
    
        if ($nbAvis <= 3) {
            echo '<p style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600;">Il n\'y a pas plus d\'avis sur ce véhicule</p>';
        }
        echo '</div>';
        echo "<div id='AllAvis' style='margin-bottom: 3%;'></div>";
        ?>
        <script type="text/javascript" src="../JavaScript/Avis.js"></script>
        <?php
    }

    public function AfficherAllAvisMarque($Avis){
        $AvisController = new AvisController();
        echo '<div class="container" style="margin-bottom:3%;">';
        echo '<h4 style="margin-left:16%;">Découvrir tous les avis</h4>';
        $nbAvis = 0; // pour ne pas afficher les 3 premiers avis (deja affiches)
        foreach ($Avis as $av) {
            if ($nbAvis >= 3) {
                echo '<div class="card mb-2" style="max-width:70%; margin-left:15%;">';
                    echo '<div class="card-body">';
                        echo '<h6 class="card-title" style="color:#8D6A9F;">' . $av['NomUser'] . ' ' . $av['PrenomUser'] . ' : </h6>';
                        echo '<p class="card-text">' . $av['commentaire'] . '</p>';
                        echo '<div class="d-flex align-items-center">';
                        session_start();
                        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []) {
                            $idAvis = $av['idAvisMarque'];
                            $adresseuser = $_SESSION['adresse'];
                            $idmarque = $av['Codemarque'];
                            $appr = $AvisController->getApprM($idAvis, $adresseuser);
                            if ($appr) {
                                echo '<button type="button" class="appreciationButtonM" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisM(' . $idAvis . ',\'' . $adresseuser. '\')">';
                                echo '<img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            } else {
                                echo '<button type="button" class="appreciationButtonM" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisM(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            }
                        }
                        echo '<p id=nbAprr class="card-text">' . $av['nbAppr'] . ' appréciations </p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            $nbAvis++;
        }

        if ($nbAvis <= 3) {
            echo '<p style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600;">Il n\'y a pas plus d\'avis sur cette marque.</p>';
        }
        echo '</div>';
        echo "<div id='AllAvis' style='margin-bottom: 3%;'></div>";
        ?>
        <script type="text/javascript" src="../JavaScript/Avis.js"></script>
        <?php
    }

    public function AfficherpagevehAvis($Avis,$Npage,$idvehicule){

        $this->entetePage("Avis vehicule");
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

        $AvisController = new AvisController();
        $CaracteristiquesController = new CaracteristiquesController();
        $infoveh = $CaracteristiquesController->getInfovehicule($idvehicule);
        ?>
        <div style = "border : 1px solid black; width:75%;margin-left:10%; margin-top:4%; background-color:none;">
        <div style="margin-left:40%;margin-top :2%;margin-bottom:2%;">
            <h2> <?php echo $infoveh['ModeleVehicule']; ?> </h2>
        </div>
        <div class="col-md-10" style = "margin-left : 10%; margin-bottom:2%;">
            <img src="<?php echo $infoveh['ImageVehicule']; ?>" alt="Photo vehicule" class="img-fluid" style="width:290%; height : 60vh;">
        </div>
        <a href="../routers/Comparateur.php?id_vehicule=<?php echo $infoveh['idVehicule']; ?>" style="margin-left:72%;margin-top:1% !important;color:#8D6A9F; font-size:120%;"><b>Voir plus de détails ...</b></a>
    </div>
        <?php

        echo '<div class="container" style="margin-bottom:3%;">';
        echo '<h2 style="margin-left:16%;margin-top : 5%;margin-bottom:5%;">Découvrir les différents avis</h2>';
        $nbAvis = count($Avis); //nombre 
        $nombrePages = ceil($nbAvis / 5); // 5 avis par page

        $indiceDebut = ($Npage - 1) * 5;
        $avisAffiches = array_slice($Avis, $indiceDebut, 5); //garde que les avis that we will display
        if($avisAffiches){

            foreach($avisAffiches as $av){
                echo '<div class="card mb-2" style="max-width:70%; margin-left:15%;">';
                    echo '<div class="card-body">';
                        echo '<h6 class="card-title" style="color:#8D6A9F;">' . $av['NomUser'] . ' ' . $av['PrenomUser'] . ' : </h6>';
                        echo '<p class="card-text">' . $av['contenuAvis'] . '</p>';
                        echo '<div class="d-flex align-items-center">';
                        session_start();
                        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []) {
                            $idAvis = $av['idAvisVeh'];
                            $adresseuser = $_SESSION['adresse'];
                            $idVehicule = $av['idVehicule'];
                            $appr = $AvisController->getAppr($idAvis, $adresseuser);
                            if ($appr) {
                                echo '<button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisVeh(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            } else {
                                echo '<button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisVeh(' . $idAvis . ',\'' . $adresseuser . '\')">';
                                echo '<img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">';
                                echo '</button>';
                            }
                        }
                        echo '<p id=nbAprr class="card-text">' . $av['nbAppr'] . ' appréciations </p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            echo '<div class="pagination" style="margin-left:16%;">';
            for ($i = 1; $i <= $nombrePages; $i++) {
                echo '<a href="../routers/Avis.php?idvehicule=' . $av['idVehicule'] . '&Npage=' . $i . '" style="margin-right: 5px;color:#8D6A9F;" >' . $i . '</a>';
            }
            echo '</div>';
    
            echo '</div>';

        } else {
            echo '<p style="margin-left:16%; font-size:100%; color:#8D6A9F; font-weight:600;">Aucun avis sur ce véhicule</p>';
            echo '</div>';
        }
        $this->AffichPiedPage();
        ?>
        <script type="text/javascript" src="../JavaScript/Avis.js"></script>
        <?php

    }
    

}

?>