-- Fonctions pour simulation avec dispatch_temp

DELIMITER //

-- Fonction pour calculer le reste des dons en utilisant dispatch_temp
CREATE OR REPLACE FUNCTION get_don_reste_temp(d_id INT)
RETURNS FLOAT
READS SQL DATA
BEGIN
    DECLARE d_quant FLOAT;
    DECLARE quant FLOAT;
    SELECT SUM(quantite) INTO d_quant FROM dispatch_temp WHERE id_dons = d_id;
    SELECT quantite INTO quant FROM dons WHERE id = d_id;
    RETURN quant - IFNULL(d_quant, 0);
END //

-- Fonction pour calculer le reste des besoins en utilisant dispatch_temp
CREATE OR REPLACE FUNCTION get_besoin_reste_temp(d_id INT)
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

    -- 2. Calculer tout ce qui a déjà été envoyé à cette ville pour cet objet (depuis dispatch_temp)
    SELECT IFNULL(SUM(di.quantite), 0) INTO v_deja_donne
    FROM dispatch_temp di 
    JOIN dons d ON di.id_dons = d.id 
    WHERE di.id_ville = v_id_ville 
    AND d.id_objet = v_id_objet;

    -- 3. Retourner la différence
    RETURN v_besoin_total - v_deja_donne;
END //

DELIMITER ;
