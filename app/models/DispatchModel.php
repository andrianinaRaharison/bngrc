<?php

    namespace app\models;

    use Flight;
    use PDO;

    class DispatchModel {

        private $db;

        public function __construct(){
            $this->db = Flight::db();
        }

        public function getAll() {
            $stm = $this->db->prepare("SELECT d.*, v.nom as ville, o.libelle as objet FROM dispatch d JOIN ville v ON d.id_ville = v.id JOIN dons dn ON d.id_dons = dn.id JOIN objets o ON dn.id_objet = o.id ORDER BY d.daty DESC");
            $stm->execute();
            return $stm->fetchAll();
        }

        public function clearAll() {
            $stm = $this->db->prepare("DELETE FROM dispatch");
            $stm->execute();
        }

        public function insert($data) {
            $stm = $this->db->prepare("INSERT INTO dispatch (id_ville, id_dons, quantite) VALUES (?, ?, ?)");
            $stm->execute($data);
        }

        public function getLastDispatch() {
            $stm = $this->db->prepare("SELECT * FROM dispatch ORDER BY daty DESC LIMIT 1");
            $stm->execute();
            return $stm->fetch();
        }
    }
?>