<?php

class DetailsLogosMarquesView{
    public function afficherDLogosMarquesPrincipales($logosMarques,$AvisPage){

        echo '<h1 style=" display: flex; font-size:300% ;align-items: center; justify-content: center; margin-top:3%;margin-left:-3%;">Les principales marques</h1>';
        echo '<div class="d-flex flex-wrap justify-content-center" style="margin-left:2%; width:80%;height:40%;">';
        foreach ($logosMarques as $logoMarque) {
            ?>
<a href="#" class="btn btn-primary" style="background-color: #CAF0FF; border: none; margin-left: 15%; margin-top: 5%; width: 17%; height: 13%;" onclick="MarqueDetails(<?= $logoMarque['idMarque']; ?>, <?= $AvisPage; ?>)">
             <img src="<?= $logoMarque['ImageLogo']; ?>" alt="Afficher Détails marque" width="300" height="180" style="margin-left:-50%;">
             <h4 style="color:#333333; margin-top:20%;"><?php echo $logoMarque['NomMarque']; ?></h4>
            </a>    
    <?php
        }
        echo '</div> ';
        echo '<div id="resultatdetails" ></div> ';
        ?>
        <script>
            function MarqueDetails(idMarque,AvisPage) {

                $.ajax({
                    url: '../Ajax/getInfoMarques.php',
                    type: 'GET',
                    data: {
                        dataMarque: idMarque,
                        dataMarquee: AvisPage  
                    },
                    beforeSend: function() {
                        console.log("Data");
                        console.log(idMarque);
                        console.log(AvisPage);
                    },
                    success: function(response) {
                        console.log('reponse:', response);
                        $("#resultatdetails").html(response);
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