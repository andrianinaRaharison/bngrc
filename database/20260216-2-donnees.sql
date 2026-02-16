INSERT INTO unite (ref) VALUES ('kg'), ('litre'), ('pièce'), ('sac');

INSERT INTO besoins (libelle, prix_unitaire, id_unite) VALUES 
('Riz', 2500, 1),      -- id 1
('Huile', 8000, 2),    -- id 2
('Savon', 1200, 3),    -- id 3
('Couverture', 15000, 3); -- id 4

INSERT INTO region (nom) VALUES ('Analamanga'), ('Atsinanana');

INSERT INTO ville (nom, id_region) VALUES 
('Antananarivo', 1), 
('Ambohidratrimo', 1),
('Toamasina', 2);

INSERT INTO dons (libelle, daty) VALUES 
('Riz'),
('Huile'),
('Savon'),
('Médicaments'); -- Objet hors table "besoins"

INSERT INTO besoins_ville (id_ville, id_besoin, quantite) VALUES 
(1, 1, 500), -- Antananarivo a besoin de 500 kg de Riz
(1, 4, 50),  -- Antananarivo a besoin de 50 Couvertures
(3, 2, 100); -- Toamasina a besoin de 100 L d'Huile