<?php

require_once('../View/Template.php');
require_once('../Controller/ComparateurController.php');
require_once('../Controller/AvisController.php');


class DetailsvehiculeView extends Template{

    public function afficherDetailss($InfosVeh){

        $AvisController = new AvisController();

        $this->entetePage("Details Vehicule");
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

        $ComparateurController = new ComparateurController();

        ?>
        <!-- details du vehicule -->
        <div class="container mt-5" style="margin-bottom:4%;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="background-color:#CAF0F8;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#90E0EF;">
                        <h2>Caractéristiques du Véhicule</h2>
                        <?php
                        session_start();
                        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []) { 
                            $idvehicule = $InfosVeh['idVehicule'];
                            $adresseuser = $_SESSION['adresse'];
                            $VehFavoris = $AvisController->getFavorisVehiculeuser($idvehicule, $adresseuser);
                            if($VehFavoris){
                        ?>
                        <button type="button" class="favorisbuTTon" data-veh-id="<?php echo $idvehicule; ?>" style="border: none; background: none; cursor: pointer;" onclick="RemoveFavoris(<?php echo $idvehicule; ?>, '<?php echo $adresseuser; ?>')">  
                            <img src="../Icons/favourite.png" alt="favoris" style="width: 40px; height: 30px; margin-right: 3%;">
                        </button>
                        <?php } else { ?>
                            <button type="button" class="favorisbuTTon" data-veh-id="<?php echo $idvehicule; ?>"style="border: none; background: none; cursor: pointer;" onclick="AddFavoris(<?php echo $idvehicule; ?>, '<?php echo $adresseuser; ?>')">  
                            <img src="../Icons/vote.png" alt="favoris" style="width: 40px; height: 30px; margin-right: 3%;">
                        </button>
                        <?php } }?>
                    </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php
                                       echo '<img src="' . $InfosVeh['ImageVehicule'] . '" alt="Photo vehicule" class="img-fluid" style="width:150%; height : 30%;">';
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <?php if ($InfosVeh) : ?>
                                        <ul class="list-group">
                                            <li class="list-group-item"><b>Modele:</b> <?php echo $InfosVeh['ModeleVehicule']; ?></li>
                                            <li class="list-group-item"><b>Marque:</b> <?php echo $InfosVeh['NomMarque']; ?></li>
                                            <li class="list-group-item"><b>Version:</b> <?php echo $InfosVeh['VersionVehicule']; ?></li>
                                            <li class="list-group-item"><b>Année:</b> <?php echo $InfosVeh['AnneeVehicule']; ?></li>
                                            <li class="list-group-item"><b>Moteur:</b> <?php echo $InfosVeh['Moteur']; ?></li>
                                            <li class="list-group-item"><b>Performance:</b> <?php echo $InfosVeh['Performance']; ?></li>
                                            <li class="list-group-item"><b>Dimensions:</b> <?php echo $InfosVeh['Dimensions']; ?></li>
                                            <li class="list-group-item"><b>Puissance:</b> <?php echo $InfosVeh['Puissance']; ?></li>
                                            <li class="list-group-item"><b>Capacité:</b> <?php echo $InfosVeh['Capacite']; ?></li>
                                            <li class="list-group-item"><b>Consommation:</b> <?php echo $InfosVeh['Consommation']; ?></li>
                                            <li class="list-group-item"><b>Tarif:</b> <?php echo $InfosVeh['tarif']; ?></li>
                                            <li class="list-group-item"><b>Note:</b> <?php  
                                                $note = $ComparateurController->getNote($InfosVeh['idVehicule']);
                                                echo $note;
                                                echo "/5"; ?>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
          <!-- bouton pour comparer ce vehicule avec dautres vehicules  -->
          <button type="button" class="btn btn-primary mt-5" style="background-color: #8D6A9F; color: white; border-color: black; margin-left: 37%; margin-bottom: 2%; margin-top: -2% !important; width: 30%; height: 9vh;" onclick="AffichComp()">Comparer <?php echo $InfosVeh['ModeleVehicule']; ?> avec d'autres véhicules</button>
           <!-- le formulaire de comparaison (on click) -->
         <div  id="formComparaison" style="margin-bottom : 3%;"></div>
         <?php 
         
        // les 3 Avis les plus apprecies
        $AvisController->FindTop3AvisVeh($InfosVeh['idVehicule']);
    
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != []){
            $note = $AvisController->getNotevehbyuser($InfosVeh['idVehicule'], $_SESSION['adresse']);

        if ($note) {
            echo '<div class="card mb-5" id="noteCont" style="max-width:60%; margin-left:20%;">';
            echo '<div class="card-body">';
            echo '<h6 class="card-title" style="color:#8D6A9F;">Votre note :</h6>';
            echo '<p class="card-text"><b>' . $note['NoteVehicule'] . ' /5</b></p>';
            echo '</div>';
            echo '</div>';
        } else {
            ?><div class="card mb-5"  id="noteCont" style="max-width:60%; margin-left:20%;">
            <div class="card-body">
            <h6 class="card-title" style="color:#8D6A9F;">Donnez une note au véhicule :</h6>
            <select  id="note" style="width:10%; height:14vh;" > 
            <option value="" selected disabled>Note</option>
            <?php
                for ($i = 1; $i <= 5; $i+=0.5) { //la note entre 1 et 5 
                    echo "<option value='$i'>$i</option>";
                }?>
            </select>
            <button type="button" class="btn btn-primary" style="width: 18%; background-color: #90E0EF; color: #333333; border: 0.1px solid black;" onclick="ajouterNote('<?php echo addslashes($_SESSION['adresse']); ?>', '<?php echo addslashes($InfosVeh['idVehicule']); ?>', document.getElementById('note').value)">Ajouter note</button>
            </div>
            </div>
            <?php }
            ?><div class="card mb-5"  id="noteCont" style="max-width:60%; margin-left:20%;">
            <div class="card-body">
            <h6 class="card-title" style="color:#8D6A9F;">Ajouter un avis :</h6>
            <textarea id="avis" style="width: 100%; height: 100px;"></textarea> 
            <button type="button" class="btn btn-primary" style="width: 18%; background-color: #90E0EF; color: #333333; border: 0.1px solid black;" onclick="ajouterAvis('<?php echo htmlspecialchars(addslashes($_SESSION['adresse'])); ?>', '<?php echo htmlspecialchars(addslashes($InfosVeh['idVehicule'])); ?>', document.getElementById('avis').value)">Ajouter Avis</button>
            </div>
            </div>
        <?php
    }

        // // les comparasions les plus recherch de ce veh
        $ComparateurController->AfficherPlusRechCompbyid($InfosVeh['idVehicule']);
        
        $this->AffichPiedPage();        
        ?>


        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script type="text/javascript" src="../JavaScript/Comparaison.js"></script>
        <script>

          function AffichComp() {
            var Form = document.getElementById('formComparaison');
            $.ajax({
            url: '../Ajax/Comparaison.php',
            type: 'GET',
            success: function(response) {
                Form.innerHTML = response;
                // Remplir le premier formulaire avec les infos du veh (qu'on est dans sa page de description)
                var InfosVeh = <?php echo json_encode($InfosVeh); ?>;
                if (InfosVeh) {
                    $('#marque1').val(InfosVeh['idMarque']);
                    $('#marque1').prop('disabled', true); // pour ne pas le changer
                    // $('#marque1').append('<option disabled selected value="' + InfosVeh['idMarque'] + '">' + InfosVeh['NomMarque'] + '</option>');
                    $('#modele1').append('<option selected value="' + InfosVeh['ModeleVehicule'] + '">' + InfosVeh['ModeleVehicule'] + '</option>');
                    $('#version1').append('<option selected value="' + InfosVeh['VersionVehicule'] + '">' + InfosVeh['VersionVehicule'] + '</option>');
                    $('#annee1').append('<option selected value="' + InfosVeh['AnneeVehicule'] + '">' + InfosVeh['AnneeVehicule'] + '</option>');
                }                
            },
            error: function(xhr) {
                console.log('Erreur dans la requête ajax');
                alert('Erreur requête' + xhr.status);
            }
        });
    }
        </script>
        <script type="text/javascript" src="../JavaScript/Avis.js"></script>
        <script>

        function ajouterNote(adresseuser, idvehicule, note) {
            if (note === "") {
                alert("Veuillez choisir une note d'abord");
                return;
            }

            $.ajax({
                url: '../Ajax/Avis.php',
                type: 'POST',
                data: {
                    AdresseAddNote: adresseuser,
                    VehiculeAddnote: idvehicule,
                    note: note
                },
                beforeSend: function () {
                    console.log("Add note");
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

        function ajouterAvis(adresseuser, idvehicule, Avis) {
            if (Avis === "") {
                alert("Veuillez choisir une avis d'abord");
                return;
            }

            $.ajax({
                url: '../Ajax/Avis.php',
                type: 'POST',
                data: {
                    AdresseAddAvis: adresseuser,
                    VehiculeAddAvis: idvehicule,
                    Avis: Avis
                },
                beforeSend: function () {
                    console.log("Add avis");
                    console.log(adresseuser);
                    console.log(idvehicule);
                    console.log(Avis);
                },
                success: function (response) {
                    console.log("response:", response);
                    if (response == "true") {
                        alert("Avis ajouté");
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
}


?>