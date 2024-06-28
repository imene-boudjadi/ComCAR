<?php 

require_once '../Controller/dbController.php';

class ComparaisonModel{
    public function PlusRechercheComparaison(){
        // je vais selectionner les 3 comparaisons 2 a 2 les plus recherches
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $Comparaisons = $db->request($pdo, "SELECT
            Comparaison.idComparaison AS idComparaison,
            v1.ModeleVehicule AS ModeleVehicule1,
            v1.VersionVehicule AS VersionVehicule1,
            v1.AnneeVehicule AS AnneeVehicule1,
            v1.Moteur AS Moteur1,
            v1.Performance AS Performance1,
            v1.Dimensions AS Dimensions1,
            v1.Puissance AS Puissance1,
            v1.Capacite AS Capacite1,
            v1.Consommation AS Consommation1,
            v1.tarif AS tarif1,
            v1.ImageVehicule AS ImageVehicule1,
            v2.ModeleVehicule AS ModeleVehicule2,
            v2.VersionVehicule AS VersionVehicule2,
            v2.AnneeVehicule AS AnneeVehicule2,
            v2.Moteur AS Moteur2,
            v2.Performance AS Performance2,
            v2.Dimensions AS Dimensions2,
            v2.Puissance AS Puissance2,
            v2.Capacite AS Capacite2,
            v2.Consommation AS Consommation2,
            v2.tarif AS tarif2,
            v2.ImageVehicule AS ImageVehicule2,
            m1.NomMarque As NomMarque1,
            m2.NomMarque As NomMarque2,
            m1.PaysOrigine As PaysOrigine1,
            m2.PaysOrigine As PaysOrigine2,
            m1.SiegeSocial As SiegeSocial1,
            m2.SiegeSocial As SiegeSocial2,
            m1.AnneeCreation As AnneeCreation1,
            m2.AnneeCreation As AnneeCreation2
        FROM Comparaison
        LEFT JOIN Vehicule AS v1 ON Comparaison.idVehicule1 = v1.idVehicule
        LEFT JOIN Marque AS m1 ON v1.CodeMarque = m1.idMarque
        LEFT JOIN Vehicule AS v2 ON Comparaison.idVehicule2 = v2.idVehicule
        LEFT JOIN Marque AS m2 ON v2.CodeMarque = m2.idMarque
        WHERE Comparaison.idVehicule3 IS NULL AND Comparaison.idVehicule4 IS NULL
        ORDER BY Comparaison.nbComp DESC
        LIMIT 3;");
            $db->disconnect($pdo);
            return $Comparaisons;
        } catch(Exception $e){
            echo "Problem dans la recuperation des comparaisons les plus recherches" ;
        }
    }


    public function TrouverVehicule($idmarque, $modele, $version, $annee) {
        try {
            $db = new dbController();
            $pdo = $db->connect();
            // SELECT idVehicule,ModeleVehicule,VersionVehicule,AnneeVehicule,Moteur,Performance,Dimensions,Puissance,Capacite,Consommation,tarif,ImageVehicule,CodeMarque
            $query = $pdo->prepare("SELECT * FROM Vehicule LEFT JOIN Marque ON Vehicule.CodeMarque = Marque.idMarque 
            WHERE CodeMarque = :idmarque AND ModeleVehicule = :modele AND VersionVehicule = :version AND AnneeVehicule = :annee ");
            $query->bindParam(':idmarque', $idmarque, PDO::PARAM_INT);
            $query->bindParam(':modele', $modele, PDO::PARAM_STR);
            $query->bindParam(':version', $version, PDO::PARAM_STR);
            $query->bindParam(':annee', $annee, PDO::PARAM_INT);
            $query->execute();
            $vehicule = $query->fetch(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $vehicule;
        } catch (Exception $e) {
            echo "Probleme dans recuperation de vehicule";
        }
    }
// trouver infos du vehicule mais avec le idVehicule
    public function TrouverInfosVehicule($idVehicule) {
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM Vehicule LEFT JOIN Marque ON Vehicule.CodeMarque = Marque.idMarque 
            WHERE Vehicule.idVehicule = :idvehicule");
            $query->bindParam(':idvehicule', $idVehicule, PDO::PARAM_INT);
            $query->execute();
            $vehicule = $query->fetch(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $vehicule;
        } catch (Exception $e) {
            echo "Probleme dans recuperation de vehicule";
        }
    }

    public function ComparerVehicules($data) {
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $idmarque1 = $data["idMarque1"];
            $modele1 = $data["Modele1"];
            $version1 = $data["Version1"];
            $annee1 = $data["Annee1"];
            $idmarque2 = $data["idMarque2"];
            $modele2 = $data["Modele2"];
            $version2 = $data["Version2"];
            $annee2 = $data["Annee2"];
            // vehocile 1 et 2 ne peut pas etre null -- deja verifie en js (avant ajax)
            $vehicule1 = $this->TrouverVehicule($idmarque1, $modele1,$version1,$annee1);
            $idVehicule1 = $vehicule1["idVehicule"];    
            $vehicule2 = $this->TrouverVehicule($idmarque2, $modele2,$version2, $annee2);
            $idVehicule2 = $vehicule2["idVehicule"];
            // par contre vehicule 3 et 4 can be null
            if (!is_null($data["idMarque3"])) {
                $idmarque3 = $data["idMarque3"];
                $modele3 = $data["Modele3"];
                $version3 = $data["Version3"];
                $annee3 = $data["Annee3"];
                $vehicule3 = $this->TrouverVehicule($idmarque3, $modele3,$version3,$annee3);
                $idVehicule3 = $vehicule3["idVehicule"];
            }else{
                $vehicule3 = null;
                $idVehicule3 = null;
            }
            if (!is_null($data["idMarque4"])) {
                $idmarque4 = $data["idMarque4"];
                $modele4 = $data["Modele4"];
                $version4 = $data["Version4"];
                $annee4 = $data["Annee4"];
                $vehicule4 = $this->TrouverVehicule($idmarque4, $modele4,$version4,$annee4);
                $idVehicule4 = $vehicule4["idVehicule"];
            }else {
                $vehicule4 = null;
                $idVehicule4 = null;
            }
            
            
            // // verifier si cette comparaison existe deja ou non 
            $idVehicules = [$idVehicule1, $idVehicule2, $idVehicule3, $idVehicule4];
            // je vais personnalise le sort car idVehicule 3 et 4 peut etre null, je veux les placer a la fin dans ce cas  
            usort($idVehicules, function ($a, $b) {
                if ($a === null && $b === null) {
                    return 0;
                } elseif ($a === null) {
                    return 1;
                } elseif ($b === null) {
                    return -1;
                } else {
                    return $a - $b;
                }
            });

            if (($idVehicules[2]!== null) && ($idVehicules[3]!== null)){
                $checkComp = $pdo->prepare("SELECT idComparaison FROM Comparaison WHERE idVehicule1 = :idVehicule1 AND idVehicule2 = :idVehicule2 AND idVehicule3 = :idVehicule3 AND idVehicule4 = :idVehicule4");
                $checkComp->bindParam(':idVehicule3', $idVehicules[2], PDO::PARAM_INT);
                $checkComp->bindParam(':idVehicule4', $idVehicules[3], PDO::PARAM_INT);
            }elseif (($idVehicules[2]=== null)){ // les ids ordonnees donc is idVehicule3 est null => idVehicule4 est null aussi
                $checkComp = $pdo->prepare("SELECT idComparaison FROM Comparaison WHERE idVehicule1 = :idVehicule1 AND idVehicule2 = :idVehicule2 AND idVehicule3 IS NULL AND idVehicule4 IS NULL");
            }else{ // ie si Vehicule 4 seulement null
                $checkComp = $pdo->prepare("SELECT idComparaison FROM Comparaison WHERE idVehicule1 = :idVehicule1 AND idVehicule2 = :idVehicule2 AND idVehicule3 = :idVehicule3 AND idVehicule4 IS NULL");
                $checkComp->bindParam(':idVehicule3', $idVehicules[2], PDO::PARAM_INT);
            }
            $checkComp->bindParam(':idVehicule1', $idVehicules[0], PDO::PARAM_INT);
            $checkComp->bindParam(':idVehicule2', $idVehicules[1], PDO::PARAM_INT);
            $checkComp->execute();
            $comparaisonExiste = $checkComp->fetch(PDO::FETCH_ASSOC);

            // si la comparaison existe deja en bdd
            // on incremente juste nbComp (nombre de comparasion)
            if ($comparaisonExiste) {
                $updateNbCompquery = $pdo->prepare("UPDATE Comparaison SET nbComp = nbComp + 1 WHERE idComparaison = :idComparaison");
                $updateNbCompquery->bindParam(':idComparaison', $comparaisonExiste['idComparaison'], PDO::PARAM_INT);
                $updateNbCompquery->execute();
            } else {
                // sinon (elle n'existe pas deja, on l'ajoute)
                $AddCompquery = $pdo->prepare("INSERT INTO Comparaison (idVehicule1, idVehicule2, idVehicule3, idVehicule4, nbComp) VALUES (:idVehicule1, :idVehicule2, :idVehicule3, :idVehicule4, 1)");
                $AddCompquery->bindParam(':idVehicule1', $idVehicules[0], PDO::PARAM_INT);
                $AddCompquery->bindParam(':idVehicule2', $idVehicules[1], PDO::PARAM_INT);
                $AddCompquery->bindParam(':idVehicule3', $idVehicules[2], PDO::PARAM_INT);
                $AddCompquery->bindParam(':idVehicule4', $idVehicules[3], PDO::PARAM_INT);
                $AddCompquery->execute();
            }

            // We need to recuperer les donnees des vehicules compares pour les afficher
            // on a deja ces infos de "TrouverVehicule"
            // merge so we can return them et aussi boucler dans comparateurView
            $vehicules = [$vehicule1,$vehicule2, $vehicule3, $vehicule4];
            $vehiculesNonNuls = array_filter($vehicules, function ($vehicule) { // pour envoyer que les vehicules non nuls (ie entrees pour etre comparees)
                return $vehicule !== false;
            });
            $db->disconnect($pdo);
                return $vehiculesNonNuls;
        } catch (Exception $e) {
            echo "Problème dans comparateur";
        }
    }

    public function PlusRechercheComparaisonbyid($idVehicule){
    // je vais selectionner les 3 comparaisons les plus recherches ou il ya le idVehicule
        try {
        $db = new dbController();
        $pdo = $db->connect();
        $query = $pdo->prepare("SELECT * FROM Comparaison
        WHERE (idVehicule1 = :id_vehicule OR idVehicule2 = :id_vehicule OR idVehicule3 = :id_vehicule OR idVehicule4 = :id_vehicule)
        ORDER BY nbComp DESC LIMIT 3");
        $query->bindParam(':id_vehicule', $idVehicule, PDO::PARAM_INT);
        $query->execute();
        $Comparaisons = $query->fetchAll(PDO::FETCH_ASSOC);
    
        // je vais recuperer les infos des vehicules
        $InfoComparaison = [];

        foreach ($Comparaisons as $Comparaison) {
            $vehicules = [];

            foreach (['idVehicule1', 'idVehicule2', 'idVehicule3', 'idVehicule4'] as $idVehicule) {
                $id = $Comparaison[$idVehicule];
                if ($id !== null) {
                    $vehicule = $this->TrouverInfosVehicule($id);
                    if ($vehicule !== null) {
                        $vehicules[] = $vehicule; // on ajoute les infos de ce veh
                    }
                }
            }
            $InfoComparaison[] = $vehicules;
        }
        $db->disconnect($pdo);
        return $InfoComparaison;
    } catch (Exception $e) {
        echo "Problem dans la recuperation des comparaisons les plus recherches" ;
    }
}

    
}

?>

