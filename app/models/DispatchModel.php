<?php

    namespace app\models;

    use Flight;
    use PDO;

    class DispatchModel {

        private $db;

        public function __construct(){
            $this->db = Flight::db();
        }

        public function insert($data) {
            $stm = $this->db->prepare("INSERT INTO dispatch (id_ville, id_dons) VALUES (?, ?)");
            $stm->execute($data);
        }
    
        public function getLastDispatch(){
            $stm = $this->db->query("SELECT * FROM dispatch ORDER BY id DESC LIMIT 1");
            return $stm->fetch();
        }
    }
?>