<?php

require_once '../Controller/dbController.php';

class LoginModel{
    public function AdminLoginVerif($adresse,$password){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $stmt = $pdo->prepare("SELECT idUser, NomUser, PrenomUser, Adresse_mail FROM User WHERE Adresse_mail = :adresse OR username = :adresse AND MotDePasse = :password AND etat = 'admin' AND EtatCompte = 'actif' AND InscValide = 1");
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $admin;
        }
        catch(Exception $e)
        {
            echo "Erreur lors de verfication du Login Admin" ;
            // echo "Erreur : " . $e->getMessage();
        }
    }

    public function findUser($adresse,$password){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $stmt = $pdo->prepare("SELECT idUser, NomUser, PrenomUser, Adresse_mail FROM User WHERE Adresse_mail = :adresse OR username = :adresse AND MotDePasse = :password AND etat = 'user' AND EtatCompte = 'actif' AND InscValide = 1");
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $user;
        }catch(Exception $e)
        {
            echo "Erreur" ;
        }
    }

    public function  FindExisteUser($adresse,$username,$password){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $stmt = $pdo->prepare("SELECT * FROM User WHERE Adresse_mail = :adresse AND username = :username AND MotDePasse = :password AND etat = 'user' AND EtatCompte != 'supprime'");
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $user;
        }catch(Exception $e)
        {
            echo "Erreur" ;
        }
    }

    public function FindAdresseUsernameUser($adresse,$username){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $stmt = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :username AND etat = 'user'");
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
            $db->disconnect($pdo);
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function InscrUser($nom, $prenom, $username, $adresse, $sexe, $dateNaiss, $password, $pathimage){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            // on inscrit
            $query = $pdo->prepare("INSERT INTO User (NomUser, PrenomUser, username, Sexe, DateNaissance, Adresse_mail, MotDePasse, etat, EtatCompte, InscValide, Photo) 
            VALUES (:nom, :prenom, :username, :sexe, :dateNaiss, :adresse, :password, 'user', 'actif', 0, :photo)");  
            $query->bindParam(':nom', $nom, PDO::PARAM_STR);
            $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $query->bindParam(':dateNaiss', $dateNaiss, PDO::PARAM_STR);
            $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':photo', $pathimage, PDO::PARAM_STR);
            $query->execute();
            $db->disconnect($pdo);
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function FindInfosPerson($adresse){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM User WHERE Adresse_mail =:adresse OR username=:adresse AND etat = 'user' AND EtatCompte ='actif'");
            $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $query->execute();
            $infos = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $infos;
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function getAllusers(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $users = $db-> request($pdo,"SELECT * FROM User WHERE EtatCompte !='supprime' AND etat = 'user'");
            $db->disconnect($pdo);
            return $users;
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function FindInfosPersonbyid($iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM User WHERE idUser =:iduser");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $query->execute();
            $infos = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $infos;
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function DeleteUserbyid($idUserSuppr){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("UPDATE User SET EtatCompte = 'supprime' WHERE idUser = :iduser");
            $query->bindParam(':iduser', $idUserSuppr, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function BloqueUserbyid($iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("UPDATE User SET EtatCompte = 'bloque' WHERE idUser = :iduser");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function DeBloqueUserbyid($iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("UPDATE User SET EtatCompte = 'actif' WHERE idUser = :iduser");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function ValiderInscrbyid($iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("UPDATE User SET inscValide = 1 WHERE idUser = :iduser");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

}
?>
