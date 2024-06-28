<?php

require_once('../Controller/DiaporamaController.php');
require_once('../Controller/MenuController.php');


class Template {

    public function entetePage($titrePage){
        ?>
           <!DOCTYPE html>
            <html lang="en">
            <head>
                <!-- meta, jQuery, bootstrap ... -->
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
                <link id ="style" rel="stylesheet" href="../code.css" type="text/css">
                <!-- l icone du site -- logo -->
                <!-- <link rel="shortcut icon" href="../Images/logo.svg" /> logo -- not yet -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <?php
            echo ' <title>'.$titrePage.'</title>';
        ?>
            </head>
            <body style="background-color: #CAF0F8;" > <!-- ou on elneve les cadres et on ajoute border-width: 5%;border-style: solid;border-color: #000; -->
            <div class="cadre-exterieur" style="border: 5px solid #333333; padding: 5%;">
            <div class="cadre-interieur" style=" margin: 0 auto; margin-bottom:2%;">
        <?php
        }


    public function AfficherLogo() {
        echo '<div style="display: inline-block; margin-left:-3%;width:50%; " >';
        echo '<div class="logo" style="display: inline-block; margin-top: -9%;margin-bottom:2%; background-color:none;">'; // margin-left: -8%; margin-top: -4%;
        echo '<img style="width :35%;height : 50%; margin-top:-10%" src="../Images/logoComCar.png" alt="Logo">';
        echo '</div>';
        echo '</div>';
    }
    
    public function afficherLoginButton() {
        ?>
        <a href="../routers/login.php">
             <button type="button" class="btn btn-primary" style="background-color: #8D6A9F; color: white; border-color: black; margin-left: 28%;margin-top:-5%;width:10%;height:7vh; ">Se connecter</button>
        </a>
        <?php
    }
    
    public function AfficherReseauxSociaux() {
        // echo '<div class="reseaux-sociaux" style="margin-left:80%; margin-top:-0%;">';
        // ouvrir les liens dans des nouvelles fenetres (_blank dans target)
        echo '<a href="https://www.facebook.com/profile.php?id=100056953916288&mibextid=kFxxJD" target="_blank" style="margin-left:17%;margin-top:7%;"><img src="../Images/facebook.png" alt="Facebook" style= "width: 40px; height: 40px; margin-left:70%;margin-top:-16%;"></a>'; 
        echo '<a href="https://www.instagram.com/imene_.bj/" target="_blank" ><img src="../Images/instagram.png" alt="Instagram" style= "width: 33px; height: 33px; margin-left:0.6%;margin-top:-16%;"></a>';
        echo '<a href="https://x.com/iimenebj?t=ZJjNsLhFprEdY520KOCUlQ&s=09" target="_blank"><img src="../Images/twitter_X.png" alt="X" style= "width: 30px; height: 27px; margin-left:1%;margin-top:-16%;"></a>';
        echo '<a href="https://www.linkedin.com/in/imene-boudjadi-34893120b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><img src="../Images/linkedin.png" alt="LinkedIn" style= "width: 30px; height: 30px;margin-left:1%;margin-top:-16%;"></a>';
        // echo '</div>';
    }

    public function AffichMenu(){
        $MenuController = new MenuController();
        $MenuController->AfficherMenu();
    }

    public function AffichDiapo(){
        $DiapoController = new DiaporamaController();
        $DiapoController->AfficherDiaporama();
    }

    public function AffichPiedPage(){
        $MenuController = new MenuController();
        $MenuController->AfficherPiedPage();
        echo '</div>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }

    public function profilButton(){
        ?>
        <a href="../routers/Profil.php">
            <button type="button" class="btn btn-primary" style="background-color: #8D6A9F; color: white; border-color: black; margin-left:20%; margin-top: -5%; width: 8%; height: 7vh;">Profil</button>
        </a>
        <?php
    }
  
    public function logoutButton(){
    //   echo '<button  disabled class="btn btn-outlined-light " style="margin-left:50%;">Bienvenu, '.$_SESSION['nom'].' '.$_SESSION['prenom'].'</button>';
      echo '<form method="post" action="../routers/Accueil.php">';
      echo '<button name="logout" value="logout" class="btn btn-outline-danger btn-sm" type="submit" style="margin-left: 77%;margin-top:-11.5%;width:8%;height:7vh;">déconnexion</Button>';
      echo '</form>';
      
    }

}

?>