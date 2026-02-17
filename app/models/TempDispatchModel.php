<?php

    namespace app\models;

    use Flight;
    use PDO;

    class TempDispatchModel {

        private $db;

        public function __construct(){
            $this->db = Flight::db();
        }

        public function getAll() {
            $stm = $this->db->prepare("SELECT dt.*, v.nom as ville, o.libelle as objet FROM dispatch_temp dt JOIN ville v ON dt.id_ville = v.id JOIN dons dn ON dt.id_dons = dn.id JOIN objets o ON dn.id_objet = o.id ORDER BY dt.daty DESC");
            $stm->execute();
            return $stm->fetchAll();
        }

        public function insert($data) {
            $stm = $this->db->prepare("INSERT INTO dispatch_temp (id_ville, id_dons, quantite) VALUES (?, ?, ?)");
            $stm->execute($data);
        }

        public function getLastDispatch() {
            $stm = $this->db->prepare("SELECT * FROM dispatch_temp ORDER BY daty DESC LIMIT 1");
            $stm->execute();
            return $stm->fetch();
        }

        public function clearAll() {
            $stm = $this->db->prepare("DELETE FROM dispatch_temp");
            $stm->execute();
        }
    }
?>