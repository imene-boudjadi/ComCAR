<?php

require_once '../Controller/dbController.php';

class DiaporamaModel {

    public function getDiaporama() {
        $db = new dbController();
        $pdo = $db->connect();
        $Diapos = $db->request($pdo, "SELECT * FROM Diaporama");
        $db->disconnect($pdo);
        return $Diapos;
    }
}

?>
