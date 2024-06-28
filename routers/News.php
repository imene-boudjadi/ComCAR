<?php

require_once '../Controller/NewsController.php';

session_start();
$NewsController = new NewsController();

if (isset($_GET['idNews'])) { // cas de details
    $idNews = $_GET['idNews'];
    $NewsController->AfficherDetailNews($idNews);
} else {
    // Page News general
    $NewsController->AffichNewsPage();
}

?>