<?php

require_once('../View/GuideAchatView.php');
require_once '../Model/GuideAchatModel.php';



class GuideAchatController{
    public function AffichGuideAchatPage(){
        $GuideAchatModel = new GuideAchatModel();
        $Conseils = $GuideAchatModel->AfficherConseilsGuideAchat();
        $GuideAchatView = new GuideAchatView();
        $GuideAchatView->AfficherGuideAchatPage($Conseils);
    }
}