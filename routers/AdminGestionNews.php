
<?php

require_once('../Controller/AdminNewsController.php');
require_once('../Controller/LoginAdminController.php');



session_start();
if($_SESSION['adresseAdmin']!=[]){
$AdminNewsController = new AdminNewsController();

if (isset($_GET['submit'])) {

    if ($_GET['submit'] == "Modifier") {
        $AdminNewsController->AffichEditForm($_GET['id_news']);
    } 
    elseif ($_GET['submit'] == "Supprimer"){
        $AdminNewsController->DeleteNews($_GET['id_news']);
        $AdminNewsController->AfficherTableNews();
    }

}elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editN'])) {
        // statique (de table news)
        $idnews = $_POST['id_news'];
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        if (isset($_FILES["photo"]) && $_FILES["photo"]["size"] > 0) {
            $nomfile = $_FILES["photo"]["name"];
            $pathmonprojet = dirname(__FILE__) . "/Images/"; 
            $path = $pathmonprojet . $nomfile;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
            $pathimage = "../Images/" . $nomfile;   
        } else {
            $pathimage = null; // no image selected
            $news = $AdminNewsController->getNews($idnews);
            $pathimage = $news['ImageNews'];
            echo $pathimage;
            
        }
        echo "hi";
        $AdminNewsController->editNews($idnews,$titre, $contenu,$pathimage);

        // detils news
        $i = 1; // nb détails news (pargrph+img) est dynamique
        while (isset($_POST['paragraphe' . $i])) {
            $idDetails = $_POST['id_newsDet' . $i];
            $paragraphe = $_POST['paragraphe' . $i];

            if (isset($_FILES["image" . $i]) && $_FILES["image" . $i]["size"] > 0) {
                $nomFile = $_FILES["image" . $i]["name"];
                $pathMonProjet = dirname(__FILE__) . "/Images/";
                $path = $pathMonProjet . $nomFile;
                move_uploaded_file($_FILES["image" . $i]["tmp_name"], $path);
                $pathImage = "../Images/" . $nomFile;
            } else {
                $pathImage = null; // no new image selected
                $detailsnews = $AdminNewsController->getDetailsNewsById($idDetails);
                $pathImage = $detailsnews['ImageDetailsNews'];
            }
            $AdminNewsController->ModifierdetailsNews($idDetails, $paragraphe, $pathImage);
            $i++;
        }
        header("Location:../routers/AdminGestionNews.php");
        exit();
    }
}

elseif(isset($_GET['idNews'])){
    $AdminNewsController->getdetails($_GET['idNews']);
}else {
    // Afficher tab news
    $AdminNewsController->AfficherTableNews();
}
}else{
    $Admincontroller = new LoginAdminController();    
    $Admincontroller->afficherLoginForm();
}

?>