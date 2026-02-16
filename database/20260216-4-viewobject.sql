CREATE OR REPLACE VIEW v_besoin_objet AS
SELECT b.*, o.libelle, o.id_unite 
FROM besoins b JOIN objets o ON b.id_objet=o.id;

CREATE OR REPLACE VIEW v_don_objet AS
SELECT d.*, o.libelle, o.id_unite 
FROM dons d JOIN objets o ON d.id_objet=o.id;