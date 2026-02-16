CREATE DATABASE BNGRC;
USE BNGRC;

CREATE TABLE unite (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ref VARCHAR(20)
);
CREATE TABLE objets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(100),
    id_unite INT,
    FOREIGN KEY (id_unite) REFERENCES unite(id)
);
CREATE TABLE dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    daty TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_objet) REFERENCES objets(id)
);

CREATE TABLE type_besoin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_type VARCHAR(50)
);

CREATE TABLE besoins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    prix_unitaire FLOAT,
    id_objet INT,
    FOREIGN KEY (id_objet) REFERENCES objets(id)
);

CREATE TABLE region (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100)
);

CREATE TABLE ville (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    id_region INT,
    FOREIGN KEY (id_region) REFERENCES region(id)
);

CREATE TABLE dispatch (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_ville INT,
    id_dons INT,
    daty TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_dons) REFERENCES dons(id),
    FOREIGN KEY (id_ville) REFERENCES ville(id)
);

CREATE TABLE besoins_ville (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_ville INT,
    id_besoin INT,
    quantite FLOAT,
    FOREIGN KEY (id_ville) REFERENCES ville(id),
    FOREIGN KEY (id_besoin) REFERENCES besoins(id)
);

