INSERT INTO unite (ref) VALUES ('kg'), ('litre'), ('pièce'), ('sac');

INSERT INTO type_besoin (nom_type) VALUES ('Nature'), ('Materiel'), ('Argent');

INSERT INTO objets (libelle, id_unite) VALUES 
('Riz', 4),         -- id 1 (sac)
('Huile', 2),       -- id 2 (litre)
('Savon', 3),       -- id 3 (pièce)
('Tente', 3),       -- id 4 (pièce)
('Médicaments', 3); -- id 5 (pièce)

INSERT INTO besoins (id_objet, prix_unitaire) VALUES 
(1, 125000, 1), -- Riz (par sac)
(2, 8000,1),   -- Huile (par litre)
(3, 1500, 1),   -- Savon (par pièce)
(4, 450000, 2); -- Tente (par pièce)

INSERT INTO region (nom) VALUES ('Analamanga'), ('Atsinanana');

INSERT INTO ville (nom, id_region) VALUES 
('Antananarivo', 1), 
('Toamasina', 2),
('Fenerive Est', 2);

INSERT INTO dons (id_objet, daty, quantite) VALUES 
(1, '2026-02-16 08:00:00', 50, 1), -- Un don de Riz
(1, '2026-02-16 09:15:00', 50, 1), -- Un autre don de Riz
(2, '2026-02-16 10:00:00', 25, 1), -- Un don d'Huile
(5, '2026-02-16 11:00:00', 10, 2); -- Un don de Médicaments (pas forcément un besoin listé)

INSERT INTO besoins_ville (id_ville, id_besoin, quantite) VALUES 
(1, 1, 100), -- Antananarivo a besoin de 100 sacs de Riz
(2, 1, 500), -- Toamasina a besoin de 500 sacs de Riz
(2, 4, 20);  -- Toamasina a besoin de 20 Tentes