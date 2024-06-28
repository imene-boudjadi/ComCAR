<?php

require_once('../Controller/AvisController.php');

if(isset($_POST['datauser']) && ($_POST['dataAvis']) ){  //apprecier avis vehicule
    $idAvis = $_POST['dataAvis'];
    $adresse = $_POST['datauser'];
    $AvisController = new AvisController();
    $rep = $AvisController->Apprecierveh($idAvis,$adresse);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['dataauser']) && ($_POST['dataaAvis']) ){  //deapprecier avis vehicule
    $idAvis = $_POST['dataaAvis'];
    $adresse = $_POST['dataauser'];
    $AvisController = new AvisController();
    $rep = $AvisController->DeApprecierveh($idAvis,$adresse);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['adressuser']) && ($_POST['dataveh']) ){  //Add favoris veh
    $idvehicule = $_POST['dataveh'];
    $adresse = $_POST['adressuser'];
    $AvisController = new AvisController();
    $rep = $AvisController->AddFavoris($idvehicule,$adresse);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['Adress']) && ($_POST['Vehicule']) ){  //Remove vehicule from favoris 
    $idvehicule = $_POST['Vehicule'];
    $adresse = $_POST['Adress'];
    $AvisController = new AvisController();
    $rep = $AvisController->RemoveFavoris($idvehicule,$adresse);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['AdressAddnote']) && ($_POST['VehiculeAddnote']) && ($_POST['note']) ){  //ajouter note vehicule 
    $idvehicule = $_POST['VehiculeAddnote'];
    $adresse = $_POST['AdressAddnote'];
    $note = $_POST['note'];
    $AvisController = new AvisController();
    $rep = $AvisController->AddNote($idvehicule,$adresse,$note);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['datauserM']) && ($_POST['dataAvisM']) ){  //apprecier avis marque
    $idAvis = $_POST['dataAvisM'];
    $adresse = $_POST['datauserM'];
    $AvisController = new AvisController();
    $rep = $AvisController->ApprecierMarque($idAvis,$adresse);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['dataauserMarque']) && ($_POST['dataaAvisMarque']) ){  //deapprecier avis marque
    $idAvis = $_POST['dataaAvisMarque'];
    $adresse = $_POST['dataauserMarque'];
    $AvisController = new AvisController();
    $rep = $AvisController->DeApprecierMarque($idAvis,$adresse);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['AdresseAddNote']) && ($_POST['VehiculeAddnote']) && ($_POST['note'])){  // add note veh 
    $idveh = $_POST['VehiculeAddnote'];
    $adresse = $_POST['AdresseAddNote'];
    $note = $_POST['note'];
    $AvisController = new AvisController();
    $rep = $AvisController->AddNote($idveh,$adresse,$note);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['AdresseAddNoteM']) && ($_POST['MarqueeAddnote']) && ($_POST['noteM'])){  // add note veh 
    $idmarque = $_POST['MarqueeAddnote'];
    $adresse = $_POST['AdresseAddNoteM'];
    $note = $_POST['noteM'];
    $AvisController = new AvisController();
    $rep = $AvisController->AddNoteM($idmarque,$adresse,$note);
    header('Content-Type: application/json');
    echo json_encode($rep);
}

if(isset($_POST['AdresseAddAvis']) && ($_POST['VehiculeAddAvis']) && ($_POST['Avis'])){  // add note veh 
    $idvehicule = $_POST['VehiculeAddAvis'];
    $adresse = $_POST['AdresseAddAvis'];
    $avis = $_POST['Avis'];
    $AvisController = new AvisController();
    $rep = $AvisController->AddAvis($idvehicule,$adresse,$avis);
    header('Content-Type: application/json');
    echo json_encode($rep);
}


?>