<?php

require_once('../View/Template.php');

class NewsView extends Template{

    public function NewsPage($news){
        foreach($news as $new){
            ?>
            <!-- <div style="display: inline-block; margin-right: 20px;">
                <h1 style="color: #333333;"><?php echo $new['TiteNews']; ?></h1>
                <img src="<?= $new['ImageNews']; ?>" alt="Image News" width="500" height="300">
            </div> -->
            <div class="row" style="margin-top: 3%; border: 1px solid black; width:75%; height:40vh; margin-left:10%;">
                <div class="row" style="margin-top:2%;">
                    <div class="col-md-5" style=" margin-left:2%;">
                    <!-- <div class="card mb-5"> -->
                        <img src ="<?= $new['ImageNews']; ?>" alt="Image News" style="margin-top:3%;width:100%;">
                    <!-- </div> -->
                    </div>
                    <div class="col-md-5" style ="margin-left:0%;margin-top:2%;">
                        <h1 class="card-title"><?php echo $new['TiteNews']; ?></h1>
                        <p><?php echo $new['ContenuNews']; ?></p>
                        <a href="../routers/News.php?idNews=<?php echo $new['idNews']; ?>">Lire plus</a>
                        <p><?php echo $new['DateNews']; ?></p>
                    </div> 
                </div>
            </div>
            <?php
        }
    }
        
    public function AfficherNewsPage($news){
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
        $this->NewsPage($news);
        $this->AffichPiedPage();
    }

}

?>