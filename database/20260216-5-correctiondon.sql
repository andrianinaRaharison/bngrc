ALTER TABLE dons ADD COLUMN id_type INT, ADD FOREIGN KEY (id_type) REFERENCES type_besoin(id);
ALTER TABLE besoins ADD COLUMN id_type INT, ADD FOREIGN KEY (id_type) REFERENCES type_besoin(id);