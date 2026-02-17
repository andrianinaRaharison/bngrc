CREATE OR REPLACE VIEW v_achat_objet AS 
SELECT a.*, b.prix_unitaire, o.libelle, v.nom 
FROM achat a
JOIN besoins b ON a.id_besoin = b.id
JOIN objets o ON o.id = b.id_objet
JOIN ville v ON v.id = a.id_ville; 