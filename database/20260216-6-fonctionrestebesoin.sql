DELIMITER //

CREATE OR REPLACE FUNCTION get_besoin_reste(d_id INT)
RETURNS FLOAT
READS SQL DATA
BEGIN
    DECLARE v_id_ville INT;
    DECLARE v_id_objet INT;
    DECLARE v_besoin_total FLOAT;
    DECLARE v_deja_donne FLOAT;
    DECLARE v_deja_achete FLOAT;
    DECLARE v_id_besoin INT;
    SELECT bv.id_ville, b.id_objet, bv.quantite, b.id 
    INTO v_id_ville, v_id_objet, v_besoin_total, v_id_besoin
    FROM besoins_ville bv 
    JOIN besoins b ON bv.id_besoin = b.id 
    WHERE bv.id = d_id;
    SELECT SUM(a.quantite) INTO v_deja_achete FROM achat a WHERE id_ville = v_id_ville AND id_besoin = v_id_besoin;
    SELECT IFNULL(SUM(di.quantite), 0) INTO v_deja_donne
    FROM dispatch di 
    JOIN dons d ON di.id_dons = d.id 
    WHERE di.id_ville = v_id_ville 
    AND d.id_objet = v_id_objet;
    RETURN v_besoin_total - IFNULL(v_deja_donne, 0) - IFNULL(v_deja_achete, 0);
END //

DELIMITER ;