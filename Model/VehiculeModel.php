<?php 

require_once '../Controller/dbController.php';

class VehiculeModel{

    public function getAllVehicules(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $Vehicules = $db->request($pdo, "SELECT * FROM Vehicule LEFT JOIN Marque ON Vehicule.CodeMarque  = Marque.idMarque  ORDER BY Marque.idMarque;");
            $db->disconnect($pdo);
            return $Vehicules;
        } catch(Exception $e){
            echo "Problem dans la recuperation des vehicules" ;
        }
    }

    public function getAllMrques(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $Marques = $db->request($pdo, "SELECT idMarque,NomMarque FROM Marque");
            $db->disconnect($pdo);
            return $Marques;
        } catch(Exception $e){
            echo "Problem dans la recuperation des marques" ;
        }
    } 

    public function getAllMrquesWithInfos(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $Marques = $db->request($pdo, "SELECT * FROM Marque");
            $db->disconnect($pdo);
            return $Marques;
        } catch(Exception $e){
            echo "Problem dans la recuperation des marques" ;
        }
    }

    public function AjoutVehicule($modele, $image, $version, $annee, $moteur, $performance, $dimensions, $puissance, $capacite, $consommation, $tarif, $marque){
        try {
            $db = new dbController();
            $pdo = $db->connect();
    
            // Verification si un vehicule similaire existe deja
            $VerfiVehQuery = $pdo->prepare("SELECT idVehicule FROM Vehicule WHERE ModeleVehicule = :modele AND VersionVehicule = :version AND AnneeVehicule = :annee AND Moteur = :moteur AND Performance = :performance AND Dimensions = :dimensions AND Puissance = :puissance AND Capacite = :capacite AND Consommation = :consommation AND tarif = :tarif AND CodeMarque = :codeMarque");
            $VerfiVehQuery->bindParam(':modele', $modele, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':version', $version, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':annee', $annee, PDO::PARAM_INT);
            $VerfiVehQuery->bindParam(':moteur', $moteur, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':performance', $performance, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':dimensions', $dimensions, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':puissance', $puissance, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':capacite', $capacite, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':consommation', $consommation, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':tarif', $tarif, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':codeMarque', $marque, PDO::PARAM_INT);
            $VerfiVehQuery->execute();
            $ExistVeh = $VerfiVehQuery->fetch(PDO::FETCH_ASSOC);
            if (!$ExistVeh) { // Ce vehicule n existe pas en BDD
                $query = $pdo->prepare("INSERT INTO Vehicule (ModeleVehicule, VersionVehicule, AnneeVehicule, Moteur, Performance, Dimensions, Puissance, Capacite, Consommation, tarif, ImageVehicule, CodeMarque) VALUES (:modele, :version, :annee, :moteur, :performance, :dimensions, :puissance, :capacite, :consommation, :tarif, :image, :codeMarque)");
                $query->bindParam(':modele', $modele, PDO::PARAM_STR);
                $query->bindParam(':version', $version, PDO::PARAM_STR);
                $query->bindParam(':annee', $annee, PDO::PARAM_INT);
                $query->bindParam(':moteur', $moteur, PDO::PARAM_STR);
                $query->bindParam(':performance', $performance, PDO::PARAM_STR);
                $query->bindParam(':dimensions', $dimensions, PDO::PARAM_STR);
                $query->bindParam(':puissance', $puissance, PDO::PARAM_STR);
                $query->bindParam(':capacite', $capacite, PDO::PARAM_STR);
                $query->bindParam(':consommation', $consommation, PDO::PARAM_STR);
                $query->bindParam(':tarif', $tarif, PDO::PARAM_STR);
                $query->bindParam(':image', $image, PDO::PARAM_STR);
                $query->bindParam(':codeMarque', $marque, PDO::PARAM_INT);
                $query->execute();
                $db->disconnect($pdo);
            } else { // si un vehicule avec les memes caracteristiques existe deja en BDD
                echo "Ce vehicule existe deja.";
            }
        } catch (Exception $e) {
            echo "Probleme d ajout du vehicule : " . $e->getMessage();
        }
    } 

    public function supprVehicule($id_vehicule){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            // il faut supprimer de la table Comparaison ou il existe le vehicule
            $Compquery = $pdo->prepare("DELETE FROM Comparaison WHERE idVehicule1 = :id_vehicule OR idVehicule2 = :id_vehicule OR idVehicule3 = :id_vehicule OR idVehicule4 = :id_vehicule");
            $Compquery->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $Compquery->execute();
            // table Appreciation 
            $Appr= $pdo->prepare("DELETE FROM AppreciationVeh WHERE CodeAvisV IN (SELECT idAvisVeh FROM AvisVehicule WHERE CodeVehicule = :id_vehicule)");
            $Appr->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $Appr->execute();
            // les avis 
            $Avisquery = $pdo->prepare("DELETE FROM AvisVehicule WHERE CodeVehicule = :id_vehicule");
            $Avisquery->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $Avisquery->execute();
            //table Note vehicule
            $NoteQ = $pdo->prepare("DELETE FROM NoteVehicule WHERE codeveh = :id_vehicule");
            $NoteQ->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $NoteQ->execute();
            $FavorisQ = $pdo->prepare("DELETE FROM FavorisVehicule WHERE CodeVehicule = :id_vehicule"); // favoris
            $FavorisQ->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $FavorisQ->execute();
            // finallyyy la table vehicule
            $queryVehicule = $pdo->prepare("DELETE FROM Vehicule WHERE idVehicule = :id_vehicule");
            $queryVehicule->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $queryVehicule->execute();

            $db->disconnect($pdo);
        } catch(Exception $e){
            echo "Problème dans la suppression du véhicule";
        }
    }
    

    public function getEditVehicule($id_vehicule){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT * FROM Vehicule LEFT JOIN Marque ON Vehicule.CodeMarque = Marque.idMarque WHERE idVehicule = :id_vehicule');
            $query->bindParam(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $query->execute();
            $vehicule = $query->fetch(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $vehicule;
        } catch (Exception $e) {
            echo "Probleme lors du recherche du vehicule a edité" ;
        }
    }


    public function ModifierVehicule($id_vehicule,$modele,$version,$annee,$moteur,$performance,$dimensions,$puissance,$capacite,$consommation,$tarif,$marque,$pathimage){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $VerfiVehQuery = $pdo->prepare("SELECT idVehicule FROM Vehicule WHERE ModeleVehicule = :modele AND VersionVehicule = :version AND AnneeVehicule = :annee AND Moteur = :moteur AND Performance = :performance AND Dimensions = :dimensions AND Puissance = :puissance AND Capacite = :capacite AND Consommation = :consommation AND tarif = :tarif AND CodeMarque = :codeMarque AND idVehicule != :idVehicule");
            $VerfiVehQuery->bindParam(':modele', $modele, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':version', $version, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':annee', $annee, PDO::PARAM_INT);
            $VerfiVehQuery->bindParam(':moteur', $moteur, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':performance', $performance, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':dimensions', $dimensions, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':puissance', $puissance, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':capacite', $capacite, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':consommation', $consommation, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':tarif', $tarif, PDO::PARAM_STR);
            $VerfiVehQuery->bindParam(':codeMarque', $marque, PDO::PARAM_INT);
            $VerfiVehQuery->bindParam(':idVehicule', $id_vehicule, PDO::PARAM_INT);
            $VerfiVehQuery->execute();
            $ExistVeh = $VerfiVehQuery->fetch(PDO::FETCH_ASSOC);
            if (!$ExistVeh) { // No other vehicule avec les mêmes caracteristiques (nouvelles caracteristiques) -> on modifie
                $query = $pdo->prepare("UPDATE Vehicule SET ModeleVehicule = :modele, VersionVehicule = :version, AnneeVehicule = :annee, Moteur = :moteur, Performance = :performance, Dimensions = :dimensions, Puissance = :puissance, Capacite = :capacite, Consommation = :consommation, tarif = :tarif, ImageVehicule = :image, CodeMarque = :codeMarque WHERE idVehicule = :idVehicule");
                $query->bindParam(':modele', $modele, PDO::PARAM_STR);
                $query->bindParam(':version', $version, PDO::PARAM_STR);
                $query->bindParam(':annee', $annee, PDO::PARAM_INT);
                $query->bindParam(':moteur', $moteur, PDO::PARAM_STR);
                $query->bindParam(':performance', $performance, PDO::PARAM_STR);
                $query->bindParam(':dimensions', $dimensions, PDO::PARAM_STR);
                $query->bindParam(':puissance', $puissance, PDO::PARAM_STR);
                $query->bindParam(':capacite', $capacite, PDO::PARAM_STR);
                $query->bindParam(':consommation', $consommation, PDO::PARAM_STR);
                $query->bindParam(':tarif', $tarif, PDO::PARAM_STR);
                $query->bindParam(':image', $$pathimage, PDO::PARAM_STR);
                $query->bindParam(':codeMarque', $marque, PDO::PARAM_INT);
                $query->bindParam(':idVehicule', $id_vehicule, PDO::PARAM_INT);
                $query->execute();
                $db->disconnect($pdo);
            } else {
                echo "Un autre vehicule avec ces caracteristiques existe deja.";
            }
        } catch (Exception $e) {
            echo "Probleme de modification du vehicule : " . $e->getMessage();
        }
    }

    public function AjoutMarque($nomMarque, $paysOrigine, $siegeSocial, $anneeCreation, $imageLogo) {
        try {
            $db = new dbController();
            $pdo = $db->connect();
            // Verifier si une marque similaire existe déjà (ie meme nom)
            $verifMarqueQuery = $pdo->prepare("SELECT idMarque FROM Marque WHERE NomMarque = :nomMarque");
            $verifMarqueQuery->bindParam(':nomMarque', $nomMarque, PDO::PARAM_STR);
            $verifMarqueQuery->execute();
            if (!$verifMarqueQuery->fetch()) { // Cette marque n existe pas dans la BDD
                $query = $pdo->prepare("INSERT INTO Marque (NomMarque, PaysOrigine, SiegeSocial, AnneeCreation, ImageLogo) VALUES (:nomMarque, :paysOrigine, :siegeSocial, :anneeCreation, :imageLogo)");
                $query->bindParam(':nomMarque', $nomMarque, PDO::PARAM_STR);
                $query->bindParam(':paysOrigine', $paysOrigine, PDO::PARAM_STR);
                $query->bindParam(':siegeSocial', $siegeSocial, PDO::PARAM_STR);
                $query->bindParam(':anneeCreation', $anneeCreation, PDO::PARAM_INT);
                $query->bindParam(':imageLogo', $imageLogo, PDO::PARAM_STR);
                $query->execute();
            } else {
                echo "Cette marque existe deja";
            }
            $db->disconnect($pdo);
        } catch (Exception $e) {
            echo "Probleme d ajout de la marque : " . $e->getMessage();
        }
    }

    public function supprMarque($id_marque){ // ie supprimer la marque et tous les vehicules de cette marque
        // supprimer les avis sur cette marque et les commentaire aussi 
        $db = new dbController();
        $pdo = $db->connect();
        // Appel suppressin veh car on peut juste suppr un vehicule, il faut supprimer les avis...
        $vehiculeQuery = $pdo->prepare("SELECT idVehicule FROM Vehicule WHERE CodeMarque = :id_marque");
        $vehiculeQuery->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $vehiculeQuery->execute();
        $vehicules = $vehiculeQuery->fetchAll(PDO::FETCH_ASSOC);

        foreach ($vehicules as $vehicule) {
            $this->supprVehicule($vehicule['idVehicule']);
        }
        // appr
        $Apprquery = $pdo->prepare("DELETE FROM AppreciationMarque WHERE CodeAvisM IN (SELECT idAvisMarque FROM AvisMarque WHERE Codemarque = :id_marque)");
        $Apprquery->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $Apprquery->execute();
        // commentaires
        $Avquery = $pdo->prepare("DELETE FROM AvisMarque WHERE Codemarque = :id_marque");
        $Avquery->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $Avquery->execute();
        // notes
        $notequery = $pdo->prepare("DELETE FROM NoteMarque WHERE CodeMarq = :id_marque");
        $notequery->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $notequery->execute();
        // marque
        $marqueQuery = $pdo->prepare("DELETE FROM Marque WHERE idMarque = :id_marque");
        $marqueQuery->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $marqueQuery->execute();
        $db->disconnect($pdo);
    }

    public function getEditMarque($id_marque){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT * FROM Marque WHERE idMarque = :id_marque');
            $query->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
            $query->execute();
            $marque = $query->fetch(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $marque;
        } catch (Exception $e) {
            echo "Probleme lors du recherche du marque a edité";
        }
    }

    public function ModifierMarque($id_marque,$NomMarque,$PaysOrigine,$SiegeSocial,$AnneeCreation,$imageLogo){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            //verfier que le nouveau nom de marque n'existe pas deja 
            $Verfiquery = $pdo->prepare("SELECT idMarque FROM Marque WHERE NomMarque = :nomMarque AND idMarque != :idMarque");
            $Verfiquery->bindParam(':nomMarque', $NomMarque, PDO::PARAM_STR);
            $Verfiquery->bindParam(':idMarque', $id_marque, PDO::PARAM_INT);
            $Verfiquery->execute();
            $result = $Verfiquery->fetchAll();
            if (count($result) > 0) {
                echo "marque avec le meme nom existe deja";
                return;
            }
            // else
            $query = $pdo->prepare("UPDATE Marque SET NomMarque = :nomMarque, PaysOrigine = :paysOrigine, SiegeSocial = :siegeSocial, AnneeCreation = :anneeCreation, ImageLogo = :imageLogo WHERE idMarque = :idMarque");
            $query->bindParam(':nomMarque', $NomMarque, PDO::PARAM_STR);
            $query->bindParam(':paysOrigine', $PaysOrigine, PDO::PARAM_STR);
            $query->bindParam(':siegeSocial', $SiegeSocial, PDO::PARAM_STR);
            $query->bindParam(':anneeCreation', $AnneeCreation, PDO::PARAM_INT);
            $query->bindParam(':imageLogo', $imageLogo, PDO::PARAM_STR);
            $query->bindParam(':idMarque', $id_marque, PDO::PARAM_INT);
            $query->execute();
            $db->disconnect($pdo);
        } catch (Exception $e) {
            echo "Probleme dans la modification de la marque : " . $e->getMessage();
        }
    }

    public function getCaracteristiqueVeh($idVehicule){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM Vehicule LEFT JOIN Marque ON Vehicule.CodeMarque = Marque.idMarque WHERE idVehicule = :id_vehicule");
            $query->bindParam(':id_vehicule', $idVehicule, PDO::PARAM_INT);
            $query->execute();
            $caracteristiques = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            return $caracteristiques;
        }catch (Exception $e) {
            echo "Probleme dans getCaracteristiqueVeh";
        }
    }


    public function getLogosPrincipalMarques() {
    // j'ai travaille sur le principe de "les principales marques sont les marques qui ont la note moyenne la plus grande.
    // i will choose 7 marques
    // je vais retourner le id de la marque aussi pour acceder à la page details marque -- i need NomMarque et logo too
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $logosMarques = $db->request($pdo, "SELECT idMarque, NomMarque, ImageLogo, AVG(NoteMarque) as moyenne
                FROM Marque 
                LEFT JOIN NoteMarque ON Marque.idMarque = NoteMarque.CodeMarq
                GROUP BY Marque.idMarque
                ORDER BY moyenne DESC
                LIMIT 7");

            $db->disconnect($pdo);

            return $logosMarques;
        } catch(Exception $e) {
            echo "Problème dans la récupération des logos des marques : " . $e->getMessage();
        }
    }

    public function getAllModeleOfMarque($idmarque){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT ModeleVehicule FROM Vehicule LEFT JOIN Marque ON Vehicule.CodeMarque = Marque.idMarque WHERE idMarque = :id_marque');
            $query->bindParam(':id_marque', $idmarque, PDO::PARAM_INT);
            $query->execute();
            $modeles = $query->fetchAll(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $modeles;
        } catch (Exception $e) {
            echo "Probleme lors du recherche des modeles" ;
        }
    }

    public function getAllVersionsOfModele($idmodele){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT VersionVehicule FROM Vehicule WHERE ModeleVehicule = :id_modele');
            $query->bindParam(':id_modele', $idmodele, PDO::PARAM_STR);
            $query->execute();
            $versions = $query->fetchAll(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $versions;
        } catch (Exception $e) {
            echo "Probleme lors du recherche des versions";
        } 
    }

    public function getAllAnneesOfModeleANDversion($idmodele,$idVersion){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT AnneeVehicule FROM Vehicule WHERE ModeleVehicule = :id_modele AND VersionVehicule = :id_version');
            $query->bindParam(':id_modele', $idmodele, PDO::PARAM_STR);
            $query->bindParam(':id_version', $idVersion, PDO::PARAM_STR);
            $query->execute();
            $annees = $query->fetchAll(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $annees;
        } catch (Exception $e) {
            echo "Probleme lors du recherche des annees";
        } 
    }

    // calcul note vehicule -- moyenne de toutes les notes (/5)
    public function getNoteVehicule($idVehicule){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT AVG(NoteVehicule) as moyenne FROM NoteVehicule WHERE codeveh = :id_vehicule');
            $query->bindParam(':id_vehicule', $idVehicule, PDO::PARAM_INT);
            $query->execute();
            $moyenne = $query->fetch(PDO::FETCH_ASSOC);    
            $db->disconnect($pdo);
            $note = $moyenne['moyenne']> 0 ? $moyenne['moyenne'] : 0; // for the case ou il ya pas de note -- 0
            return $note;
            // return $moyenne;   
        } catch (Exception $e) {
            echo "Probleme lors du recherche de la moy";
        } 
    }

    public function getNoteMarque($idMarque){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare('SELECT AVG(NoteMarque) as moyenne FROM NoteMarque WHERE CodeMarq = :id_marque');
            $query->bindParam(':id_marque', $idMarque, PDO::PARAM_INT);
            $query->execute();
            $moyenne = $query->fetch(PDO::FETCH_ASSOC);    
            $db->disconnect($pdo);
            $note = $moyenne['moyenne']> 0 ? $moyenne['moyenne'] : 0; // for the case ou il ya pas de note -- 0
            return $note;
        } catch (Exception $e) {
            echo "Probleme lors du recherche de la moy";
        } 
    }

       
        public function getPrincipalesVehOfM($id_marque) {
             // j'ai travaille sur le principe de "les principales vehicules sont les vehicules qui ont la note moyenne la plus grande.
            // i will choose 5 vehicules
            // je vais retourner le id du veh aussi pour acceder à la page details vehicule
            try {
                $db = new dbController();
                $pdo = $db->connect();
                $query = $pdo->prepare("SELECT Vehicule.idVehicule, Vehicule.ModeleVehicule,Vehicule.ImageVehicule, AVG(NoteVehicule) as moyenne
                    FROM Vehicule LEFT JOIN NoteVehicule ON Vehicule.idVehicule = NoteVehicule.codeveh WHERE Vehicule.CodeMarque = :id_marque
                    GROUP BY Vehicule.idVehicule ORDER BY moyenne DESC LIMIT 5");
                $query->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
                $query->execute();
                $principVeh = $query->fetchAll(PDO::FETCH_ASSOC);
                $db->disconnect($pdo);
                return $principVeh;
            } catch (Exception $e) {
                echo "Problene";
            }
        }   
        
        public function getvehiculesBymarque($idmarque){
            try {
                $db = new dbController();
                $pdo = $db->connect();
                $query = $pdo->prepare('SELECT * FROM Vehicule WHERE CodeMarque = :id_marque');
                $query->bindParam(':id_marque', $idmarque, PDO::PARAM_INT);
                $query->execute();
                $veh = $query->fetchAll(PDO::FETCH_ASSOC); 
                $db->disconnect($pdo);
                return $veh;
            } catch (Exception $e) {
                echo "Probleme lors du recherche des veh" ;
            }
        }

}

?>





