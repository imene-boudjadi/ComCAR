function ValiderAv(idAvis) {
    var validCommButt = $('.validerComm[data-avis-id="' + idAvis + '"]');
    var refusCommButt =  $('.RefuserComm[data-avis-id="' + idAvis + '"]');
    $.ajax({
        url: '../routers/AdminAvisGestion.php',
        type: 'POST',
        data: {
            dataavis: idAvis
        },
        beforeSend: function () {
            console.log("idavis =");
            console.log(idAvis);
            console.log(validCommButt);
            console.log(refusCommButt);
            console.log("valider commentaire");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                validCommButt.html(`<img src="../Icons/check-5.png" style="width: 200%; height: 6vh;" alt="inscription valide">`);
                // refusCommButt.html(``);
                refusCommButt.text(''); 
                // changer l etat
                const OldEtat = validCommButt.closest('tr').find('#nonvalide'); 
                OldEtat.text('Validé');
            }
        },
        error: function (xhr) {
            console.log("erreur");
        }
    });
}

function ValiderAvM(idAvis) {
    var validCommButt = $('.validerCommM[data-avis-id="' + idAvis + '"]');
    var refusCommButt = $('.RefuserComm[data-avis-id="' + idAvis + '"]');
    $.ajax({
        url: '../routers/AdminAvisGestion.php',
        type: 'POST',
        data: {
            dataavisM: idAvis
        },
        beforeSend: function () {
            console.log("idavis =");
            console.log(idAvis);
            console.log(validCommButt);
            console.log("valider commentaire");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                validCommButt.html(`<img src="../Icons/check-5.png" style="width: 200%; height: 6vh;" alt="inscription valide">`);
                // refusCommButt.html(``);
                refusCommButt.text(''); 
                // changer l etat
                const OldEtat = validCommButt.closest('tr').find('#nonvalide'); 
                OldEtat.text('Validé');
            }
        },
        error: function (xhr) {
            console.log("erreur");
        }
    });
}


$(document).ready(function(){ 
    $("#rechercheAvisInp").on("keyup", function() { 
        var value = $(this).val().toLowerCase();
        // console.log(value);
        $("#tableau-avis tr").each(function() {
            var nomUser = $(this).find(".nom-user").eq(0).text().toLowerCase();
            var comment = $(this).find(".commentaire").eq(0).text().toLowerCase();
            var rechInp = nomUser.indexOf(value) > -1 || comment.indexOf(value) > -1;
            
            $(this).toggle(rechInp);
        });
    });

});


   