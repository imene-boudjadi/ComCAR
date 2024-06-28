<?php

class AccueilAdminController{

    public function AfficherAccueilAdmin(){
        $AdminAccueilView = new AccueilView();
        $AdminAccueilView->AfficherPageAccueil();
    }
}

?>