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
    
    function ComparerVehicules(){
        var isValidForm1 = formulaireIsValid(1);
        var isValidForm2 = formulaireIsValid(2);
        // cas ou non remplit des formulaire 1 et 2 
        if (!isValidForm1 || !isValidForm2) {
            alert("Vous devez remplir au moins les 2 premiers formulaires avec des donnees valides pour comparer."); // message derreur / alert
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