<?php

require_once('../View/Template.php');
require_once('../Controller/MarquesController.php');
require_once('../Controller/CaracteristiquesController.php'); 
require_once('../Controller/AvisController.php');

class MarqueInfosView extends Template{
    public function affichInfosMarques($infosMarque){
        $MarquesController= new MarquesController();
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-9" style="margin-left:-5%;">
                    <div class="card" style="background-color:#CAF0F8;">
                        <div class="card-header" style="background-color:#90E0EF;">
                            <h2 style="text-align: center;">Marque : <?php echo $infosMarque['NomMarque']; ?></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php
                                       echo '<img src="' . $infosMarque['ImageLogo'] . '" alt="Logo marque" class="img-fluid" style="width:150%; height : 70%;margin-top:13%;">';
                                    ?>
                                </div>
                                <div class="col-md-8"> <!-- thts mean taille de 8 colonnes a peu pres -->
                                   <?php if ($infosMarque) : ?>
                                        <ul class="list-group">
                                            <li class="list-group-item"><b>Nom:</b> <?php echo $infosMarque['NomMarque']; ?></li>
                                            <li class="list-group-item"><b>Pays d'origine:</b> <?php echo $infosMarque['PaysOrigine']; ?></li>
                                            <li class="list-group-item"><b>Siege Social:</b> <?php echo $infosMarque['SiegeSocial']; ?></li>
                                            <li class="list-group-item"><b>Année de creation:</b> <?php echo $infosMarque['AnneeCreation']; ?></li>
                                            <li class="list-group-item"><b>Note moyenne:</b> <?php 
                                            $note=$MarquesController->getNoteM($infosMarque['idMarque']);
                                            echo $note; 
                                            echo "/5";
                                            ?></li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function affichVehprinc($vehicules,$AvisPage){
        if ($vehicules){
            echo '<h2 style=" display: flex; ;align-items: center; justify-content: center; margin-top:3%;margin-left:-3%;">Les principales vehicules de la marque</h2>';
            // echo '<div style="background-color: #EEEEEE; max-width : 65%; margin-left:15%; border : 1px solid black; margin-top:2%;">';
            // echo '<ul style="">'; 
            // foreach ($vehicules as $vehicule) {
                ?>
            <!-- //     <li class="container mt-4" style="margin-bottom: 3%;">
            //         <a href="../routers/Comparateur.php?id_vehicule=< ?= $vehicule['idVehicule']; ?>" style="color:#333333;"> < ?= $vehicule['ModeleVehicule']; ?></a>
            // </li>                -->
                <?php
            // } 
            // echo '</ul>'; 
            // echo '</div>';  
                echo '<div class="d-flex flex-wrap justify-content-center" style="margin-left:0%;margin-top:-5%; width:80%;height:40%;">';
                foreach ($vehicules as $vehicule) {
                    if ($AvisPage=="false"){ // on est dans la page marque
                    ?>
                    <a href="../routers/Comparateur.php?id_vehicule=<?= $vehicule['idVehicule']; ?>" class="btn btn-primary" style="background-color: #CAF0FF; border : none; margin-left: 15%; margin-top:10%;width:35%;">
                        <img src="<?= $vehicule['ImageVehicule']; ?>" alt="vehicule" width="230" height="150" style="margin-left:0%;">
                        
                        <h4 style="color:#333333; margin-top:3%;"><?php echo $vehicule['ModeleVehicule']; ?></h4>
                    </a>    
                <?php 
            }else{  //page avis
                ?>
                    <a href="../routers/Avis.php?id_vehicule=<?= $vehicule['idVehicule']; ?>" class="btn btn-primary" style="background-color: #CAF0FF; border : none; margin-left: 15%; margin-top:10%;width:35%;">
                        <img src="<?= $vehicule['ImageVehicule']; ?>" alt="vehicule" width="230" height="150" style="margin-left:0%;">
                        
                        <h4 style="color:#333333; margin-top:3%;"><?php echo $vehicule['ModeleVehicule']; ?></h4>
                    </a> 
                <?php
                }
                }
                echo '</div> ';
                echo '<h2 style="display: flex; align-items: center; justify-content: center; margin-top: 3%; margin-bottom: 3%;margin-left: -3%;">Consulter les détails des véhicules de cette marque</h2>';
        }
    }
    

    public function afficherInfosMarques($infosMarque){
        $this->entetePage("Infos Marque");
        $this->AfficherLogo();
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){
            $this->profilButton();
            $this->logoutButton();
        }
        else{
            $this->afficherLoginButton();
        }
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        $this->affichInfosMarques($infosMarque);
        $AvisController = new AvisController();
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []){

            $note = $AvisController->getNoteMbyuser($infosMarque['idMarque'], $_SESSION['adresse']);
        if ($note) {
            echo '<div class="card mb-5 mt-3" id="noteCont" style="max-width:60%; margin-left:20%;">';
            echo '<div class="card-body">';
            echo '<h6 class="card-title" style="color:#8D6A9F;">Votre note :</h6>';
            echo '<p class="card-text"><b>' . $note['NoteMarque'] . ' /5</b></p>';
            echo '</div>';
            echo '</div>';
        } else {
            ?><div class="card mb-5 mt-3"  id="noteCont" style="max-width:60%; margin-left:18%;">
            <div class="card-body">
            <h6 class="card-title" style="color:#8D6A9F;">Donnez une note à la marque :</h6>
            <select  id="note" style="width:10%; height:14vh;" > 
            <option value="" selected disabled>Note</option>
            <?php
                for ($i = 1; $i <= 5; $i+=0.5) { //la note entre 1 et 5 
                    echo "<option value='$i'>$i</option>";
                }?>
            </select>
            <button type="button" class="btn btn-primary" style="width: 18%; background-color: #90E0EF; color: #333333; border: 0.1px solid black;" onclick="ajouterNoteM('<?php echo addslashes($_SESSION['adresse']); ?>', '<?php echo addslashes($infosMarque['idMarque']); ?>', document.getElementById('note').value)">Ajouter note</button>
            </div>
            </div>
        <?php }
    }
        $AvisController->FindTop3AvisMarque($infosMarque['idMarque']);
        $this->AffichPiedPage();
?>
        <script>

        function ajouterNoteM(adresseuser, idmarque, note) {
            if (note === "") {
                alert("Veuillez choisir une note d'abord");
                return;
            }

            $.ajax({
                url: '../Ajax/Avis.php',
                type: 'POST',
                data: {
                    AdresseAddNoteM: adresseuser,
                    MarqueeAddnote: idmarque,
                    noteM: note
                },
                beforeSend: function () {
                    console.log("Add note M");
                    console.log($('#noteCont').html());
                },
                success: function (response) {
                    console.log("response:", response);
                    if (response) {
                        var apresaddNote = "<div class='card mb-5' id='noteCont' style='max-width:60%; margin-left:20%;'><div class='card-body'><h6 class='card-title' style='color:#8D6A9F;'>Votre note :</h6><p class='card-text'><b>" + note + "/5</b></p></div></div>";
                        $('#noteCont').html(apresaddNote);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
                }
            });
        }
        </script>
        <?php
    }

    public function ListeVehbyMarque($vehicules,$AvisPage){
        if ($vehicules){
            ?>
            <!-- <div style="max-width: 65%; margin-left: 15%; margin-top: 2%;"> -->
            <div style="max-width: 65%; margin-left: 15%; margin-top: 2%; display: flex; align-items: center;">


                <select class="inputs custom-select" style="width:40%;margin-left:10%;" id="vehicule">
                    <option value="" disabled selected>Vehicule</option>
                    <?php foreach ($vehicules as $vehicule): ?>
                        <option value="<?= $vehicule['idVehicule']; ?>"><?= $vehicule['ModeleVehicule']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="PageDescVeh(<?php echo $AvisPage; ?>)" style="margin-left:2%; margin-top:0%;width:40%;">Consultez la page description</button>
            </div>
            <?php
        }
        ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <script>
        function PageDescVeh(Avispage) {
            var idVehicule = document.getElementById("vehicule").value;
            if (idVehicule) { // there is a vehicule selected 
                console.log(Avispage);
                if(JSON.parse(Avispage) === false){ //page marques
                    window.location.href = "Comparateur.php?id_vehicule=" + idVehicule; // go to la page description vehicule
                }else{ //page avis
                    window.location.href = "../routers/Avis.php?id_vehicule=" + idVehicule; // go to la page description vehicule
                }
            } else { // aucun veh selectionne
                alert("Veuillez sélectionner un véhicule pour pouvoir consulter ses caractéristiques.");
            }
        }

    </script>
   <?php
    }
    
}
