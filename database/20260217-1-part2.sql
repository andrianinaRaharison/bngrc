CREATE TABLE achat(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_besoin INT,
    daty TIMESTAMP,
    quantite FLOAT,
    id_ville INT,

    FOREIGN KEY (id_besoin) REFERENCES besoins(id),
    FOREIGN KEY (id_ville) REFERENCES ville(id)
);

CREATE TABLE config(
    id INT PRIMARY KEY AUTO_INCREMENT,
    prix FLOAT,
    taux FLOAT
);

//