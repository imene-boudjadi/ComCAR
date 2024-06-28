<?php

require_once('../View/Template.php');

class DetailsNewsView extends Template{
    public function DetailsNews($Detailsnews){
        if (!empty($Detailsnews)) {
            $PremiereDetailNews = reset($Detailsnews);
        }
        ?>    
        <h1 class="mt-5 text-center display-4;" style="margin-top:2%;margin-left:-5%; color:#8D6A9F"><?php echo $PremiereDetailNews['TiteNews']; ?></h1>
        <div class="row" style="margin-top: 3%; border: 1px solid black; width:75%; margin-left:10%;">
        <div class="row" style="margin-top:2%; margin-bottom:1%;">
        <?php 
        foreach($Detailsnews as $Detailnews){
            ?>
                    <div class="col-md-5" style=" margin-left:2%;">
                        <img src ="<?= $Detailnews['ImageDetailsNews']; ?>" alt="Image News" style="margin-top:3%;width:100%;">
                    </div>
                    <div class="col-md-5" style ="margin-left:0%;margin-top:2%;">
                        <p><?php echo $Detailnews['ParagrapheNews']; ?></p>
                    </div> 
            <?php
        }

    ?> 
            <p style ="margin-top:2%;margin-left:70%;"><?php echo $Detailnews['DateNews']; ?></p>
            </div>
        </div> 
    <?php 
    }

    public function AfficherDetailsNews($Detailsnews){
        $this->entetePage("News");
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
        $this->DetailsNews($Detailsnews);
        $this->AffichPiedPage();
    }
}

?>