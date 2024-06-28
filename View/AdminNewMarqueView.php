<?php

require_once('../View/pageAdmin.php');

class AdminNewMarqueView extends pageAdmin{

    public function Formulaire(){ 
        ?>
             <div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;margin-bottom:4%;"> Ajouter une marque </h1></div>
            <form action="../routers/AdminGestionVehicule.php" method="post" enctype="multipart/form-data">
    
            <div class="form-row justify-content-center">
                <div class="form-group col-2">
                <label for="inputNomMarque" ><b>Modele de la marque</b></label>
                <input type="text" name="nom" class="inputs form-control" id="inputNomMarque" required placeholder="Nom marque"> 
                </div>
                <div class="form-group col-2">
                    <label class="mr-sm-2" for="inputpays"><b>Pays d'origine</b></label>
                    <input type="text" name="pays" class="inputs form-control" id="inputpays" required  placeholder="pays origine"> 

                </div>
            </div>
            <div class="row form-row justify-content-center" style="margin-top:3%;">
                <div class="form-group col-2 " >
                    <label for="inputsiege" ><b>Siege Social</b></label>
                    <input type="text" name="siege" class="inputs form-control" id="inputsiege" required placeholder="Siege social"> 
                </div>
                <div class="form-group col-2 " >
                    <label for="inputannee" ><b>Année de Création</b></label>
                    <input type="text" name="annee" class="inputs form-control" id="inputannee" required pattern="^\d{4}$" placeholder="année création"> 
                </div>
            </div> 
            <div class="form-row justify-content-center">
                    <div class="form-group col-md-4" style="margin-left: 50%; margin-right: 50%;">
                        <label for="inputImage" class="col-12"><b>logo du marque</b></label>
                        <img class="col-12" id="img" style="max-width:200px; max-height:200px; margin-left:30%; margin-bottom:3%" ></img>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input type="file" name="image" class="inputs form-control" id="inImage" required placeholder="Logo marque">
                    </div>
                </div>
            </div>     
            <div class="justify-content-center">
                <button id="submitaddMarque" type="submit" name="addMarque"  class="btn btn-primary" value="Ajouter" style="width: 20%; margin-left: 40%;margin-top:3%;margin-bottom:3%;; background-color:#90E0EF; color:#333333;">Ajouter</button>
            </div>
        </form>
        <?php
        }    
    
        public function FormAddMarque(){
            $this->entete_page("Ajouter Marque");
            $this->menu();
            $this ->logoutButton();
            $this->Formulaire();
        }
}

?>