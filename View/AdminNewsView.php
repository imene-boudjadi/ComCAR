<?php

require_once('../View/pageAdmin.php');
require_once('../View/DetailsNewsView.php');

class AdminNewsView extends pageAdmin{
    public function TableNews($news){
        ?>
        <center>
        <div class="titreLog">
            <h1 style="margin-top: 3%;margin-left: 35%; margin-bottom:4%; color:#8D6A9F;">Gestion des News</h1>  
        </div>
        </center>

        <div class="table-responsive-md">
        <div class="col-3  mt-5 " style ="margin-left:5%;margin-bottom:2%;"> <!-- mrgin top 5 -->
        <input class="form-control" id="newsInp" type="text" placeholder="Rechercher un news..." style ="border:1px solid black;"> </div>
        <div class="form-group col-2">
            <form action="../routers/AdminGestionNews.php" method="GET">
            <input id="ajouter_news"  type="submit"  name = "add_vehicule" value="Ajouter news "  class="btn btn-outline-primary" style="background-color:#90E0EF; color:#333333;margin-top:-58%; margin-left:220%;"/>
            </form>
    </div>
         <table id="tableau-news" class="table table-hover dataTable">
        <thead class=""> 
          <tr>
            <th scope="col" class="text-center">Titre news</th>
            <th scope="col" class="text-center">Contenu</th>
            <th scope="col" class="text-center" >Date</th>
            <th scope="col" class="text-center" > Gestion </th> 
          </tr>
        </thead>
        <tbody>
            <?php
            foreach ($news as $new){
                echo '<tr>';
                echo '<td class="text-center titrN" style="max-width: 70px;"><b>'.$new['TiteNews'].'</b></td>';
                echo '<td class="text-center contenuN" style="max-width: 250px;">'.$new['ContenuNews'].'</td>';
                echo '<td class="text-center date" style="max-width: 150px;">'.$new['DateNews'].'</td>';
                echo '<td class="text-center details" style="max-width: 70px;">
                    <a href="../routers/AdminGestionNews.php?idNews=' . $new['idNews'] . '" style="color:#8D6A9F; margin-right:5%;margin-top:3%;">Afficher détails</a>
                    </td>';
                    echo '<td class="text-center" style="max-width: 60px;">
                    <form action="../routers/AdminGestionNews.php" method="GET">
                    <input type="hidden" class="id_news" name="id_news" value="' . $new['idNews'] . '" />
                    <input  type="submit" name = "submit" value="Modifier" class="btn btn-primary" style="background-color : #FFFF2E; color : black; border-color:#FFFF2E;margin-left:-80%"/>
                    </form>
                    </td>';
                    echo '<td class="text-center" style="max-width: 60px;">
                    <form action="../routers/AdminGestionNews.php" method="GET">
                    <input type="hidden" class="id_news" name="id_news" value="' . $new['idNews'] . '" />
                    <input  type="submit" name = "submit" value="Supprimer" class="btn btn-primary" style="background-color : red; color : white; border-color:red ;margin-left:-60%"/>
                    </form>
                    </td>';
            }
            ?>
        </tbody>
        </table>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){ 
                $("#newsInp").on("keyup", function() { //r echerche (nom du user)
                    var value = $(this).val().toLowerCase();
                    $("#tableau-news tr").each(function() {
                        var titre = $(this).find(".titrN").eq(0).text().toLowerCase();
                        var cont = $(this).find(".contenuN").eq(0).text().toLowerCase();
                        var rechInp = titre.indexOf(value) > -1 || cont.indexOf(value) > -1;
                        $(this).toggle(rechInp);
                    });
                });
            });

        </script>
        <?php
    }

    public function AffichTableNews($news){
        $this->entete_page("Gestion News");
        $this->menu();
        $this ->logoutButton();
        $this->TableNews($news);
 
    }

    public function Afficherdetailsnews($infosnews){
        $this->entete_page("Gestion News");
        $this->menu();
        $this ->logoutButton();
        $DetailsNewsView = new DetailsNewsView();
        $DetailsNewsView ->DetailsNews($infosnews);

    }

    public function AfficherEditform($infosnews) {
        $this->entete_page("Modifier News");
    
        echo '<div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;margin-bottom:4%;"> Modifier News : ' . $infosnews[0]['TiteNews'] . '</h1></div>';
        ?>
    
        <form action="../routers/AdminGestionNews.php" method="post">
            <div class="row form-row justify-content-center" style="margin-top:3%;">
                <div class="form-group col-2">
                    <label for="titre"><b>Titre du news</b></label>
                    <?php
                        echo '<input type="hidden" name="id_news" class="form-control" id="id_Input" value="' . $infosnews[0]['idNews'] . '">';
                        echo '<input required type="text" name="titre" class="inputs form-control" id="inputModele" placeholder="Titre News" value="' . $infosnews[0]['TiteNews'] . '">';
                    ?>
                </div>
                <div class="form-group col-2">
                    <?php
                    echo '<label for="imgInput" class="col-12"><b>Image du véhicule</b></label>';
                    echo '<img class="col-12" id="img-view" src="' . $infosnews[0]['ImageNews'] . '" style="max-width:200px;max-height:200px;margin-left:30%;margin-bottom:3%"></img>';
                    echo '<input type="hidden" id="imgInput"  class="form-control" value="' . $infosnews[0]['ImageNews'] . '">';
                    echo '<input name="photo" type="file" class="inputs form-control" id="imgInput" placeholder="Image News">';
                    ?>
                </div> <?php
                    ?>
                
            </div>
            <div class="row form-row justify-content-center" style="margin-top:3%;">
                <div class="form-group col-2">
                    <label class="mr-sm-2" for="contenu"><b>Contenu de news</b></label>
                    <textarea required name="contenu" class="inputs form-control" id="contenu" placeholder="Contenu News"><?php echo $infosnews[0]['ContenuNews']; ?></textarea>
                </div>
            </div>
    
            <?php
            if ($infosnews) {
                $i = 1; // cuz le nombre de details news est dynamique  
                foreach ($infosnews as $news) {
                    ?>
                     <div class="row form-row justify-content-center" style="margin-top:3%;">
                  <div class="form-group col-2">
                  <?php
                    echo '<label class="mr-sm-2" for="paragraphe'.$i.'"><b>Paragraphe '.$i.'</b></label>';
                    echo '<input type="hidden" name="id_newsDet'.$i.'" class="form-control" id="id_Input" value="' . $news['idDetailsNews'] . '">';
                        echo '<textarea name="paragraphe'.$i.'" class="inputs form-control" id="paragraphe'.$i.'" required placeholder="Paragraphe '.$i.'">'.$news['ParagrapheNews'].'</textarea>';
                    ?>
                </div>
                <div class="form-group col-2">
                    <label for="image<?php echo $i; ?>" class="col-12"><b>Image <?php echo $i; ?></b></label>
                        <img class="col-12" id="img-view" src="<?php echo $news['ImageDetailsNews']; ?>" style="max-width:200px;max-height:200px;margin-left:30%;margin-bottom:3%"></img>
                        <input type="hidden" name="imgInput<?php echo $i; ?>" class="form-control" value="<?php echo $news['ImageDetailsNews']; ?>">
                    <input name="image<?php echo $i; ?>" type="file" class="inputs form-control" id="image<?php echo $i; ?>" placeholder="Image <?php echo $i; ?>">
                </div>
            </div>
                    <?php
                    $i++;
                }
            }
            ?>
            <div class="justify-content-center">
                <button id="submitEdit" type="submit" name="editN" class="btn btn-primary mb-5" value="editer" style="width: 30%; margin-left: 34%;margin-top:2%; background-color:#90E0EF; color:#333333;">Modifier</button>
            </div>
        </form>
    
        <?php
    }
    
}

?>