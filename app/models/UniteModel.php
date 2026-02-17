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
                public function getById($id){
                    $ret = Flight::db()->prepare("SELECT * FROM unite WHERE id = ?");
                    $ret->execute([$id]);
                    return $ret->fetch();
                }
        public function getByObjet($id_objet){
            $ret = Flight::db()->prepare("SELECT * FROM v_objet_unite WHERE id = ?");
            $ret->execute([$id_objet]);
            return $ret->fetch();
        }
}
