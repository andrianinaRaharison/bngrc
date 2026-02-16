<?php
    namespace app\models;

    use Flight;
    use PDO;
    class VilleModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        } 
        public function getAll(){
            $ret = Flight::db()->query("SELECT * FROM ville");
            return $ret->fetchAll();
        }

    }

