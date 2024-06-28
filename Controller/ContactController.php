<?php

require_once('../View/ContactView.php');

class ContactController{
    public function AffichContactPage(){
        $ContactView = new ContactView();
        $ContactView->AfficherContactPage();
    }
}