create or replace view v_objet_unite as 
SELECT o.id, o.libelle, u.ref FROM unite u JOIN objets o ON u.id = o.id_unite;