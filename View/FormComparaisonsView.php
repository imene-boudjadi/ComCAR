<?php

require_once('../Controller/MarquesController.php');
require_once('../View/ComparView.php');



class FormComparaisonsView {
    public function afficherFormComparaison() {
        $ComparView = new ComparView();
        $MarquesController = new MarquesController();
        $Marques = $MarquesController->RecupererAllMarques();
?>
    <div class="container" style="margin-top: 7%; border: 1px solid black; width:100%; height:80vh;">
        <div class="row" style="margin-top:5%;">
            <?php for ($i = 1; $i <= 4; $i++) { ?>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="formulaire<?= $i ?>" action="../routers/Comparateur.php" method="post">
                                <h5 class="text-center" style="margin-bottom:10%;"><b> Véhicule <?= $i ?> </b></h5>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="marque<?=$i?>"><b>Marque</b></label>
                                    <select name="marque<?= $i ?>" class="inputs custom-select" id="marque<?= $i ?>"  onchange="getmodele(this.value, 'modele<?= $i?>')"> 
                                        <option value="" disabled selected>Marque</option> <!-- value vide pour avant selection -->
                                        <?php foreach ($Marques as $marque) : ?>
                                            <option value="<?php echo $marque['idMarque']; ?>"><?php echo $marque['NomMarque']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="modele<?= $i ?>">Modèle</label>
                                    <select class="inputs custom-select" name="modele<?= $i ?>" id="modele<?= $i ?>" onchange="getversion(this.value, 'version<?= $i?>')">
                                        <option value="" disabled selected>Modele</option> <!-- vide pour same reason comme marque -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="version<?= $i ?>">Version</label>
                                    <select class="inputs custom-select" name="version<?= $i ?>" id="version<?= $i ?>" onchange="getAnnee(<?= $i ?>,this.value, 'annee<?= $i?>')">
                                        <option value="" disabled selected>Version</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="annee<?= $i ?>">Année</label>
                                    <select class="inputs custom-select" name="annee<?= $i ?>" id="annee<?= $i ?>">
                                        <option value="" disabled selected>Année</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="btn btn-primary" style="background-color: #8D6A9F; color: white; border-color: black; margin-left: 39%; margin-top:1%; width:20%; height:7vh;" onclick="ComparerVehicules()">Comparer</button>
    </div>
    <div id="resultatComp"></div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- <script type="text/javascript" src="../JavaScript/Comparaison.js"></script> -->
    <script>
    function getmodele(idmarque, idmodele) {    
    $.ajax({
        url: '../Ajax/getInfoFormComparaison.php',
        type: 'GET',
        data: {
            dataMarque: idmarque   
        },
        success: function(response) {
            console.log('reponse:', response);
            $('#' + idmodele).empty();
            $('#' + idmodele).append('<option value="" disabled selected>Modele</option> ');
            $.each(response, function(index, item) { 
                $('#' + idmodele).append('<option value="'+ item.ModeleVehicule +'">'+ item.ModeleVehicule +'</option>');
            });
        },
        error: function(xhr) {
            console.log('Erreur dans la requete ajax');
            alert('Erreur requete' + xhr.status); 
        }
    });
  }

  function getversion(idmodele, idversion) {    
    $.ajax({
        url: '../Ajax/getInfoFormComparaison.php',
        type: 'GET',
        data: {
            dataModele: idmodele   
        },
        beforeSend: function() {
            console.log("idModele =");
            console.log(idmodele);
        },
        success: function(response) {
            console.log('reponse:', response);
            $('#' + idversion).empty();
            $('#' + idversion).append('<option value="" disabled selected>Version</option> ');
            $.each(response, function(index, item) { 
                $('#' + idversion).append('<option value="'+ item.VersionVehicule +'">'+ item.VersionVehicule +'</option>');
            });
        },
        error: function(xhr) {
            console.log('Erreur dans la requete ajax');
            alert('Erreur requete' + xhr.status); 
        }
    });
  }

  function getAnnee(i,idVersion,idAnnee) { 

    var idModelee = $('#modele' + i + ' option:selected').val();
    console.log(idModelee);
    $.ajax({
        url: '../Ajax/getInfoFormComparaison.php',
        type: 'GET',
        data: {
            dataModelee: idModelee,
            dataVersion: idVersion  
        },
        success: function(response) {
            console.log('reponse:', response);
            $('#' + idAnnee).empty();
            $('#' + idAnnee).append('<option value=""  disabled selected>Annee</option> ');
            $.each(response, function(index, item) { 
                $('#' + idAnnee).append('<option value="'+ item.AnneeVehicule +'">'+ item.AnneeVehicule +'</option>');
            });
        },
        error: function(xhr) {
            console.log('Erreur dans la requete ajax');
            alert('Erreur requete' + xhr.status); 
        }
    });
}


  // Formulaire valid = tous les champs =/= de vide (les donnes entres deja correct because of les options de select qui sont celle de la bdd)
    function formulaireIsValid(i) {
        var marque = document.getElementById("marque" + i).value;
        var modele = document.getElementById("modele" + i).value;
        var version = document.getElementById("version" + i).value;
        var annee = document.getElementById("annee" + i).value;
        return marque !== "" && modele !== "" && version !== "" && annee !== "";
    }

    function differentvehicule() { // pour assurer que les vehicules sont differents (au moin un chmaps)
    var vehicules = [];

    for (var i = 1; i <= 4; i++) { 
        if(formulaireIsValid(i) ) {// cuz if not valid il ne sera pas considere par la comp
            var idMarque = document.getElementById("marque" + i).value;
            var modele = document.getElementById("modele" + i).value;
            var version = document.getElementById("version" + i).value;
            var annee = document.getElementById("annee" + i).value;

        var vehicule = idMarque + modele + version + annee; // concatener
        if (vehicules.includes(vehicule)) {
            return false;
        }
        vehicules.push(vehicule);
        }
    }

    return true;
}

    
    function ComparerVehicules(){
        var isValidForm1 = formulaireIsValid(1);
        var isValidForm2 = formulaireIsValid(2);
        // cas ou non remplit des formulaire 1 et 2 
        if (!isValidForm1 || !isValidForm2) {
            alert("Vous devez remplir au moins les 2 premiers formulaires avec des donnees valides pour comparer."); // message derreur / alert
            return; 
        }
        if(!differentvehicule()){
            alert("les vehicules à comparer doivent etres differents"); 
            return; 
        }
        //else
        var dataa = {}; // data a envoye f ajax 
        var idMarque, modele, version, annee;
        for (var i = 1; i <= 4; i++) { // 4 cuz il ya 4 formulaire 
            if (formulaireIsValid(i)){
                idMarque = document.getElementById("marque" + i).value; //int car id 
                modele = document.getElementById("modele" + i).value; //string
                version = document.getElementById("version" + i).value; //str
                annee = document.getElementById("annee" + i).value; //int
            }else{
                idMarque = modele = version = annee = null;
            }
            dataa['idMarque' + i] = idMarque;
            dataa['Modele' + i] = modele;
            dataa['Version' + i] = version;
            dataa['Annee' + i] = annee;
            console.log(idMarque);
            console.log(modele);
            console.log(version);
            console.log(annee);
        }


$.ajax({
        url: '../Ajax/getInfoFormComparaison.php',
        type: 'GET',
        data: {
            dataVehicule: dataa,
            dataVehiculee: dataa  
        },
        beforeSend: function() {
            console.log("Data");
            console.log(dataa);
        },
        success: function(response) {
            console.log('reponse:', response);
            window.location.href = '../routers/Comparateur.php?result=' + encodeURIComponent(JSON.stringify(response));
            // if (window.location.pathname.includes('routers/Accueil.php')){ // im in page d acceuil 
            //    window.location.href = '../routers/Comparateur.php?result=' + encodeURIComponent(JSON.stringify(dataa));
            // }else{ // im in page comparateur 
            //     $("#resultatComp").html(response);
            // }
        },
        error: function(xhr) {
            console.log('Erreur dans la requete ajax');
            alert('Erreur requete' + xhr.status); 
        }
    });

}
    </script>

<?php
    }
}

?>


