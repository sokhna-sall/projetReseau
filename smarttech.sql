CREATE DATABASE smarttech;
USE smarttech;
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    entreprise VARCHAR(100) NOT NULL,
    date_inscription DATE NOT NULL
);
CREATE TABLE employes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    poste VARCHAR(100) NOT NULL,
    date_embauche DATE NOT NULL,
    salaire DECIMAL(10, 2) NOT NULL
);
CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_fichier VARCHAR(255) NOT NULL,
    type_fichier VARCHAR(100) NOT NULL,
    taille_fichier INT NOT NULL,
    date_upload DATETIME NOT NULL,
    upload_par INT NOT NULL,
    FOREIGN KEY (upload_par) REFERENCES employes(id)
);