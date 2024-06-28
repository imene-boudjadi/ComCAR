
<?php

require_once '../Controller/dbController.php'; 

class AvisModel{
    // les vehicules favoris d'un user 
    public function getFavorisveh($adresse){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM  FavorisVehicule LEFT JOIN User  ON User.idUser  = FavorisVehicule.idUtilisateur LEFT JOIN Vehicule ON Vehicule.idVehicule = FavorisVehicule.CodeVehicule
            WHERE Adresse_mail =:adresse OR username=:adresse AND etat = 'user' AND EtatCompte ='actif'");
            $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $query->execute();
            $vehicules = $query->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $vehicules;
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }
    // les 3 avis les plus apprecies d'un vehicule
    public function getTop3AvisVeh($idVehicule){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT *, COUNT(idAppreciationVeh) as nbAppr FROM AvisVehicule LEFT JOIN Vehicule ON Vehicule.idVehicule = AvisVehicule.CodeVehicule 
            LEFT JOIN User ON AvisVehicule.idUserAvisVeh = User.idUser LEFT JOIN AppreciationVeh ON AppreciationVeh.CodeAvisV = AvisVehicule.idAvisVeh
            WHERE Vehicule.idVehicule = :idvehicule AND AvisValide = 1 AND Avisrefuse = 0 
            GROUP BY idAvisVeh ORDER BY nbAppr DESC LIMIT 3");
            $query->bindParam(':idvehicule', $idVehicule, PDO::PARAM_STR);
            $query->execute();
            $Avis = $query->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Avis;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    // les 3 avis les plus apprecies d'une marque 
    public function getTop3AvisMarque($idmarque){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT *, COUNT(idAppreciationMarque) as nbAppr FROM AvisMarque LEFT JOIN Marque ON Marque.idMarque = AvisMarque.Codemarque LEFT JOIN User ON AvisMarque.idUserAvisMarque = User.idUser 
            LEFT JOIN AppreciationMarque ON AppreciationMarque.CodeAvisM = AvisMarque.idAvisMarque
            WHERE Marque.idMarque = :idmarque AND AvisValidee = 1 AND Avisrefusee = 0 
            GROUP BY idAvisMarque ORDER BY nbAppr DESC LIMIT 3");
            $query->bindParam(':idmarque', $idmarque, PDO::PARAM_STR);
            $query->execute();
            $Avis = $query->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Avis;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function getAllAvisVeh($idVeh){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT *, COUNT(idAppreciationVeh) as nbAppr FROM AvisVehicule LEFT JOIN Vehicule ON Vehicule.idVehicule = AvisVehicule.CodeVehicule 
            LEFT JOIN User ON AvisVehicule.idUserAvisVeh = User.idUser LEFT JOIN AppreciationVeh ON AppreciationVeh.CodeAvisV = AvisVehicule.idAvisVeh
            WHERE Vehicule.idVehicule = :idvehicule AND AvisValide = 1 AND Avisrefuse = 0 
            GROUP BY idAvisVeh ORDER BY nbAppr DESC");
            $query->bindParam(':idvehicule', $idVeh, PDO::PARAM_STR);
            $query->execute();
            $Avis = $query->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Avis;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function getAllAvisMarque($idMarque){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT *, COUNT(idAppreciationMarque) as nbAppr FROM AvisMarque LEFT JOIN Marque ON Marque.idMarque = AvisMarque.Codemarque LEFT JOIN User ON AvisMarque.idUserAvisMarque = User.idUser 
            LEFT JOIN AppreciationMarque ON AppreciationMarque.CodeAvisM = AvisMarque.idAvisMarque
            WHERE Marque.idMarque = :idmarque AND AvisValidee = 1 AND Avisrefusee = 0 
            GROUP BY idAvisMarque ORDER BY nbAppr DESC");
            $query->bindParam(':idmarque', $idMarque, PDO::PARAM_STR);
            $query->execute();
            $Avis = $query->fetchAll(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Avis;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }
///// ******************************************************** /////
        public function AddNoteVeh($iduser, $idvehicule, $note) {
            try {
                $db = new dbController();
                $pdo = $db->connect();
                $verQ = $pdo->prepare("SELECT * FROM NoteVehicule WHERE idUtil= :iduser AND codeveh= :idvehicule");
                $verQ->bindParam(':iduser', $iduser, PDO::PARAM_INT);
                $verQ->bindParam(':idvehicule', $idvehicule, PDO::PARAM_INT);
                $verQ->execute();
                $oldNote = $verQ->fetch(PDO::FETCH_ASSOC);
                if (!$oldNote){ // car l user a le droit dajouter une seul note   
                $query = $pdo->prepare("INSERT INTO NoteVehicule(idUtil, codeveh, NoteVehicule) VALUES (:iduser, :idvehicule, :note)");
                $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
                $query->bindParam(':idvehicule', $idvehicule, PDO::PARAM_INT);
                $query->bindParam(':note', $note, PDO::PARAM_STR);
                $query->execute();
                $db->disconnect($pdo);
                return true; 
                }
            } catch (Exception $e) {
                echo "Erreur";
            }
        }

    public function getNoteVehbyUser($idvehicule,$iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM NoteVehicule WHERE idUtil = :iduser AND codeveh = :idvehicule");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $query->bindParam(':idvehicule', $idvehicule, PDO::PARAM_STR);
            $query->execute();
            $Note = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Note;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function AddNoteMarque($iduser,$idmarque,$note){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $verQ = $pdo->prepare("SELECT * FROM NoteMarque WHERE idUtilis= :iduser AND CodeMarq= :idmarque");
            $verQ->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $verQ->bindParam(':idmarque', $idmarque, PDO::PARAM_INT);
            $verQ->execute();
            $oldNote = $verQ->fetch(PDO::FETCH_ASSOC);
            if (!$oldNote){ 
                $query = $pdo->prepare("INSERT INTO NoteMarque(idUtilis,CodeMarq,NoteMarque) VALUES (:iduser, :idmarque, :note)");
                $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
                $query->bindParam(':idmarque', $idmarque, PDO::PARAM_STR);
                $query->bindParam(':note', $note, PDO::PARAM_STR);
                $query->execute();
                $db->disconnect($pdo);
                return true;
            }
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function getNoteMarquebyUser($idmarque,$iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM NoteMarque WHERE idUtilis = :iduser AND CodeMarq = :idmarque");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $query->bindParam(':idmarque', $idmarque, PDO::PARAM_STR);
            $query->execute();
            $Note = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Note;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }
    
    public function AddAvisVeh($idvehicule,$iduser,$Avis){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("INSERT INTO AvisVehicule(idUserAvisVeh,CodeVehicule,contenuAvis,AvisValide,Avisrefuse) VALUES (:iduser, :idvehicule, :Avis,0,0)");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $query->bindParam(':idvehicule', $idvehicule, PDO::PARAM_STR);
            $query->bindParam(':Avis', $Avis, PDO::PARAM_STR);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function AddAvisMarque($idmarque,$iduser,$Avis){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("INSERT INTO AvisMarque(idUserAvisMarque,Codemarque,commentaire,Avisrefusee,AvisValidee) VALUES (:iduser, :idmarque, :Avis,0,0)");
            $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);
            $query->bindParam(':idmarque', $idmarque, PDO::PARAM_STR);
            $query->bindParam(':Avis', $Avis, PDO::PARAM_STR);
            $query->execute();
            $db->disconnect($pdo);
        } catch (Exception $e) {
            echo "Erreur";
        }
    }
///// ******************************************************** /////
    public function getAppr($idAvis,$iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT idAppreciationVeh FROM AppreciationVeh WHERE CodeAvisV = :idavis AND idUserAppr = :iduser");
            $query->bindParam(':idavis', $idAvis, PDO::PARAM_INT);
            $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $query->execute();
            $Appr = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Appr;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function getApprM($idAvis,$iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT idAppreciationMarque FROM AppreciationMarque WHERE CodeAvisM = :idavis AND idUserApprM = :iduser");
            $query->bindParam(':idavis', $idAvis, PDO::PARAM_INT);
            $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $query->execute();
            $Appr = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $Appr;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function Appreciervehicule($idAvis,$adresse){ 
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $user = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :adresse  AND etat = 'user' AND EtatCompte ='actif'");
            $user->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $user->execute();
            $iduser = $user->fetch(PDO::FETCH_ASSOC);
        
            $appr = $this->getAppr($idAvis,$iduser['idUser']);
            if (!$appr){ // to not insert si laapreciation existe deja 
                $Apprquery = $pdo->prepare("INSERT INTO AppreciationVeh(CodeAvisV,idUserAppr) VALUES (:idavis, :iduser)"); 
                $Apprquery->bindParam(':idavis', $idAvis, PDO::PARAM_INT);
                $Apprquery->bindParam(':iduser', $iduser['idUser'], PDO::PARAM_INT);  
                $Apprquery->execute();
                return "true";
            }
            $db->disconnect($pdo);
               return "false";
        } catch (Exception $e) {
            echo "Erreur";
        }
    }  

    public function ApprecierM($idAvis,$adresse){ 
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $user = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :adresse  AND etat = 'user' AND EtatCompte ='actif'");
            $user->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $user->execute();
            $iduser = $user->fetch(PDO::FETCH_ASSOC);
            $appr = $this->getApprM($idAvis,$iduser['idUser']);
            if (!$appr){ // to not insert si laapreciation existe deja 
                $Apprquery = $pdo->prepare("INSERT INTO AppreciationMarque(CodeAvisM,idUserApprM) VALUES (:idavis, :iduser)"); 
                $Apprquery->bindParam(':idavis', $idAvis, PDO::PARAM_INT);
                $Apprquery->bindParam(':iduser', $iduser['idUser'], PDO::PARAM_INT);  
                $Apprquery->execute();
                return "true";
            }
            $db->disconnect($pdo);
               return "false";
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function DeAppreciervehicule($idAvis,$adresse){ 
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $user = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :adresse  AND etat = 'user' AND EtatCompte ='actif'");
            $user->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $user->execute();
            $iduser = $user->fetch(PDO::FETCH_ASSOC);
        
            $appr = $this->getAppr($idAvis,$iduser['idUser']);
            if ($appr){ // delete lappreciation
                $Apprquery = $pdo->prepare("DELETE FROM AppreciationVeh WHERE CodeAvisV= :idavis AND idUserAppr = :iduser"); 
                $Apprquery->bindParam(':idavis', $idAvis, PDO::PARAM_INT);
                $Apprquery->bindParam(':iduser', $iduser['idUser'], PDO::PARAM_INT);  
                $Apprquery->execute();
                return "true";
            }
            $db->disconnect($pdo);
            return "false";
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function DeApprecierM($idAvis,$adresse){ 
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $user = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :adresse  AND etat = 'user' AND EtatCompte ='actif'");
            $user->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $user->execute();
            $iduser = $user->fetch(PDO::FETCH_ASSOC);
            $appr = $this->getApprM($idAvis,$iduser['idUser']);
            if ($appr){ // delete lappreciation
                $Apprquery = $pdo->prepare("DELETE FROM AppreciationMarque WHERE CodeAvisM= :idavis AND idUserApprM = :iduser"); 
                $Apprquery->bindParam(':idavis', $idAvis, PDO::PARAM_INT);
                $Apprquery->bindParam(':iduser', $iduser['idUser'], PDO::PARAM_INT);  
                $Apprquery->execute();
                return "true";
            }
            $db->disconnect($pdo);
            return "false";
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    //trouver si un vehicule est favoris dun user et retourner idFavoris si true
    public function getFavorisVehiculeuser($idveh,$iduser){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT idFavori FROM FavorisVehicule WHERE CodeVehicule = :idveh AND idUtilisateur = :iduser");
            $query->bindParam(':idveh', $idveh, PDO::PARAM_INT);
            $query->bindParam(':iduser', $iduser, PDO::PARAM_INT);
            $query->execute();
            $favVeh = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $favVeh;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function addfavorisveh($idvehicule,$adresse){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $user = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :adresse  AND etat = 'user' AND EtatCompte ='actif'");
            $user->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $user->execute();
            $iduser = $user->fetch(PDO::FETCH_ASSOC);
        
            $FavVeh = $this->getFavorisVehiculeuser($idvehicule,$iduser['idUser']);
            if (!$FavVeh){ // to not add des doubles in favoris
                $Favquery = $pdo->prepare("INSERT INTO FavorisVehicule(idUtilisateur,CodeVehicule) VALUES (:iduser, :idVeh)"); 
                $Favquery->bindParam(':iduser', $iduser['idUser'], PDO::PARAM_INT);
                $Favquery->bindParam(':idVeh', $idvehicule, PDO::PARAM_INT);  
                $Favquery->execute();
                return "true";
            }
            $db->disconnect($pdo);
               return "false";
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function removefavorisveh($idvehicule,$adresse){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $user = $pdo->prepare("SELECT idUser FROM User WHERE Adresse_mail = :adresse OR username = :adresse  AND etat = 'user' AND EtatCompte ='actif'");
            $user->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $user->execute();
            $iduser = $user->fetch(PDO::FETCH_ASSOC);
        
            $FavVeh = $this->getFavorisVehiculeuser($idvehicule,$iduser['idUser']);
            if ($FavVeh){ // delete favoris
                $Favquery = $pdo->prepare("DELETE FROM FavorisVehicule WHERE idUtilisateur= :userid AND CodeVehicule = :idveh"); 
                $Favquery->bindParam(':userid', $iduser['idUser'], PDO::PARAM_INT);
                $Favquery->bindParam(':idveh', $idvehicule, PDO::PARAM_INT);  
                $Favquery->execute();
                return "true";
            }
            $db->disconnect($pdo);
            return "false";
        } catch (Exception $e) {
            echo "Erreur";
        }
    } 

    //tous les avis des vehicules
    public function getAvisVeh(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $Avis = $db->request($pdo,"SELECT * FROM AvisVehicule LEFT JOIN Vehicule ON Vehicule.idVehicule = AvisVehicule.CodeVehicule 
            LEFT JOIN User ON AvisVehicule.idUserAvisVeh = User.idUser 
            WHERE Avisrefuse= 0 ORDER BY AvisVehicule.AvisValide ASC"); // ASC cuz i want les avis non validés dabord (avisvalide == o) puis les avis valides
            $db->disconnect($pdo);
            return $Avis;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    //tous les avis des marques
    public function getAvisMarques(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $Avis = $db->request($pdo,"SELECT * FROM AvisMarque LEFT JOIN Marque ON Marque.idMarque = AvisMarque.Codemarque LEFT JOIN User ON AvisMarque.idUserAvisMarque = User.idUser 
            WHERE Avisrefusee= 0 ORDER BY AvisMarque.AvisValidee ASC"); 
            $db->disconnect($pdo);
            return $Avis;
        } catch (Exception $e) {
            echo "Erreur";
        }
    }

    public function Valideravisveh($idavis){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("UPDATE AvisVehicule SET AvisValide = 1 WHERE idAvisVeh = :idavis");
            $query->bindParam(':idavis', $idavis, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function ValideravisM($idavis){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("UPDATE AvisMarque SET AvisValidee = 1 WHERE idAvisMarque = :idavis");
            $query->bindParam(':idavis', $idavis, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }

    public function refuseAvisVeh($idavis){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("DELETE FROM AppreciationVeh WHERE CodeAvisV = :idavis");
            $query->bindParam(':idavis', $idavis, PDO::PARAM_INT);
            $query->execute();
            $query = $pdo->prepare("UPDATE AvisVehicule SET Avisrefuse = 1 WHERE idAvisVeh = :idavis");
            $query->bindParam(':idavis', $idavis, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }
    public function refuseAvisM($idavis){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("DELETE FROM AppreciationMarque WHERE CodeAvisM = :idavis");
            $query->bindParam(':idavis', $idavis, PDO::PARAM_INT);
            $query->execute();
            $query = $pdo->prepare("UPDATE AvisMarque SET Avisrefusee = 1 WHERE idAvisMarque = :idavis");
            $query->bindParam(':idavis', $idavis, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
            return "true";
        }catch(Exception $e){
            echo "Erreur" ;
        }
    }


}

?>