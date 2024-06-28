function Bloquer(iduser) {
    var bloquerbutt = $('.blockbutt[data-user-id="' + iduser + '"]');
    $.ajax({
        url: '../routers/AdminGestionUser.php',
        type: 'POST',
        data: {
            datauser: iduser
        },
        beforeSend: function () {
            console.log("iduser =");
            console.log(iduser);
            console.log(bloquerbutt);
            console.log("bloquer");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                bloquerbutt.html(`<button class="blockbutt" data-user-id="<?php echo $user['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="DeBloquer('<?php echo $user['idUser']; ?>')">
                        <img src="../Icons/blocked-2.png" style="width: 70%; height: 4vh;" alt="debloquer user">
                    </button>`);
                    // changer l etat
                    const OldEtat = bloquerbutt.closest('tr').find('#etatCompte'); // for parent cuz il ya beaucoup de etatcompte(boucle)
                    OldEtat.text('bloque');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}



function Debloquer(iduser) {
    var debloquerbutt = $('.blockbutt[data-user-id="' + iduser + '"]');
    $.ajax({
        url: '../routers/AdminGestionUser.php',
        type: 'POST',
        data: {
            datauserDebloqu: iduser
        },
        beforeSend: function () {
            console.log("iduser =");
            console.log(iduser);
            console.log(debloquerbutt);
            console.log("Debloquer");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                debloquerbutt.html(`<button class="blockbutt" data-user-id="<?php echo $user['idUser']; ?>" style="background:none; border: none; cursor: pointer;padding: 0;" onclick="Bloquer('<?php echo $user['idUser']; ?>')">
                                     <img src="../Icons/blocked.png" style="width: 70%; height: 4vh;" alt="bloquer user">
                                    </button>`);
                    // changer l etat
                    const OldEtat = debloquerbutt.closest('tr').find('#etatCompte');                    
                    OldEtat.text('actif');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}

function ValiderInsc(iduser) {
    var validbutt = $('.validbutt[data-user-id="' + iduser + '"]');
    $.ajax({
        url: '../routers/AdminGestionUser.php',
        type: 'POST',
        data: {
            datauserValid: iduser
        },
        beforeSend: function () {
            console.log("iduser =");
            console.log(iduser);
            console.log(validbutt);
            console.log("valider inscription");
        },
        success: function (response) {
            console.log("response:", response);
            if (response === 'true') {
                validbutt.html(`<img src="../Icons/check-5.png" style="width: 20%; height: 4vh;" alt="inscription valide">`);
                    // changer l etat de linscription
                    const OldEtat = validbutt.closest('tr').find('#nonvalideEtat'); // for parent cuz il ya beaucoup de etatcompte(boucle)
                    OldEtat.text('validée');
            }
        },
        error: function (xhr) {
            console.log('Erreur Ajax');
        }
    });
}

$(document).ready(function(){ 
$("#rechercheUserInp").on("keyup", function() { //r echerche (nom du user)
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#tableau-user tr").filter(function() {
      $(this).toggle($(this).children(".nom-user").eq(0).text().toLowerCase().indexOf(value) > -1)
    });
  });


$("#etatCompte-filtre").on("click", function () { // tri (etat compte -- bloque /actif)
    $(".filtres").css("background-color","#8D6A9F");
    $(this).css("background-color", "#90E0EF");
    let tri = false;
    let val1 = 0;
    let val2 = 0;
    while (tri == false) {
        tri = true;
        for (let i = 1; i < $("#tableau-user tbody tr").length - 1; i++) {
            val1 = $("#tableau-user tbody tr").eq(i).children("td").eq(4).text().toLowerCase();
            val2 = $("#tableau-user tbody tr").eq(i + 1).children("td").eq(4).text().toLowerCase();

            if (val1.localeCompare(val2) === 1) {
                let str = $("#tableau-user tbody tr").eq(i).html();
                $("#tableau-user tbody tr").eq(i).html($("#tableau-user tbody tr").eq(i + 1).html());
                $("#tableau-user tbody tr").eq(i + 1).html(str);
                tri = false;
            }
        }
    }
});

$("#InscrEtat-filtre").on("click", function () {
    $(".filtres").css("background-color","#8D6A9F");
    $(this).css("background-color", "#90E0EF");
    
    let tri = false;
    let val1 = 0;
    let val2 = 0;

    while (tri == false) {
        tri = true;
        for (let i = 1; i < $("#tableau-user tbody tr").length - 1; i++) {
            val1 = $("#tableau-user tbody tr").eq(i).children("td").eq(5).text().toLowerCase();
            val2 = $("#tableau-user tbody tr").eq(i + 1).children("td").eq(5).text().toLowerCase();

            if (val1.localeCompare(val2) == 1) {
                let str = $("#tableau-user tbody tr").eq(i).html();
                $("#tableau-user tbody tr").eq(i).html($("#tableau-user tbody tr").eq(i + 1).html());
                $("#tableau-user tbody tr").eq(i + 1).html(str);
                tri = false;
            }
        }
    }
});


});