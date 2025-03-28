CREATE DATABASE audio;
USE audio;

-- Table Personne
CREATE TABLE Personne (
    idPersonne INT PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(122) UNIQUE NOT NULL,
    Nom VARCHAR(122),
    Poste VARCHAR(122),
    Emplacement VARCHAR(122),
    Services VARCHAR(122),
    password VARCHAR(255) 
);

-- Table Audio
CREATE TABLE audio (
    idAudio INT PRIMARY KEY AUTO_INCREMENT,
    urls VARCHAR(225),
    taille VARCHAR(122),
    date_ajout_serveur DATETIME,
    NUMEROTA VARCHAR(122),
    JOUR DATE,
    Heure TIME,
    INDICE VARCHAR(122),
    QUALIFICATION VARCHAR(255),
    QUALIFICATION2 VARCHAR(255)
);

-- Table Téléchargement
CREATE TABLE Telechargement (
    idTelechargement INT PRIMARY KEY AUTO_INCREMENT,
    idPersonne INT,
    idAudio INT,
    Date_heure_telechargement DATETIME,
    FOREIGN KEY (idPersonne) REFERENCES Personne(idPersonne),
    FOREIGN KEY (idAudio) REFERENCES audio(idAudio)
);

-- Table Lire_Audio
CREATE TABLE Lire_Audio (
    idLire_Audio INT PRIMARY KEY AUTO_INCREMENT,
    idAudio INT,
    idPersonne INT,
    Date_heure_Ecoute DATETIME,
    FOREIGN KEY (idAudio) REFERENCES audio(idAudio),
    FOREIGN KEY (idPersonne) REFERENCES Personne(idPersonne)
);



INSERT INTO Personne (Email, Nom, Poste, Emplacement, Services, password) VALUES
('alice.doe@example.com', 'Alice Doe', 'Développeur', 'Bureau 101', 'IT', 'pass1234'),
('bob.smith@example.com', 'Bob Smith', 'Chef de projet', 'Bureau 202', 'Gestion', 'securePass!');

