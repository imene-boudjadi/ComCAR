<?php 

require_once('../View/pageAdmin.php');

class AdminVehiculeView extends pageAdmin{

    public function TableVeh($Vehicules){ 
            ?>
            <center>
            <div class="titreLog">
                <h1 style="margin-top: 0%;margin-left: 35%;color:#8D6A9F;">Gestion des vehicules</h1>
            </div>
            </center>
            <div class="d-flex justify-content-center">
            <div class="col-3  mt-5 " style ="margin-left:-15%;margin-bottom:2%;"> 
            <input class="form-control" id="rechercheVeh" type="text" placeholder="Rechercher un véhicule..." style ="border:1px solid black; margin-bottom:-6%;"> </div>
            <div class="form-group col-2">
            <form action="../routers/AdminGestionVehicule.php" method="GET">
            <input id="ajouter_vehicule"  type="submit"  name = "add_vehicule" value="Ajouter un vehicule "  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:30%;"/>
            </form>
    </div>
    <div class="form-group col-2">

            <form action="../routers/AdminGestionVehicule.php" method="GET">
            <input id="ajouter_marque"  type="submit"  name = "add_marque" value="Ajouter une marque"  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:30%;"/>
            </form>
            </div>
            <div class="form-group col-2">

    <form action="../routers/AdminGestionVehicule.php" method="GET">
    <input id="afficher_marques"  type="submit"  name = "afficheMarques" value="Afficher Tableau marques"  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:30%;"/>
    </form>
    </div>
    </div>
    </div>
    
            <div class="table-responsive-md">
             <table id="tableau-vehicule" class="table table-hover ">
            <thead class="">
              <tr>
                <th scope="col" class="text-center">Modèle</th>
                <th scope="col" class="text-center">Marque</th>
                <th scope="col" class="text-center" >Version</th>
                <th scope="col" class="text-center">Année</th>
                <th scope="col" class="text-center">les caractéristiques</th>  <!-- c'est un lien -->
              </tr>
            </thead>
            <tbody>
                <?php
                foreach ($Vehicules as $Vehicule){
                    echo '<tr>';
                    echo '<td class="text-center modele-vehicule" style="max-width: 70px;"><b>'.$Vehicule['ModeleVehicule'].'</b></td>';
                    echo '<td class="text-center marqueV" style="max-width: 150px;">'.$Vehicule['NomMarque'].'</td>';
                    echo '<td class="text-center" style="max-width: 70px;">'.$Vehicule['VersionVehicule'].'</td>';
                    echo '<td class="text-center" style="max-width: 70px;">'.$Vehicule['AnneeVehicule'].'</td>';
                    echo '<td class="text-center caracteristiques" style="max-width: 70px;">
                    <a href="../routers/AfficherCaracteristiques.php?id_vehicule=' . $Vehicule['idVehicule'] . '" style="color:#8D6A9F;">Afficher</a>
                    </td>';
                    echo '<td class="text-center" style="max-width: 70px;">
                    <form action="../routers/AdminGestionVehicule.php" method="GET">
                    <input type="hidden" class="id_vehicule" name="id_vehicule" value="' . $Vehicule['idVehicule'] . '" />
                    <input  type="submit" name = "submit" value="Modifier vehicule" class="btn btn-primary" style="background-color : #FFFF2E; color : black; border-color:#FFFF2E;margin-left:-80%"/>
                    </form>
                    </td>';
                    echo '<td class="text-center" style="max-width: 70px;">
                    <form action="../routers/AdminGestionVehicule.php" method="GET">
                    <input type="hidden" class="id_vehicule" name="id_vehicule" value="' . $Vehicule['idVehicule'] . '" />
                    <input  type="submit" name = "submit" value="Supprimer vehicule" class="btn btn-primary" style="background-color : red; color : white; border-color:red ;margin-left:-60%"/>
                    </form>
                    </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
          </table>
            </div>
            <script>
              $(document).ready(function(){ 
              $("#rechercheVeh").on("keyup", function() { 
                  var value = $(this).val().toLowerCase();
                  // console.log(value);
                  $("#tableau-vehicule tr").each(function() {
                      var nomUser = $(this).find(".modele-vehicule").eq(0).text().toLowerCase();
                      var comment = $(this).find(".marqueV").eq(0).text().toLowerCase();
                      var rechInp = nomUser.indexOf(value) > -1 || comment.indexOf(value) > -1;
                      $(this).toggle(rechInp);
                  });
              });
          });
              </script>
            <?php
        }

    public function afficherVehicules($Vehicules){
        $this->entete_page("Gestion Vehicule");
        $this->menu();
        $this ->logoutButton();
        $this->TableVeh($Vehicules);
    }
}


?>