<?php

require_once '../Controller/dbController.php';

class GuideAchatModel{
    public function AfficherConseilsGuideAchat(){
        $db = new dbController();
        $pdo = $db->connect();
        $Conseils = $db->request($pdo, "SELECT titreConseil,Conseil FROM GuideAchat");
        $db->disconnect($pdo);
        return $Conseils;
    }

}

?>