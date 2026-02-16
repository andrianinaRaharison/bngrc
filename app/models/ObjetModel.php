<?php
    namespace app\models;

    use Flight;
    use PDO;
    class ObjetModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        } 
        public function insert($libelle, $id_unite){
            $ret = Flight::db()->prepare("INSERT INTO objets (libelle,id_unite) VALUES (?,?)");
            $ret->execute([$libelle, $id_unite]);
            }
        public function AlreadyExist($libelle){
            $ret = Flight::db()->prepare("SELECT * FROM objets WHERE libelle = ?", [$libelle]);
            $ret->execute([$libelle]);
            return $ret->fetch();

        }
        public function getIdByLibelle($libelle){
            $ret = Flight::db()->prepare("SELECT id FROM objets WHERE libelle = ?", [$libelle]);
            $ret->execute([$libelle]);
            $row = $ret->fetch();
            return $row['id'];
        }

    }

