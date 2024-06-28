<?php

require_once '../Model/MenuModel.php';
require_once '../View/MenuView.php';

class MenuController {

    public function RecupererElementsMenu() {
        $modelMenu = new MenuModel();
        $r = $modelMenu->getElementsMenu();
        return $r;
    }

    public function AfficherMenu() {
        $ViewMenu = new MenuView();
        $ViewMenu->AfficherMenu();
    }

    public function AfficherPiedPage(){
        $ViewMenu = new MenuView();
        $ViewMenu->AfficherPiedPage();
    }
}
?>
