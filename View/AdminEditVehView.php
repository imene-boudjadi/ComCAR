<?php 

require_once('../View/pageAdmin.php');

class AdminEditVehView extends pageAdmin{

    public function FormulaireEditVeh($Vehicule,$marques){ 
        echo '<div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;margin-bottom:4%;"> Modifier le vehicule : '.$Vehicule['ModeleVehicule'].'</h1></div>'
            ?>
            
    <form action="../routers/AdminGestionVehicule.php" method="post">
    
    <div class="row form-row justify-content-center" style="margin-top:3%;">
    <div class="form-group col-2">
          <label for="inputModele" ><b>Modele du vehicule</b></label>
          <?php
              echo '<input type="hidden"   name="id_vehicule" class="form-control" id="id_Input" value= "'.$Vehicule['idVehicule'].'">';
              echo '<input required type="text" name="modele" class="inputs form-control" id="inputModele" placeholder="Modele vehicule" value = "'.$Vehicule['ModeleVehicule'].'">';
          ?>
          
        </div>
        <div class="form-group col-2">
            <label class="mr-sm-2" for="selectMarque"><b>Marque du véhicule</b></label>
            <select name="marque" class="inputs custom-select" id="selectMarque" required>
                <?php
                    foreach ($marques as $marque) {
                        $selected = ($marque['idMarque'] == $Vehicule['CodeMarque']) ? 'selected' : '';
                        echo '<option value="'.$marque['idMarque'].'" '.$selected.'>'.$marque['NomMarque'].'</option>';
                    }
                ?>
            </select>
        </div>
      </div>
    <div class="row form-row justify-content-center" style="margin-top:3%;">
        <div class="form-group col-2">
            <?php
            
                // echo '<label for="inputImage" class="col-12"><b>Image</b></label>';
                // echo '<img class="col-12" id="img-view" src= "'.$Vehicule['ImageVehicule'].'" style="max-width:200px;max-height:200px;margin-left:30%;margin-bottom:3%"></img>';
                // echo '<input type="hidden"   class="form-control" id="imgInput" value= "'.$Vehicule['ImageVehicule'].'">';
                // echo '<input type="file"  name="image" class="inputs form-control" id="inputImage" value= "'.$Vehicule['ImageVehicule'].'" placeholder="image"">';
                echo '<label for="inputImage" class="col-12"><b>Image du vehicule</b></label>';
                echo '<img class="col-12" id="img-view" src= "'.$Vehicule['ImageVehicule'].'" style="max-width:200px;max-height:200px;margin-left:30%;margin-bottom:3%"></img>';
                echo '<input type="hidden" class="form-control" id="imgInput" value= "'.$Vehicule['ImageVehicule'].'">';
                echo '<input name="image"  type="file"  class="inputs form-control" id="inputImage" placeholder="Image vehicule">';
            ?>
        </div>
    </div>
    <div class="row form-row justify-content-center" style="margin-top:3%;">
    <div class="form-group col-2">
    <?php
        echo '<label class="mr-sm-2" for="inputMoteur"><b>Moteur</b></label>';
        echo '<input type="text" name="moteur" class="inputs form-control" id="inputMoteur" required step="any" placeholder="Moteur" value="'.$Vehicule['Moteur'].'">';
    ?>
</div>
    <div class="form-group col-2">
        <?php
            echo '<label for="inputPerformance" ><b>Performance</b></label>';
            echo '<input type="text" name="performance" class="inputs form-control" id="inputPerformance" required placeholder="Performance" value="'.$Vehicule['Performance'].'">';
        ?>
    </div>
    <div class="form-group col-2">
        <?php
            echo '<label for="inputDimensions" ><b>Dimensions</b></label>';
            echo '<input type="text" name="dimensions" class="inputs form-control" id="inputDimensions" required placeholder="Dimensions" value="'.$Vehicule['Dimensions'].'">';
        ?>
    </div>
</div>
<div class="row form-row justify-content-center" style="margin-top:3%;">
<div class="form-group col-2">
        <?php
            echo '<label for="inputPuissance" ><b>Puissance</b></label>';
            echo '<input type="text" name="puissance" class="inputs form-control" id="inputPuissance" required placeholder="Puissance" value="'.$Vehicule['Puissance'].'">';
        ?>
    </div>
<div class="form-group col-2">
        <?php
            echo '<label for="inputCapacite" ><b>Capacite</b></label>';
            echo '<input type="text" name="capacite" class="inputs form-control" id="inputCapacite" required placeholder="Capacite" value="'.$Vehicule['Capacite'].'">';
        ?>
</div>
<div class="form-group col-2">
    <?php
        echo '<label class="mr-sm-2" for="inputConsommation"><b>Consommation</b></label>';
        echo '<input type="text" name="consommation" class="inputs form-control" id="inputConsommation" required placeholder="Consommation" value="'.$Vehicule['Consommation'].'">';
    ?>
</div>



 </div>

<div class="row form-row justify-content-center" style="margin-top:3%;">
<div class="form-group col-2">
        <?php
            echo '<label for="inputVersion" ><b>Version du vehicule</b></label>';
            echo '<input type="text" name="version" class="inputs form-control" id="inputVersion" required placeholder="Version" value="'.$Vehicule['VersionVehicule'].'">';
        ?>
    </div>
    <div class="form-group col-2">
        <?php
            echo '<label for="inputAnnee" ><b>Année du vehicule</b></label>';
            echo '<input type="text" name="annee" class="inputs form-control" id="inputAnnee" required placeholder="Année" value="'.$Vehicule['AnneeVehicule'].'">';
        ?>
    </div>
    <div class="form-group col-2">
    <?php
        echo '<label class="mr-sm-2" for="inputTarif"><b>Tarif</b></label>';
        echo '<input type="number" name="tarif" class="inputs form-control" id="inputTarif" required step="any" placeholder="Tarif" value="'.$Vehicule['tarif'].'">';
    ?>
</div></div>
       <div class="justify-content-center">
       <button id="submitEdit" type="submit" name="edit"  class="btn btn-primary mb-5" value="editer" style="width: 30%; margin-left: 34%;margin-top:2%; background-color:#90E0EF; color:#333333;">Modifier</button>
       </div>
      
    </form>
            <?php
    }    
    
 
     

    public function FormEditVeh($Vehicule,$marques){
        $this->entete_page("Modifier vehicule");
        $this->menu();
        $this ->logoutButton();
        $this->FormulaireEditVeh($Vehicule,$marques);

    }
    
}

?>

