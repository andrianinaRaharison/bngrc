DELIMITER //

CREATE OR REPLACE FUNCTION get_besoin_reste(d_id INT)
RETURNS FLOAT
READS SQL DATA
BEGIN
    DECLARE v_id_ville INT;
    DECLARE v_id_objet INT;
    DECLARE v_besoin_total FLOAT;
    DECLARE v_deja_donne FLOAT;

    -- 1. Récupérer les infos du besoin (Ville, Objet et Quantité nécessaire)
    SELECT bv.id_ville, b.id_objet, bv.quantite 
    INTO v_id_ville, v_id_objet, v_besoin_total
    FROM besoins_ville bv 
    JOIN besoins b ON bv.id_besoin = b.id 
    WHERE bv.id = d_id;

    -- 2. Calculer tout ce qui a déjà été envoyé à cette ville pour cet objet
    SELECT IFNULL(SUM(di.quantite), 0) INTO v_deja_donne
    FROM dispatch di 
    JOIN dons d ON di.id_dons = d.id 
    WHERE di.id_ville = v_id_ville 
    AND d.id_objet = v_id_objet;

    -- 3. Retourner la différence
    RETURN v_besoin_total - v_deja_donne;
END //

DELIMITER ;