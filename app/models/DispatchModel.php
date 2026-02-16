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
    }

?>