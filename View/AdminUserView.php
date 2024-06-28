<?php 


require_once '../View/pageAdmin.php';

class AdminUserView extends pageAdmin{
    public function TabUsers($users){
        ?>
        <center>
        <div class="titreLog">
            <h1 style="margin-top: 3%;margin-left: 35%; margin-bottom:4%;color:#8D6A9F;">Gestion des utilisateurs</h1>
        </div>
        </center>

        <div class="table-responsive-md">
         <div class ="row">
            <div class="col-3  mt-5 " style ="margin-left:5%;margin-bottom:2%;"> <!-- mrgin top 5 -->
            <input class="form-control" id="rechercheUserInp" type="text" placeholder="Rechercher un utilisateur..." style ="border:1px solid black;"> </div>
        
            <div class="col-3  mt-5" style ="margin-left:2%;margin-bottom:2%;">
            <p> <b>Trier les utilisateurs par :</b></p>
            </div>
            <div class="col-3  mt-5" style ="margin-left:-10%;margin-bottom:2%;">
            <input id="etatCompte-filtre"  type="submit"  name = "submit" value="Etat du compte"  class="btn btn-primary filtres mr-4" style="background-color:#8D6A9F; border: 0.1px solid black;"/>
            <!-- <input id="InscrEtat-filtre"  type="submit"  name = "submit" value="Etat de l'inscription"  class="btn btn-primary filtres" style="background-color:#8D6A9F; border: 0.1px solid black;"/> -->
            </div>
        </div>
    </div>

         <table id="tableau-user" class="table table-hover dataTable">
        <thead class=""> 
          <tr>
            <th scope="col" class="text-center">Nom</th>
            <th scope="col" class="text-center">Prenom</th>
            <th scope="col" class="text-center" >username</th>
            <th scope="col" class="text-center">Adresse mail</th>
            <th scope="col" class="text-center">Etat du compte </th>  <!-- actif ou bloque-->
            <th scope="col" class="text-center" class="text-center filtres" colspan ="2">Etat de l'inscription </th>   <!-- validé ou pas encore -->
            <th scope="col" class="text-center" colspan="3"> La Gestion </th> 
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user){
                echo '<tr>';
                echo '<td class="text-center nom-user" style="max-width: 70px;"><b>'.$user['NomUser'].'</b></td>';
                echo '<td class="text-center" style="max-width: 150px;">'.$user['PrenomUser'].'</td>';
                echo '<td class="text-center" style="max-width: 70px;">'.$user['username'].'</td>';
                echo '<td class="text-center" style="max-width: 70px;">'.$user['Adresse_mail'].'</td>';
                echo '<td class="text-center" id="etatCompte" style="max-width: 70px;">'.$user['EtatCompte'].'</td>';
                if ($user['InscValide']== 1) { ?>
                <td class="text-center" style="max-width: 1px; padding-right: 2px;">validée</td>
                <td class="text-center" style="max-width: 2px;">
                <img src="../Icons/check-5.png" style="width: 20%; height: 6vh;" alt="inscription valide"></td>
             <?php 
            } else { ?>
                <td class="text-center" style="max-width: 1px; padding-right: 5px;" id = "nonvalideEtat">Non validée</td>
                <td class="text-center" style="max-width: 2px;">
                <button class="validbutt" data-user-id="<?php echo $user['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding:0;" onclick="ValiderInsc('<?php echo $user['idUser']; ?>')">
                        <img src="../Icons/check-3.png" style="width: 20%; height: 6vh;" alt="valider inscr">
                </button></td>
            <?php 
            }     
                       
                ?>
               <td class="text-center" style="max-width: 6px;">
                    <a href="../routers/AfficherProfilFromAdmin.php?idUser=<?php echo $user['idUser']; ?>">
                        <img src="../Icons/user.png" style="width: 70%; height: 4vh;" alt="Accéder au Profil">
                    </a>
                </td>
                <td class="text-center" style="max-width: 6px;">

                <?php if ($user['EtatCompte'] == "bloque") { ?>
                    <button class="blockbutt" data-user-id="<?php echo $user['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Debloquer('<?php echo $user['idUser']; ?>')">
                    <!-- data-user-id i will use it pour changer licone  -- pour connaitre quel icone cuz boucle  -->
                        <img src="../Icons/blocked-2.png" style="width: 70%; height: 4vh;" alt="debloquer user">
                    </button>
                <?php } else { ?>
                    <button class="blockbutt" data-user-id="<?php echo $user['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Bloquer('<?php echo $user['idUser']; ?>')">
                        <img src="../Icons/blocked.png" style="width: 70%; height: 4vh;" alt="bloquer user">
                    </button>
                <?php } ?>
                </td>
                <td class="text-center" style="max-width: 6px;">
                    <a href="../routers/AdminGestionUser.php?idUserSuppr=<?php echo $user['idUser']; ?>">
                        <img src="../Icons/delete.png" style="width: 70%; height: 4vh;" alt="supprimer user">
                    </a>
                </td>
               
                </tr>
               <?php 
            }
            ?>
        </tbody>
      </table>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>

        <script type="text/javascript" src="../JavaScript/users.js"></script>

        <script>
    $(document).ready(function() {
        $('#tableau-user').DataTable({
            "paging": true, 
            "ordering": true, 
            "searching": true 
        });
    });
</script>

        <?php
    }

    public function AfficherTabUsers($users){
        $this->entete_page("Gestion utilisateurs");
        $this->menu();
        $this ->logoutButton();
        $this->TabUsers($users);

    }

}

?>