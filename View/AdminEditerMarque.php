<?php

require_once('../View/pageAdmin.php');

class AdminEditerMarque extends pageAdmin{

    public function FormulaireEditMarque($marque){
        echo '<div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;margin-bottom:4%;"> Modifier la marque: '.$marque['NomMarque']. '</h1></div>'
        ?>
     <form action="../routers/AdminGestionVehicule.php" method="post" enctype="multipart/form-data"> 

    <div class="form-row justify-content-center">
            <div class="form-group col-2">
            <label for="inputNomMarque" ><b>Modele de la marque</b></label>
            <?php
                echo '<input type="hidden" name="id_marque" class="form-control" id="id_Input" value= "'.$marque['idMarque'].'">';
                echo '<input type="text" name="nom" class="inputs form-control" id="inputNomMarque" required placeholder="Nom marque" value = "'.$marque['NomMarque'].'"> '
             ?>
            </div>
            <div class="form-group col-2">
                <label class="mr-sm-2" for="inputpays"><b>Pays d'origine</b></label>
             <?php
               echo '<input type="text" name="pays" class="inputs form-control" id="inputpays" required  placeholder="pays origine" value = "'.$marque['PaysOrigine'].'"> '
             ?>
            </div>
        </div>
        <div class="row form-row justify-content-center" style="margin-top:3%;">
            <div class="form-group col-2 " >
                <label for="inputsiege" ><b>Siege Social</b></label>
                   <?php
                 echo '<input type="text" name="siege" class="inputs form-control" id="inputsiege" required placeholder="Siege social" value = "'.$marque['SiegeSocial'].'">'
               ?>
           </div>
             <div class="form-group col-2 " >
               <label for="inputannee" ><b>Année de Création</b></label>
                <?php 
                echo '<input type="text" name="annee" class="inputs form-control" id="inputannee" required pattern="^\d{4}$" placeholder="année création" value = "'.$marque['AnneeCreation'].'">'
                 ?>
             </div>
        </div> 
        <div class="form-row justify-content-center">
                <div class="form-group col-md-4" style="margin-left: 50%; margin-right: 50%;">
                <?php
           
           echo '<label for="inputImage" class="col-12"><b>Logo du marque</b></label>';
           echo '<img class="col-12" id="img-view" src= "'.$marque['ImageLogo'].'" style="max-width:200px;max-height:200px;margin-left:30%;margin-bottom:3%"></img>';
           echo '<input type="hidden" class="form-control" id="imgInput" value= "'.$marque['ImageLogo'].'">';
           echo '<input type="file"  name="image" class="inputs form-control" id="inputImage" placeholder="logo marque">';
         ?>

                </div>
            </div>
        </div>     
        <div class="justify-content-center">
        <button id="submitEditMarque" type="submit" name="editMarq"  class="btn btn-primary mb-5" value="modifier" style="width: 30%; margin-left: 34%;margin-top:2%; background-color:#90E0EF; color:#333333;">Modifier</button>
        </div>
   </form>
   <?php
    }

    public function script(){ // pour ajouter une photo (logo)
        ?>
        <?php
    }

    public function FormEditMarque($marque){
        $this->entete_page("Modifier marque");
        $this->menu();
        $this ->logoutButton();
        $this->FormulaireEditMarque($marque);

    }
}

?>