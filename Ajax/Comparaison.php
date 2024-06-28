<?php

require_once('../Controller/ComparateurController.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
$ComparateurController = new ComparateurController();
$ComparateurController->FormComparaison();
}

?>
