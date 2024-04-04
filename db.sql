-- Création de la base de données
CREATE DATABASE  gestion_membres_commune2;

-- Sélection de la base de données
USE gestion_membres_commune2;

-- Création de la table pour les agents de la mairie
CREATE TABLE agents_mairie (
   id INT AUTO_INCREMENT PRIMARY KEY,
   matricule VARCHAR(20) UNIQUE NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   email VARCHAR(50) UNIQUE NOT NULL,
   telephone VARCHAR(20) UNIQUE NOT NULL,
   password VARCHAR(255) NOT NULL
);

-- Création de la table pour les statuts
CREATE TABLE statut (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(30) NOT NULL
);

-- Création de la table pour les quartiers
CREATE TABLE quartier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(30) NOT NULL
);

-- Création de la table pour les tranches d'âge
CREATE TABLE tranche_age (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(30) NOT NULL,
    age_min INT NOT NULL,
    age_max INT NOT NULL
);
-- Création de la table pour les membres de la commune
CREATE TABLE membres_commune (
   id INT AUTO_INCREMENT PRIMARY KEY,
   matricule VARCHAR(20) UNIQUE NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   sexe ENUM('Homme', 'Femme') NOT NULL,
   situation_matrimoniale ENUM('Celibataire', 'Marie', 'Divorce', 'Veuf(ve)') NOT NULL,
   etat ENUM('actif', 'retraite', 'chomeur') NOT NULL,
   date_enregistrement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   idAgent INT NOT NULL,
   idStatut INT NOT NULL,
   idQuartier INT NOT NULL,
   idAge INT NOT NULL,
   FOREIGN KEY (idAgent) REFERENCES agents_mairie(id),
   FOREIGN KEY (idStatut) REFERENCES statut(id),
   FOREIGN KEY (idQuartier) REFERENCES quartier(id),
   FOREIGN KEY (idAge) REFERENCES tranche_age(id)
);

