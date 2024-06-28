<?php

require_once '../View/AccueilView.php';

class AccueilController {
    public function AfficherPageAccueil() {
        $accueilView = new AccueilView();
        $accueilView->AfficherPageAccueil();
    }
}

?>