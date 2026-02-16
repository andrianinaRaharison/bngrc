Alter TABLE dispatch ADD quantite FLOAT;

DELIMITER //
CREATE OR REPLACE FUNCTION get_don_reste(d_id INT)
RETURNS FLOAT
READS SQL DATA
BEGIN
    DECLARE d_quant FLOAT;
    DECLARE quant FLOAT;
    SELECT sum(quantite) INTO d_quant FROM dispatch WHERE id_dons = d_id;
    SELECT quantite INTO quant FROM dons WHERE id = d_id;
    RETURN quant - IFNULL(d_quant, 0);
END //
DELIMITER;