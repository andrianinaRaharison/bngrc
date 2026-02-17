-- Types (On harmonise selon vos données : nature, materiel, argent)
INSERT INTO type_besoin (nom_type) VALUES ('nature'), ('materiel'), ('argent');

-- Unités
INSERT INTO unite (ref) VALUES ('kg'), ('L'), ('pièce'), ('Ar');

-- Régions et Villes
INSERT INTO region (nom) VALUES ('Analamanga'); -- Exemple par défaut
INSERT INTO ville (nom, id_region) VALUES 
('Toamasina', 1), ('Mananjary', 1), ('Farafangana', 1), ('Nosy Be', 1), ('Morondava', 1);

-- Objets
INSERT INTO objets (libelle, id_unite) VALUES 
('Riz (kg)', 1), ('Eau (L)', 2), ('Tôle', 3), ('Bâche', 3), ('Argent', 4), 
('Huile (L)', 2), ('Clous (kg)', 1), ('Bois', 3), ('Haricots', 1), ('groupe', 3);

INSERT INTO besoins (id_objet, prix_unitaire, type_objet) VALUES 
(1, 3000, 1),  -- Riz (nature)
(2, 1000, 1),  -- Eau (nature)
(3, 25000, 2), -- Tôle (materiel)
(4, 15000, 2), -- Bâche (materiel)
(5, 1, 3),     -- Argent (argent) - PU à 1 car la quantité fera le montant
(6, 6000, 1),  -- Huile (nature)
(7, 8000, 2),  -- Clous (materiel)
(8, 10000, 2), -- Bois (materiel)
(9, 4000, 1),  -- Haricots (nature)
(10, 6750000, 2); -- Groupe (materiel)

-- DONS (Stock global disponible)
INSERT INTO dons (id_objet, quantite, type_objet, daty) VALUES 
(1, 10000, 1, '2026-02-14 08:00:00'), -- Stock global Riz
(2, 5000, 1, '2026-02-14 08:00:00'),  -- Stock global Eau
(3, 500, 2, '2026-02-14 08:00:00');   -- Stock global Tôle

-- BESOINS PAR VILLE
-- Toamasina
INSERT INTO besoins_ville (id_ville, id_besoin, quantite, daty) VALUES 
(1, 1, 800, '2026-02-16 17:00:00'), -- Riz
(1, 2, 1500, '2026-02-15 04:00:00'), -- Eau
(1, 3, 120, '2026-02-16 23:00:00'), -- Tôle
(1, 4, 200, '2026-02-15 01:00:00'), -- Bâche
(1, 5, 112000000, '2026-02-16 12:00:00'), -- Argent
(1, 10, 3, '2026-02-15 16:00:00'); -- Groupe

-- Mananjary
INSERT INTO besoins_ville (id_ville, id_besoin, quantite, daty) VALUES 
(2, 1, 500, '2026-02-15 09:00:00'), -- Riz
(2, 6, 120, '2026-02-16 25:00:00'), -- Huile (Heure 25 corrigée par SQL si besoin)
(2, 3, 80, '2026-02-15 06:00:00'),  -- Tôle
(2, 7, 60, '2026-02-16 19:00:00'),  -- Clous
(2, 5, 16000000, '2026-02-15 03:00:00'); -- Argent

-- Farafangana
INSERT INTO besoins_ville (id_ville, id_besoin, quantite, daty) VALUES 
(3, 1, 600, '2026-02-16 21:00:00'),
(3, 2, 1000, '2026-02-15 14:00:00'),
(3, 4, 150, '2026-02-16 08:00:00'),
(3, 8, 100, '2026-02-15 26:00:00'), -- Heure 26
(3, 5, 18000000, '2026-02-16 10:00:00');

-- Nosy Be
INSERT INTO besoins_ville (id_ville, id_besoin, quantite, daty) VALUES 
(4, 1, 300, '2026-02-15 05:00:00'),
(4, 9, 200, '2026-02-16 18:00:00'),
(4, 3, 40, '2026-02-15 02:00:00'),
(4, 7, 30, '2026-02-16 24:00:00'),
(4, 5, 14000000, '2026-02-15 07:00:00');

-- Morondava
INSERT INTO besoins_ville (id_ville, id_besoin, quantite, daty) VALUES 
(5, 1, 700, '2026-02-16 11:00:00'),
(5, 2, 1200, '2026-02-15 20:00:00'),
(5, 4, 180, '2026-02-16 15:00:00'),
(5, 8, 150, '2026-02-15 22:00:00'),
(5, 5, 110000000, '2026-02-16 13:00:00');

