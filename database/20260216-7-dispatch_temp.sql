CREATE TABLE dispatch_temp (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_ville INT,
    id_dons INT,
    daty TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantite FLOAT,
    FOREIGN KEY (id_dons) REFERENCES dons(id),
    FOREIGN KEY (id_ville) REFERENCES ville(id)
);