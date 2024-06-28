<?php

require_once '../Model/db.php';

class dbController {

    public function connect() {
        $dbModel = new dbModel();
        return $dbModel->Connect();
    }

    public function disconnect($pdo) {
        $dbModel = new dbModel();
        $dbModel->disconnect($pdo);
    }

    public function request($pdo, $query) {
        $dbModel = new dbModel();
        return $dbModel->request($pdo, $query);
    }
}
?>
