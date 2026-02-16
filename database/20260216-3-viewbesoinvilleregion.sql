CREATE OR REPLACE VIEW v_besoin_ville_region AS
SELECT 
    bv.id,
    bv.id_besoin,
    bv.quantite,
    v.id as id_ville,
    v.nom as ville_nom, 
    r.nom as region_nom,
    r.id as id_region
FROM besoins_ville bv JOIN ville v ON bv.id_ville = v.id
JOIN region r ON v.id_region = r.id;