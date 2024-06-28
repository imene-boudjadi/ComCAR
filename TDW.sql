-- Script de creaation des tables de la BDD  

START TRANSACTION;
CREATE DATABASE IF NOT EXISTS tdwProjet;

use tdwProjet;
 

CREATE TABLE IF NOT EXISTS User(
    idUser int primary key not null auto_increment,
    NomUser varchar(100),
    PrenomUser varchar(100),
    username varchar(100),
    Sexe enum('Feminin', 'Masculin'),
    DateNaissance date,
    Adresse_mail VARCHAR(100),
    MotDePasse VARCHAR(100),
    etat enum('user', 'admin'),
    EtatCompte enum('actif', 'bloque','supprime'),
    InscValide tinyint(1),
    Photo VARCHAR(200)
);

INSERT INTO User (NomUser, PrenomUser,username, Sexe, DateNaissance, Adresse_mail, MotDePasse, etat, EtatCompte, InscValide, Photo)
VALUES
    ('Boudjadi', 'Imene' ,'admin','Feminin', '2002-10-09', 'admin@esi.dz', 'admin', 'admin','actif', 1, "user_avatar3.png"),
    ('Boudjadi', 'Sabrine', 'imene' , 'Feminin', '1999-08-16', 'sabrinebj@gmail.com', 'test', 'user', 'bloque', 1, "uuser_avatar3.png"),
    ('Boudjadi', 'islem', 'islem01', 'Masculin', '1995-05-20', 'islem@gmail.com', 'password1', 'user', 'actif', 1, 'user_avatar01.avif'),
    ('Madi', 'shaima', 'Madishaima', 'Feminin', '1990-12-15', 'shaima20@gmail.com', 'password2', 'user', 'bloque', 1, 'user_avatar3.png'),
    ('Boudjadi', 'Abdelkader', 'Abdelkader', 'Masculin', '1988-07-03', 'Abdelkaderbj@gmail.com', 'password3', 'user', 'actif', 1, 'user_avatar01.avif'),
    ('Khermane', 'Amina', 'amina33', 'Feminin', '2007-03-02', 'Amina.k@gmail.com', 'password3', 'user', 'actif', 1, 'user_avatar3.png');


DROP TABLE IF EXISTS `Menu`;
CREATE TABLE IF NOT EXISTS Menu(
    idMenu int primary key not null auto_increment,
    NomElement VARCHAR(100) not null
);

INSERT INTO Menu (NomElement) 
VALUES
    ('Accueil'),
    ('News'),
    ('Comparateur'),
    ('Marques'),
    ('Avis'),
    ('Guides d''achat'),
    ('Contact');



CREATE TABLE  IF NOT EXISTS News(
    idNews int primary key not null auto_increment,
    TiteNews varchar(100),
    ContenuNews varchar(5000),
    ImageNews varchar(200),
    DateNews TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO News (TiteNews, ContenuNews, ImageNews)
VALUES
    ('Nouvelle Golf 2022 dévoilée', 'Volkswagen a récemment dévoilé la dernière version de sa populaire Golf, avec des améliorations significatives.', '../Images/NouvelleGolf2022.jpg'),
    ('Seat présente la nouvelle Leon', 'Seat a annoncé la sortie de la toute nouvelle Leon, avec un design élégant et des fonctionnalités avancées.', '../Images/NouvelleSeatLeon.jpg'),
    ('Toyota lance la nouvelle Corolla Hybrid', 'Toyota a introduit la dernière version de sa Corolla, désormais disponible en version hybride.', '../Images/NouvelleToyotaCorolla.jpg');

-- table qui contient les details des news

DROP TABLE IF EXISTS `DetailsNews`;
CREATE TABLE DetailsNews(
    idDetailsNews int primary key not null auto_increment,
    ParagrapheNews varchar(5000),
    ImageDetailsNews varchar(200),
    Codenews int not null,
    foreign key (Codenews) REFERENCES News(idNews)
);

INSERT INTO DetailsNews (ParagrapheNews, ImageDetailsNews, Codenews)
VALUES
    ('La nouvelle Golf 2022 offre une expérience de conduite exceptionnelle avec son moteur 1.5 TSI et des fonctionnalités de sécurité avancées.', '../Images/DetailsGolf1.jpg', 1),
    ('L intérieur de la Golf a été repensé pour offrir plus de confort et de technologie, avec un tableau de bord moderne et un système d infodivertissement dernier cri.', '../Images/DetailsGolf2.jpg', 1),
    ('Les options de personnalisation sont nombreuses, permettant aux conducteurs de choisir parmi une variété de couleurs, de finitions et d options de moteur.', '../Images/DetailsGolf3.jpg', 1),
    ('La nouvelle Leon de Seat se distingue par son design extérieur audacieux et ses lignes épurées.', '../Images/DetailsLeon1.jpg', 2),
    ('Avec des fonctionnalités telles que la connectivité avancée et les systèmes d''aide à la conduite, la Leon offre une expérience de conduite moderne et sûre.', '../Images/DetailsLeon2.jpg', 2),
    ('Les moteurs efficaces et les options de transmission offrent des performances optimales et une conduite agréable.', '../Images/DetailsLeon3.jpg', 2);


DROP TABLE IF EXISTS `Diaporama`;
CREATE TABLE IF NOT EXISTS Diaporama(
    idDiapo int primary key not null auto_increment,
    ImageDiapo varchar(200),
    LienNewsPub varchar(200),
    TypeDiapo enum('news','publicite')
);

INSERT INTO Diaporama (idDiapo, ImageDiapo, LienNewsPub,  TypeDiapo)
VALUES
    (1, './Images/Diapo1.jpeg', 'https://electrek.co/2023/12/13/fiat-to-release-a-new-bigger-panda-that-is-fully-electric/','news'),
    (2, './Images/Diapo2.jpeg', 'https://electrek.co/2023/12/13/fiat-to-release-a-new-bigger-panda-that-is-fully-electric/','news'),
    (3, './Images/Diapo3.jpeg', 'https://electrek.co/2023/12/13/fiat-to-release-a-new-bigger-panda-that-is-fully-electric/','publicite');



CREATE TABLE Marque(
    idMarque int primary key not null auto_increment,
    NomMarque varchar(100),
    PaysOrigine varchar(100),
    SiegeSocial varchar(100),
    AnneeCreation int(4),
    ImageLogo varchar(200)
);

INSERT INTO Marque (NomMarque, PaysOrigine, SiegeSocial, AnneeCreation, ImageLogo)
VALUES
    ('Volkswagen', 'Germany', 'Wolfsburg', 1937, '../Images/vw_logo.png'),
    ('Seat', 'Spain', 'Martorell', 1950, '../Images/seat_logo.png'),
    ('Toyota', 'Japon', 'Toyota City, Japon', 1937, '../Images/toyota_logo.png'),
    ('Ford', 'États-Unis', 'Dearborn, Michigan, États-Unis', 1903, '../Images/ford_logo.jpeg'),
    ('Honda', 'Japon', 'Tokyo, Japon', 1946, '../Images/honda_logo.png'),
    ('Chevrolet', 'États-Unis', 'Detroit, Michigan, États-Unis', 1911, '../Images/chevy_logo.png'),
    ('Nissan', 'Japon', 'Yokohama, Japon', 1933, '../Images/nissan_logo.png'),
    ('Mercedes-Benz', 'Allemagne', 'Stuttgart, Allemagne', 1926, '../Images/mercedes_logo.png'),
    ('Hyundai', 'Corée du Sud', 'Séoul, Corée du Sud', 1967, '../Images/hyundai_logo.png'),
    ('BMW', 'Allemagne', 'Munich, Allemagne', 1916, '../Images/bmw_logo.png'),
    ('Audi', 'Allemagne', 'Ingolstadt, Allemagne', 1909, '../Images/audi_logo.png');



CREATE TABLE Vehicule(
    idVehicule int primary key not null auto_increment,
    ModeleVehicule varchar(100),
    VersionVehicule varchar(10),
    AnneeVehicule int(4),
    Moteur varchar(100),
    Performance varchar(100), 
    Dimensions varchar(100),
    Puissance varchar(100),
    Capacite varchar(100),
    Consommation varchar(100),
    tarif float not null,
    ImageVehicule varchar(200),
    CodeMarque int not null,
    foreign key (CodeMarque) REFERENCES Marque(idMarque)
);

-- Volkswagen
INSERT INTO Vehicule (idVehicule, ModeleVehicule, VersionVehicule, AnneeVehicule, Moteur, Performance, Dimensions, Puissance, Capacite, Consommation, tarif, ImageVehicule, CodeMarque)
VALUES
    (1, 'Golf', '7', 2022, '1.5 TSI', '120 ch', '4.26m x 1.79m x 1.49m', '85 kW (115 ch)', '5 places', '5.1 L/100 km', 25000.00, '../Images/vw_golf.jpg', 1),
    (2, 'Passat', 'B8', 2022, '2.0 TDI', '150 ch', '4.77m x 1.83m x 1.47m', '110 kW (150 ch)', '5 places', '4.0 L/100 km', 35000.00, '../Images/vw_passat.jpg', 1),
    (3, 'Tiguan', '2', 2022, '1.5 TSI', '130 ch', '4.50m x 1.84m x 1.63m', '96 kW (130 ch)', '5 places', '6.1 L/100 km', 30000.00, '../Images/vw_tiguan.jpg', 1),
-- Seat
    (4, 'Ibiza', '5', 2022, '1.0 TSI', '110 ch', '4.06m x 1.78m x 1.44m', '81 kW (110 ch)', '5 places', '4.6 L/100 km', 18000.00, '../Images/seat_ibiza.jpg', 2),
    (5, 'Leon', '4', 2022, '1.5 TSI', '150 ch', '4.37m x 1.80m x 1.45m', '110 kW (150 ch)', '5 places', '5.7 L/100 km', 24000.00, '../Images/seat_leon.jpg', 2),
    (6, 'Ateca', '1', 2022, '1.5 TSI', '150 ch', '4.36m x 1.84m x 1.61m', '110 kW (150 ch)', '5 places', '6.0 L/100 km', 27000.00, '../Images/seat_ateca.jpg', 2),
-- Toyota
    (7, 'Corolla', '12', 2022, '1.8 Hybrid', '122 ch', '4.37m x 1.79m x 1.45m', '90 kW (122 ch)', '5 places', '3.3 L/100 km', 25000.00, '../Images/toyota_corolla.jpg', 3),
    (8, 'C-HR', '1', 2022, '2.0 Hybrid', '184 ch', '4.39m x 1.80m x 1.56m', '135 kW (184 ch)', '5 places', '4.4 L/100 km', 28000.00, '../Images/toyota_chr.jpg', 3),
    (9, 'Rav4', '5', 2022, '2.5 Hybrid', '218 ch', '4.60m x 1.85m x 1.69m', '160 kW (218 ch)', '5 places', '4.8 L/100 km', 32000.00, '../Images/toyota_rav4.jpg', 3),
-- Ford
    (10, 'Focus', '4', 2022, '1.0 EcoBoost', '125 ch', '4.38m x 1.83m x 1.47m', '92 kW (125 ch)', '5 places', '4.9 L/100 km', 20000.00, '../Images/ford_focus.jpg', 4),
    (11, 'Fiesta', '8', 2022, '1.0 EcoBoost', '95 ch', '4.04m x 1.74m x 1.47m', '70 kW (95 ch)', '5 places', '4.3 L/100 km', 16000.00, '../Images/ford_fiesta.jpg', 4),
    (12, 'Puma', '1', 2022, '1.0 EcoBoost', '125 ch', '4.19m x 1.81m x 1.54m', '92 kW (125 ch)', '5 places', '5.2 L/100 km', 22000.00, '../Images/ford_puma.jpg', 4),
-- Honda
    (13, 'Civic', '10', 2022, '1.0 VTEC Turbo', '126 ch', '4.52m x 1.80m x 1.43m', '93 kW (126 ch)', '5 places', '5.4 L/100 km', 23000.00, '../Images/honda_civic.jpg', 5),
    (14, 'CR-V', '5', 2022, '2.0 i-MMD Hybrid', '184 ch', '4.59m x 1.85m x 1.67m', '135 kW (184 ch)', '5 places', '5.3 L/100 km', 30000.00, '../Images/honda_cr-v.jpg', 5),
    (15, 'HR-V', '2', 2022, '1.5 i-VTEC', '130 ch', '4.33m x 1.77m x 1.58m', '96 kW (130 ch)', '5 places', '6.2 L/100 km', 25000.00, '../Images/honda_hr-v.jpg', 5);

DROP TABLE IF EXISTS `GuideAchat`;
CREATE TABLE IF NOT EXISTS GuideAchat(
    idConseil int primary key not null auto_increment,
    titreConseil VARCHAR(200),
    Conseil VARCHAR(1000)
);

INSERT INTO GuideAchat (titreConseil,Conseil) 
VALUES
    ('Définissez vos besoins et votre budget','Avant de commencer vos recherches, il est important de savoir ce que vous recherchez dans un véhicule. Quels sont vos besoins en termes de taille, de confort, de performance et surtout quel est votre budget ?'),
    ('Faites des recherches','Renseignez-vous sur les différents modèles de véhicules disponibles sur le marché. Comparez les caractéristiques, les prix et les avis des utilisateurs'),
    ('Essayez les véhicules qui vous intéressent','Une fois que vous avez réduit vos options, il est important de les essayer avant de prendre une décision. Cela vous permettra de vous faire une idée précise de leur confort et de leur performance'),
    ('Négociez le prix',"N'hésitez pas à négocier le prix du véhicule que vous souhaitez acheter. Vous pouvez généralement obtenir une remise");

DROP TABLE IF EXISTS `Comparaison`;
CREATE TABLE IF NOT EXISTS Comparaison(
    idComparaison int primary key not null auto_increment,
    idVehicule1 int,
    idVehicule2 int,
    idVehicule3 int,
    idVehicule4 int,
    nbComp int, -- dateComparaison TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    foreign key (idVehicule1) REFERENCES Vehicule(idVehicule),
    foreign key (idVehicule2) REFERENCES Vehicule(idVehicule),
    foreign key (idVehicule3) REFERENCES Vehicule(idVehicule),
    foreign key (idVehicule4) REFERENCES Vehicule(idVehicule)
);

INSERT INTO Comparaison (idComparaison,idVehicule1, idVehicule2, idVehicule3, idVehicule4,nbComp)
VALUES
    (1,1, 4, 7, 10, 11), 
    (2,2, 5, 8, 11, 2), 
    (3,3, 6, 9, 12, 3), 
    (4,4, 7, 10, NULL, 14), 
    (5,12, 8, 11, NULL, 5), 
    (6,4, 8, 11, NULL, 5), 
    (7,6, 9, 12, NULL, 1), 
    (8,9, 10, NULL, NULL, 7),
    (9,13, 11, NULL, NULL, 8), 
    (10,15, 12, NULL, NULL, 9);



DROP TABLE IF EXISTS `NoteVehicule`;
CREATE TABLE IF NOT EXISTS NoteVehicule (
    idNoteVehicule int not null primary key auto_increment,
    idUtil int,
    codeveh int,
    NoteVehicule float,
    foreign key (codeveh) references Vehicule(idVehicule),
    foreign key (idUtil) references User(idUser)
);


INSERT INTO NoteVehicule(idUtil,codeveh,NoteVehicule) VALUES
(2,15,5),
(2,1,2),
(3,1,4),
(4,2,3),
(5,3,5),
(2,11,3),
(6,14,2);

DROP TABLE IF EXISTS `NoteMarque`;
CREATE TABLE IF NOT EXISTS NoteMarque (
    idNoteMarque int not null primary key auto_increment,
    idUtilis int,
    CodeMarq int,
    NoteMarque float,
    foreign key (CodeMarq) references Marque(idMarque),
    foreign key (idUtilis) references User(idUser)
);

INSERT INTO NoteMarque(idUtilis,CodeMarq,NoteMarque) VALUES
(6,1,5),
(3,2,4),
(2,3,4.5),
(6,4,2.5),
(3,5,1),
(2,5,2),
(6,5,5),
(3,1,4),
(2,2,4);


CREATE TABLE IF NOT EXISTS AvisVehicule (
    idAvisVeh int not null primary key auto_increment,
    idUserAvisVeh int,
    CodeVehicule int,
    contenuAvis varchar(5000),
    AvisValide tinyint(1) default 0,
    Avisrefuse tinyint(1) default 0,
    foreign key (idUserAvisVeh) references User(idUser),
    foreign key (CodeVehicule) references Vehicule(idVehicule)
);


INSERT INTO AvisVehicule(idUserAvisVeh, CodeVehicule, contenuAvis, AvisValide, Avisrefuse)
VALUES
    (2, 1, "C'est un véhicule performant.", 1, 0),
    (2, 5, "C'est un peu cher.", 1, 0),
    (3, 12, "Il faut bien penser au prix avant d'acheter.", 0, 0),
    (4, 15, "Confortable.", 0, 1),
    (1, 14, "Je n'aime pas.", 1, 0);



CREATE TABLE IF NOT EXISTS AvisMarque (
    idAvisMarque int not null primary key auto_increment,
    idUserAvisMarque int,
    Codemarque int,
    commentaire varchar(5000),
    Avisrefusee tinyint(1) default 0,
    AvisValidee tinyint(1) default 0, -- pour bloquer le commentaire -- 
    foreign key (idUserAvisMarque) references User(idUser),
    foreign key (Codemarque) references Marque(idMarque)
);

INSERT INTO AvisMarque(idUserAvisMarque, Codemarque, commentaire, AvisValidee, Avisrefusee)
VALUES
    (1, 1, "J'aime bien cette marque.", 1, 0),
    (4, 2, "Les performances, pas vraiment !", 1, 0),
    (3, 10, "C'est pratique.", 1, 0),
    (6, 11, "J'aime bien.", 0, 0);


DROP TABLE IF EXISTS `AppreciationVeh`;
CREATE TABLE IF NOT EXISTS AppreciationVeh (
    idAppreciationVeh int not null primary key auto_increment,
    CodeAvisV int,
    idUserAppr int,
    foreign key (idUserAppr) references User(idUser),
    foreign key (CodeAvisV) references AvisVehicule(idAvisVeh)
);

INSERT INTO AppreciationVeh(CodeAvisV,idUserAppr) VALUES
(3,5),
(4,6),
(2,6);



DROP TABLE IF EXISTS `AppreciationMarque`;
CREATE TABLE IF NOT EXISTS AppreciationMarque (
    idAppreciationMarque int not null primary key auto_increment,
    CodeAvisM int,
    idUserApprM int,
    foreign key (idUserApprM) references User(idUser),
    foreign key (CodeAvisM) references AvisMarque(idAvisMarque)
);

INSERT INTO AppreciationMarque(CodeAvisM,idUserApprM) VALUES
(1,2),
(1,3),
(1,4),
(2,5),
(2,6),
(3,3);

DROP TABLE IF EXISTS `FavorisVehicule`;

CREATE TABLE IF NOT EXISTS FavorisVehicule (
    idFavori int not null primary key AUTO_INCREMENT,
    idUtilisateur int,
    CodeVehicule int,
    foreign key (idUtilisateur) references User(idUser),
    foreign key (CodeVehicule) references vehicule(idVehicule)
);

INSERT INTO FavorisVehicule(idUtilisateur,CodeVehicule) VALUES
(2,1),
(2,2),
(3,4),
(4,5),
(5,15),
(3,1),
(4,2),
(6,4),
(4,14),
(6,15);

DROP TABLE IF EXISTS `Contact`;
CREATE TABLE IF NOT EXISTS Contact(
    idContact int primary key not null auto_increment,
    TypeContact VARCHAR(100) not null,   -- ie instagram/facebook...
    LienContact VARCHAR(1000) not null
);


INSERT INTO Contact(TypeContact,LienContact) VALUES 
("instagram","https://www.instagram.com/imene_.bj/"),
("Facebook","https://www.facebook.com/profile.php?id=100056953916288&mibextid=kFxxJD"),
("Linkedin","https://www.linkedin.com/in/imene-boudjadi-34893120b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"),
("twitter","https://x.com/iimenebj?t=ZJjNsLhFprEdY520KOCUlQ&s=09"),
("Mail","ki_boudjadi@esi.dz");



COMMIT;