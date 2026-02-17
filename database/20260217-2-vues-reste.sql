CREATE OR REPLACE VIEW v_don_reste AS
SELECT 
    d.id,
    d.id_objet,
    d.quantite,
    d.quantite - IFNULL(SUM(di.quantite), 0) AS reste
FROM dons d
LEFT JOIN dispatch di ON d.id = di.id_dons
GROUP BY d.id, d.id_objet, d.quantite;


CREATE OR REPLACE VIEW v_besoin_reste AS
SELECT 
    bv.id,
    bv.id_ville,
    b.id AS id_besoin,
    b.id_objet,
    bv.quantite AS besoin_total,
    bv.quantite 
        - IFNULL(dispatched.total, 0) 
        - IFNULL(achete.total, 0) AS reste
FROM besoins_ville bv
JOIN besoins b ON bv.id_besoin = b.id
LEFT JOIN (
    SELECT di.id_ville, d.id_objet, SUM(di.quantite) AS total
    FROM dispatch di
    JOIN dons d ON di.id_dons = d.id
    GROUP BY di.id_ville, d.id_objet
) dispatched ON dispatched.id_ville = bv.id_ville AND dispatched.id_objet = b.id_objet
LEFT JOIN (
    SELECT a.id_ville, a.id_besoin, SUM(a.quantite) AS total
    FROM achat a
    GROUP BY a.id_ville, a.id_besoin
) achete ON achete.id_ville = bv.id_ville AND achete.id_besoin = b.id;



CREATE OR REPLACE VIEW v_don_reste_temp AS
SELECT 
    d.id,
    d.id_objet,
    d.quantite,
    d.quantite - IFNULL(SUM(dt.quantite), 0) AS reste
FROM dons d
LEFT JOIN dispatch_temp dt ON d.id = dt.id_dons
GROUP BY d.id, d.id_objet, d.quantite;



CREATE OR REPLACE VIEW v_besoin_reste_temp AS
SELECT 
    bv.id,
    bv.id_ville,
    b.id AS id_besoin,
    b.id_objet,
    bv.quantite AS besoin_total,
    bv.quantite 
        - IFNULL(dispatched.total, 0) 
        - IFNULL(achete.total, 0) AS reste
FROM besoins_ville bv
JOIN besoins b ON bv.id_besoin = b.id
LEFT JOIN (
    SELECT dt.id_ville, d.id_objet, SUM(dt.quantite) AS total
    FROM dispatch_temp dt
    JOIN dons d ON dt.id_dons = d.id
    GROUP BY dt.id_ville, d.id_objet
) dispatched ON dispatched.id_ville = bv.id_ville AND dispatched.id_objet = b.id_objet
LEFT JOIN (
    SELECT a.id_ville, a.id_besoin, SUM(a.quantite) AS total
    FROM achat a
    GROUP BY a.id_ville, a.id_besoin
) achete ON achete.id_ville = bv.id_ville AND achete.id_besoin = b.id;


