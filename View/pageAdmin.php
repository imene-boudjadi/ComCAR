<?php 
class pageAdmin{

    public function entete_page($titrePage){
    ?>
      <!DOCTYPE html>
        <html lang="en">
        <head>
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
    <?php
    }

    public function menu(){
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
    }

    public function logoutButton(){
        //   echo '<button  disabled class="btn btn-outlined-light " style="margin-left:50%;">Bienvenu, '.$_SESSION['nom'].' '.$_SESSION['prenom'].'</button>';
          echo '<form method="post" action="../routers/Admin.php">';
          echo '<button name="logout" value="logout" class="btn btn-outline-danger btn-sm" type="submit" style="margin-left: 76%;margin-top:0%;width:8%;height:7vh; margin-right:3%;">déconnexion</Button>';
          echo '</form>';
          
        }




}

?>