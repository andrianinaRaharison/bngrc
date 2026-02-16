<?php 


    namespace app\models;

    use Flight;
    use PDO;
    use ObjetModel;
    class VilleModel{

        private $db;

        public function __construct(){
            $this->db = Flight::db();
        } 

        public function getAll(){
            $ret = Flight::db()->query("SELECT * FROM ville");
            return $ret->fetchAll();
        }

        public function getById($id) {
            $ret = $this->db->prepare("SELECT * FROM ville WHERE id = ?");
            $ret->execute([$id]);
            return $ret->fetch();
        }
        
}
