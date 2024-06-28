<?php

require_once '../Controller/ContactController.php';

session_start();
$ContactController = new ContactController();
$ContactController->AffichContactPage();

?>