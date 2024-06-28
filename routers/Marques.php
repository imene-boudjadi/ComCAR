<?php

require_once '../Controller/MarquesController.php';

session_start();
$AvisPage = "false";  // on est dans la page marque 
$MarquesController = new MarquesController();
$MarquesController->AffichMarquesPage($AvisPage);  // $Avispage vide

?>