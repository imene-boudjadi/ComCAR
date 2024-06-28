<?php


require_once '../Controller/dbController.php';

class MenuModel {

    public function getElementsMenu() {
        $db = new dbController();
        $pdo = $db->connect();
        $MenuEl = $db->request($pdo, "SELECT NomElement FROM Menu");
        $db->disconnect($pdo);
        return $MenuEl;
    }
}

?>
