<?php

require_once '../View/pageAdmin.php';

class AdminAvisView extends pageAdmin{

    public function TabAvis($Avis){
        ?>
        <center>
        <div class="titreLog">
            <h1 style="margin-top: 3%;margin-left: 35%; margin-bottom:4%; color:#8D6A9F;">Gestion des Avis</h1>
        </div>
        </center>

        <div class="table-responsive-md">
        <div class="col-3  mt-5 " style ="margin-left:5%;margin-bottom:2%;"> <!-- mrgin top 5 -->
        <input class="form-control" id="rechercheAvisInp" type="text" placeholder="Rechercher un avis ou un utilisateur..." style ="border:1px solid black;"> </div>
        <form action="../routers/AdminAvisGestion.php" method="GET">
            <input id="afficher_marques"  type="submit"  name = "afficheMarques" value="Afficher Avis marques"  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:-9%;margin-left:35%;"/>
        </form>
         <table id="tableau-avis" class="table table-hover dataTable">
        <thead class=""> 
          <tr>
            <th scope="col" class="text-center">Utilisateur</th>
            <th scope="col" class="text-center">Véhicule</th>
            <th scope="col" class="text-center" >Commentaire</th>
            <th scope="col" class="text-center" colspan="3">Status</th>
            <th scope="col" class="text-center" colspan="2"> La Gestion </th> 
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($Avis as $Av){
                echo '<tr>';
                echo '<td class="text-center nom-user" style="max-width: 70px;"><b>'.$Av['NomUser'].' '.$Av['PrenomUser'].'</b></td>';
                echo '<td class="text-center" style="max-width: 150px;">'.$Av['ModeleVehicule'].'</td>';
                echo '<td class="text-center commentaire" style="max-width: 150px;">'.$Av['contenuAvis'].'</td>';
                if($Av['AvisValide']==1){
                    echo '<td class="text-center" id = "valide" style="max-width: 50px;">Validé</td>';
                    echo'<td style="max-width: 50px;"><img src="../Icons/check-5.png" style="width: 35%; height: 4vh;" alt="inscription valide"></td>';
                    echo '<td></td>';
                }else{
                    echo '<td class="text-center" id = "nonvalide" style="max-width: 15px;">Non validé</td>';
                    echo '<td><button class="validerComm" data-avis-id="' . $Av['idAvisVeh'] . '" style="background:none; border: none; cursor: pointer;padding:0; max-width: 15px" onclick="ValiderAv(\''. $Av['idAvisVeh'] .'\')">
                        <img src="../Icons/check-3.png" style="width: 200%; height: 4vh;" alt="valider avis">
                    </button></td>';?>
                    <td style="max-width: 30px;">
                    <button class="RefuserComm" data-avis-id="<?php echo $Av['idAvisVeh']; ?>" style="background: none; border: none; cursor: pointer; padding: 0; max-width: 70px;" onclick="goTo('<?php echo $Av['idAvisVeh']; ?>')">

                        <img src="../Icons/close.png" style="width: 30%; height: 4vh;" alt="refuser avis">
                    </a></td>
               <?php  }
                ?>
               
                
                <td class="text-center" style="max-width: 6px;">

                <?php if ($Av['EtatCompte'] == "bloque") { ?>
                    <button class="blockbutt" data-user-id="<?php echo $Av['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Debloquer('<?php echo $Av['idUser']; ?>')">
                        <img src="../Icons/blocked-2.png" style="width: 35%; height: 4vh;" alt="debloquer user">
                    </button>
                <?php } else { ?>
                    <button class="blockbutt" data-user-id="<?php echo $Av['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Bloquer('<?php echo $Av['idUser']; ?>')">
                        <img src="../Icons/blocked.png" style="width: 35%; height: 4vh;" alt="bloquer user">
                    </button>
                <?php } ?>
                </td>
                <td class="text-center" style="max-width: 6px;">
                    <a href="../routers/AfficherProfilFromAdmin.php?idUser=<?php echo $Av['idUser']; ?>">
                        <img src="../Icons/user.png" style="width: 30%; height: 4vh;" alt="Accéder au Profil">
                    </a>
                </td>
                </tr>
               <?php 
               
            }
            ?>
        </tbody>
      </table>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script type="text/javascript" src="../JavaScript/AdminAvis.js"></script>
        <script type="text/javascript" src="../JavaScript/users.js"></script>
        <script>
            function goTo(idAvis) {
                window.location.href = '../routers/AdminAvisGestion.php?idAvis=' + idAvis;
            }
        </script>



        <?php
    }

    public function AffichTableAvisVeh($Avis){
        $this->entete_page("Gestion Avis");
        $this->menu();
        $this ->logoutButton();
        $this->TabAvis($Avis);
    }

    public function AffichTableAvisMarque($Avis){
        $this->entete_page("Gestion Avis");
        $this->menu();
        $this ->logoutButton();
        ?>
        <center>
        <div class="titreLog">
            <h1 style="margin-top: 3%;margin-left: 35%; margin-bottom:4%; color:#8D6A9F;">Gestion des Avis</h1>
        </div>
        </center>

        <div class="table-responsive-md">
        <div class="col-3  mt-5 " style ="margin-left:5%;margin-bottom:2%;"> <!-- mrgin top 5 -->
        <input class="form-control" id="rechercheAvisInp" type="text" placeholder="Rechercher un avis ou un utilisateur..." style ="border:1px solid black;"> </div>
        <form action="../routers/AdminAvisGestion.php">
            <input id="afficher_marques"  type="submit"  name = "afficheVeh" value="Afficher Avis Véhicules"  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:-9%;margin-left:35%;"/>
        </form>
         <table id="tableau-avis" class="table table-hover dataTable">
        <thead class=""> 
          <tr>
            <th scope="col" class="text-center">Utilisateur</th>
            <th scope="col" class="text-center">Marque</th>
            <th scope="col" class="text-center" >Commentaire</th>
            <th scope="col" class="text-center" colspan="3">Status</th>
            <th scope="col" class="text-center" colspan="2"> La Gestion </th> 
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($Avis as $Av){
                echo '<tr>';
                echo '<td class="text-center nom-user" style="max-width: 70px;"><b>'.$Av['NomUser'].' '.$Av['PrenomUser'].'</b></td>';
                echo '<td class="text-center" style="max-width: 150px;">'.$Av['NomMarque'].'</td>';
                echo '<td class="text-center commentaire" style="max-width: 150px;">'.$Av['commentaire'].'</td>';
                if($Av['AvisValidee']==1){
                    echo '<td class="text-center" id = "valide" style="max-width: 50px;">Validé</td>';
                    echo'<td style="max-width: 50px;"><img src="../Icons/check-5.png" style="width: 35%; height: 4vh;" alt="inscription valide"></td>';
                    echo '<td></td>';
                }else{
                    echo '<td class="text-center" id = "nonvalide" style="max-width: 50px;">Non validé</td>';
                    echo '<td><button class="validerCommM" data-avis-id="' . $Av['idAvisMarque'] . '" style="background:none; border: none; cursor: pointer;padding:0; max-width: 15px" onclick="ValiderAvM(\''. $Av['idAvisMarque'] .'\')">
                        <img src="../Icons/check-3.png" style="width: 200%; height: 4vh;" alt="valider avis">
                    </button></td>';?>
                    <td style="max-width: 40px;">
                    <button class="RefuserCommM" data-avis-id="<?php echo $Av['idAvisMarque']; ?>" style="background: none; border: none; cursor: pointer; padding: 0; max-width: 70px;" onclick="goToM('<?php echo $Av['idAvisMarque']; ?>')">
                        <img src="../Icons/close.png" style="width: 30%; height: 4vh;" alt="refuser avis">
                    </a></td>
               <?php  }
                ?>
               
                
                <td class="text-center" style="max-width: 6px;">

                <?php if ($Av['EtatCompte'] == "bloque") { ?>
                    <button class="blockbutt" data-user-id="<?php echo $Av['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Debloquer('<?php echo $Av['idUser']; ?>')">
                        <img src="../Icons/blocked-2.png" style="width: 35%; height: 4vh;" alt="debloquer user">
                    </button>
                <?php } else { ?>
                    <button class="blockbutt" data-user-id="<?php echo $Av['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Bloquer('<?php echo $Av['idUser']; ?>')">
                        <img src="../Icons/blocked.png" style="width: 35%; height: 4vh;" alt="bloquer user">
                    </button>
                <?php } ?>
                </td>
                <td class="text-center" style="max-width: 6px;">
                    <a href="../routers/AfficherProfilFromAdmin.php?idUser=<?php echo $Av['idUser']; ?>">
                        <img src="../Icons/user.png" style="width: 30%; height: 4vh;" alt="Accéder au Profil">
                    </a>
                </td>
                </tr>
               <?php 
               
            }
            ?>
        </tbody>
      </table>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script type="text/javascript" src="../JavaScript/AdminAvis.js"></script>
        <script type="text/javascript" src="../JavaScript/users.js"></script>
        <script>
            function goToM(idAvis) {
                window.location.href = '../routers/AdminAvisGestion.php?idAvisM=' + idAvis;
            }
        </script>


        <?php
        
    }

}

?>