<?php

class LogoMarquesView{

    public function afficherLogosMarquesPrincipales($logosMarques){
        echo '<div class="d-flex flex-wrap justify-content-center" style="margin-left:5%; width:80%;height:40%;">';
        foreach ($logosMarques as $logoMarque) {
            ?>
            <a href="../routers/MarqueDetails.php?id_marque=<?= $logoMarque['idMarque']; ?>" class="btn btn-primary" style="background-color: #CAF0FF; border : none; margin-left: 10%; margin-top:5%;width:17%;height:13%;">
                <img src="<?= $logoMarque['ImageLogo']; ?>" alt="Afficher Details marque" width="150" height="90">
            </a>    
   <?php
        }
        echo '</div> ';
    }
}

?>