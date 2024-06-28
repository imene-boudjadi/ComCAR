<?php

require_once '../Controller/GuideAchatController.php';

session_start();
$GuideAchatController = new GuideAchatController();
$GuideAchatController->AffichGuideAchatPage();

?>