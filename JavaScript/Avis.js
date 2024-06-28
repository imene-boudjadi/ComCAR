function VoirAllAvis(idVehicule) {
    $.ajax({
        url: '../Ajax/getAllAvisVeh.php',
        type: 'GET',
        data: {
            datavehicule: idVehicule
        },
        success: function (response) {
            console.log('reponse:', response);
            $('#AllAvis').html(response);
        },
        error: function (xhr) {
            console.log('Erreur dans la requete ajax');
            alert('Erreur requete' + xhr.status);
        }
    });
}



function ApprecierAvisVeh(idAvis, adresseuser) {
    var appreciationButton = $('.appreciationButton[data-avis-id="' + idAvis + '"]');
    $.ajax({
        url: '../Ajax/Avis.php',
        type: 'POST',
        data: {
            datauser: adresseuser,
            dataAvis: idAvis
        },
        beforeSend: function () {
            console.log("adresseuser =");
            console.log(adresseuser);
            console.log("idAvis =");
            console.log(idAvis);
            console.log(appreciationButton);
            console.log("appreciation");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                appreciationButton.html(`
                <button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisVeh(${idAvis}, '${adresseuser}')">                        
                    <img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">
                </button>`);
                    // car le nb apreciation doit aussi etre inceremente
                    var nbApprElement = appreciationButton.closest('.card-body').find('#nbAprr');
                    var currentNbAppr = parseInt(nbApprElement.text().split(' ')[0]);
                    nbApprElement.text((currentNbAppr + 1) + ' appréciations');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}


function DeApprecierAvisVeh(idAviss, adresseuserr){
    var appreciationButton = $('.appreciationButton[data-avis-id="' + idAviss + '"]');
    $.ajax({
        url: '../Ajax/Avis.php',
        type: 'POST',
        data: {
            dataauser: adresseuserr,
            dataaAvis: idAviss
        },
        beforeSend: function () {
            console.log("adresseuser =");
            console.log(adresseuserr);
            console.log("idAvis =");
            console.log(idAviss);
            console.log(appreciationButton);
            console.log("deappreciation");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                appreciationButton.html(`
                <button type="button" class="appreciationButton" data-avis-id="' . $idAvis . '"  style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisVeh(${idAviss}, '${adresseuserr}')">                        
                    <img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">
                </button>`);
                    // car le nb apreciation doit aussi etre inceremente
                    var nbApprElement = appreciationButton.closest('.card-body').find('#nbAprr');
                    var currentNbAppr = parseInt(nbApprElement.text().split(' ')[0]);
                    nbApprElement.text((currentNbAppr - 1) + ' appréciations');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}



function ApprecierAvisM(idAvis, adresseuser) {
    var appreciationButtonM = $('.appreciationButtonM[data-avis-id="' + idAvis + '"]');
    $.ajax({
        url: '../Ajax/Avis.php',
        type: 'POST',
        data: {
            datauserM: adresseuser,
            dataAvisM: idAvis
        },
        beforeSend: function () {
            console.log("adresseuser =");
            console.log(adresseuser);
            console.log("idAvis =");
            console.log(idAvis);
            console.log(appreciationButtonM);
            console.log("appreciationM");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                appreciationButtonM.html(`
                <button type="button" class="appreciationButtonM" data-avis-id="' . $idAvis . '" style="border: none; background: none; cursor: pointer;" onclick="DeApprecierAvisM(${idAvis}, '${adresseuser}')">                        
                    <img src="../Icons/appreciation-apres.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">
                </button>`);
                    var nbApprElement = appreciationButtonM.closest('.card-body').find('#nbAprr');
                    var currentNbAppr = parseInt(nbApprElement.text().split(' ')[0]);
                    nbApprElement.text((currentNbAppr + 1) + ' appréciations');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}


function DeApprecierAvisM(idAviss, adresseuserr){
    var appreciationButtonM = $('.appreciationButtonM[data-avis-id="' + idAviss + '"]');
    $.ajax({
        url: '../Ajax/Avis.php',
        type: 'POST',
        data: {
            dataauserMarque: adresseuserr,
            dataaAvisMarque: idAviss
        },
        beforeSend: function () {
            console.log("adresseuser =");
            console.log(adresseuserr);
            console.log("idAvis =");
            console.log(idAviss);
            console.log(appreciationButtonM);
            console.log("deappreciationM");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                appreciationButtonM.html(`
                <button type="button" class="appreciationButtonM" data-avis-id="' . $idAvis . '"  style="border: none; background: none; cursor: pointer;" onclick="ApprecierAvisM(${idAviss}, '${adresseuserr}')">                        
                    <img src="../Icons/appreciation.png" alt="Apprecier" style="width: 40px; height: 30px; margin-right: 3%;">
                </button>`);
                    // car le nb apreciation doit aussi etre inceremente
                    var nbApprElement = appreciationButtonM.closest('.card-body').find('#nbAprr');
                    var currentNbAppr = parseInt(nbApprElement.text().split(' ')[0]);
                    nbApprElement.text((currentNbAppr - 1) + ' appréciations');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}


function AddFavoris(idveh, adresseuser) {
    var favorisbutton = $('.favorisbuTTon[data-veh-id="' + idveh + '"]');
        $.ajax({
        url: '../Ajax/Avis.php',
        type: 'POST',
        data: {
            adressuser: adresseuser,
            dataveh: idveh
        },
        beforeSend: function () {
            console.log("addFavoris");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                favorisbutton.html(`
                <button type="button" class="favorisbuTTon" data-veh-id="<?php echo $idvehicule; ?>" style="border: none; background: none; cursor: pointer;" onclick="RemoveFavoris(${idveh}, '${adresseuser}')">                        
                    <img src="../Icons/favourite.png" alt="favoris" style="width: 40px; height: 30px; margin-right: 3%;">
                </button>`);
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}



function RemoveFavoris(idveh, adresseuser) {
    var favorisbutton = $('.favorisbuTTon[data-veh-id="' + idveh + '"]');
    $.ajax({
        url: '../Ajax/Avis.php',
        type: 'POST',
        data: {
            Adress: adresseuser,
            Vehicule: idveh
        },
        beforeSend: function () {
            console.log("RemoveFavoris");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                favorisbutton.html(`
                <button type="button" class="favorisbuTTon" data-veh-id="<?php echo $idvehicule; ?>"style="border: none; background: none; cursor: pointer;" onclick="AddFavoris(${idveh}, '${adresseuser}')">                        
                    <img src="../Icons/vote.png" alt="favoris" style="width: 40px; height: 30px; margin-right: 3%;">
                </button>`);
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}

