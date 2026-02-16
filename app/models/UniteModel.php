<?php 


    namespace app\models;

    use Flight;
    use PDO;
    use ObjetModel;
    class UniteModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        } 

        public function getAll(){
            $ret = Flight::db()->query("SELECT * FROM unite");
            return $ret->fetchAll();
        }
        
}