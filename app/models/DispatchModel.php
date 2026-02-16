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