<?php

require_once('../View/pageAdmin.php');

class AdminMarqueView extends pageAdmin{

    public function TabMarques($Marques){ 
        ?>
        <center>
        <div class="titreLog">
            <h1 style="margin-top: 3%;margin-left: 35%;">Tableau des marques</h1>
        </div>
        </center>
        <div class="d-flex justify-content-center">
        <div class="col-3  mt-5 " style ="margin-left:-15%;margin-bottom:2%;"> 
            <input class="form-control" id="rechercheM" type="text" placeholder="Rechercher une marque..." style ="border:1px solid black; margin-bottom:-6%;"> </div>
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
                <input id="afficher_vehicule"  type="submit"  name = "afficher_vehicule" value="Afficher Tableau vehicules "  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:30%;"/>
                </form>
            </div>
        </div>

        <div class="table-responsive-md">
         <table id="tableau-vehicule" class="table table-hover ">
        <thead class="">
          <tr>
            <th scope="col" class="text-center">Nom Marque</th>
            <th scope="col" class="text-center">Pays d'origine</th>
            <th scope="col" class="text-center" >Siege Social</th>
            <th scope="col" class="text-center">Année de Creation</th>
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($Marques as $Marque){
                echo '<tr>';
                echo '<td class="text-center nom-marque" style="max-width: 70px;"><b>'.$Marque['NomMarque'].'</b></td>';
                echo '<td class="text-center pays" style="max-width: 150px;">'.$Marque['PaysOrigine'].'</td>';
                echo '<td class="text-center" style="max-width: 70px;">'.$Marque['SiegeSocial'].'</td>';
                echo '<td class="text-center" style="max-width: 70px;">'.$Marque['AnneeCreation'].'</td>';
                echo '<td class="text-center" style="max-width: 70px;">
                <form action="../routers/AdminGestionVehicule.php" method="GET">
                    <input type="hidden" class="id_marque" name="id_marque" value="' . $Marque['idMarque'] . '" />
                    <input type="submit" name="submit" value="Modifier_marque" class="btn btn-primary" style="background-color: #FFFF2E; color: black; border-color: #FFFF2E; margin-left: -90%;" />
                </form>
            </td>';
                echo '<td class="text-center" style="max-width: 70px;">
                <form action="../routers/AdminGestionVehicule.php" method="GET">
                    <input type="hidden" name="id_marque" value="' . $Marque['idMarque'] . '"> 
                    <input type="submit" name="submit" value="Supprimer_marque" class="btn btn-primary" style="background-color: red; color: white; border-color: red; margin-left: -60%;" />
                </form>
                </td>';

            }
            ?>
        </tbody>
      </table>
        </div>
        <script>
              $(document).ready(function(){ 
              $("#rechercheM").on("keyup", function() { 
                  var value = $(this).val().toLowerCase();
                  // console.log(value);
                  $("#tableau-vehicule tr").each(function() {
                      var nomUser = $(this).find(".nom-marque").eq(0).text().toLowerCase();
                      var comment = $(this).find(".pays").eq(0).text().toLowerCase();
                      var rechInp = nomUser.indexOf(value) > -1 || comment.indexOf(value) > -1;
                      $(this).toggle(rechInp);
                  });
              });
          });
              </script>
        <?php
    }

    public function afficherAllMarques($Marques){
        $this->entete_page("tableau marques");
        $this->menu();
        $this ->logoutButton();
        $this->TabMarques($Marques);

    }

    
    
}

?>