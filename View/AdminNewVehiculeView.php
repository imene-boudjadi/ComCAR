<?php 

require_once('../View/pageAdmin.php');

class AdminNewVehiculeView extends pageAdmin{

    public function Formulaire($Marques){ 
    ?>
             <div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;margin-bottom:4%;"> Ajouter un vehicule </h1></div>
    <form action="../routers/AdminGestionVehicule.php" method="post" enctype="multipart/form-data">

        <div class="form-row justify-content-center">
            <div class="form-group col-2">
                <label for="inputmodele" ><b>Modele du vehicule</b></label>
                <input type="text" name="modele" class="inputs form-control" id="inputmodele" required placeholder="Modele vehicule"> 
            </div>
            <div class="form-group col-2">
                <label class="mr-sm-2" for="selectMarque"><b>Marque du véhicule</b></label>
                <select name="marque" class="inputs custom-select" id="selectMarque" required>
                    <?php foreach ($Marques as $marque) : ?>
                        <option value="<?php echo $marque['idMarque']; ?>"><?php echo $marque['NomMarque']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-2">
                    <label for="inputImage" class="mr-sm-2"><b>Image du véhicule</b></label>
                    <img class="col-12" id="img" style="max-width:200px; max-height:200px; margin-left:30%; margin-bottom:3%" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input style="margin-top:-11%;" type="file" name="image" id="InImage" class="inputs form-control" required placeholder="Image du véhicule">
                </div>
        </div>
        <div class="row form-row justify-content-center" style="margin-top:3%;">
            <div class="form-group col-2 " >
            <label for="inputMoteur" ><b>Moteur</b></label>
            <input type="text" name="moteur" class="inputs form-control" id="inputMoteur" required placeholder="Moteur"> 
            </div>
            <div class="form-group col-2 " >
            <label for="inputPerformance" ><b>Performance</b></label>
            <input type="text" name="performance" class="inputs form-control" id="inputPerformance" required placeholder="Performance"> 
            </div>
            <div class="form-group col-2 " >
            <label for="inputDimensions" ><b>Dimensions</b></label>
            <input type="text" name="dimensions" class="inputs form-control" id="inputDimensions" required placeholder="Dimensions"> 
            </div>
        </div>
        <div class="row form-row justify-content-center" style="margin-top:3%;">
            <div class="form-group col-2 " >
            <label for="inputPuissance" ><b>Puissance</b></label>
            <input type="text" name="puissance" class="inputs form-control" id="inputPuissance" required placeholder="Puissance"> 
            </div>
            <div class="form-group col-2 " >
            <label for="inputCapacite" ><b>Capacite</b></label>
            <input type="text" name="capacite" class="inputs form-control" id="inputCapacite" required placeholder="Capacite"> 
            </div>
            <div class="form-group col-2">
            <label class="mr-sm-2" for="inputConsommation"><b>Consommation</b></label>
            <input type="text" name="consommation" class="inputs form-control" id="inputConsommation" required placeholder="Consommation"> 
            </div>
        </div>
        <div class="row form-row justify-content-center" style="margin-top:3%;">
            <div class="form-group col-2">
            <label for="inputVersion" ><b>Version du Vehicule</b></label>    
            <input type="text" name="version" class="inputs form-control" id="inputVersion" required placeholder="Version vehicule"> 
            </div>
            <div class="form-group col-2">
            <label class="mr-sm-2" for="inputAnnee"><b>Année du vehicule</b></label>
            <input type="text" name="annee" class="inputs form-control" id="inputAnnee" required pattern="^\d{4}$" placeholder="Année vehicule">  <!-- pattern pour specifier que input est un chiffre de 4 -->
            </div>
            <div class="form-group col-2">
            <label class="mr-sm-2" for="inputTarif"><b>tarif</b></label>
            <input type="number" name="tarif" class="inputs form-control" id="inputTarif" required step="any" placeholder="tarif"> 
            </div>
         </div>

        <div class="justify-content-center">
            <button id="submitEdit" type="submit" name="add"  class="btn btn-primary" value="valider" style="width: 30%; margin-left: 34%;margin-top:3%;margin-bottom:3%;; background-color:#90E0EF; color:#333333;">Ajouter</button>
        </div>
    </form>
    <?php
    }  
    
    public function jsScript(){
    ?>
       <script>
        //  $("#inputImage").on("change", function () {
        //         readURL(this);
        //     });

        //     function readURL(input) {
        //         if (input.files && input.files[0]) {
        //             var reader = new FileReader();
        //             reader.onload = function (e) {
        //                 $('#img').attr('src', e.target.result);
        //             }
        //             reader.readAsDataURL(input.files[0]);
        //         }
        //     }
    //        $("#inputImage").on("change", function () {
    //             $("#img").attr("src", "../Images/"+$("#InImage").val().substring(12));
    //             $("#InImage").attr("value", "../Images/"+$("#InImage").val().substring(12));
    //         }); 
    </script> 
    <?php
    }

    public function FormAddVehicule($Marques){
        $this->entete_page("Ajouter Vehicule");
        $this->menu();
        $this ->logoutButton();
        $this->Formulaire($Marques);
        $this->jsScript();
    }
}

?>