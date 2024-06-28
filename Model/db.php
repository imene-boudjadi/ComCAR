<?php

class dbModel {

    private $host = 'localhost';
    private $dbname = 'tdwProjet';
    private $user = 'root';
    private $password = '';

    public function Connect() {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connexion reussite";
            return $pdo;
        } catch (PDOException $e) {
            die("Connection échouée: " . $e->getMessage());
        }
    }

    public function disconnect($pdo) {
        $pdo = null;
    }

    public function request($pdo, $query) { // request sans parametres
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function requestPar($pdo, $query, $params = array()) { // request avec des parametres
    //     try {
    //         $stmt = $pdo->prepare($query);
    //         $stmt->execute($params);
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
    //     }
    // }

}

?>





