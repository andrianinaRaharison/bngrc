<?php

    namespace app\models;

    use FLight;
    use PDO;

    class BesoinModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function getAll(){
            $ret = $this->db->prepare("SELECT * FROM besoins");
            $ret->execute();

            return $ret->fetchAll();
        }

        public function getById($id){
            $ret = $this->db->prepare("SELECT * FROM besoins WHERE id = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }

        public function getObject($id){
            $ret = $this->db->prepare("SELECT b.*, o.libelle FROM besoins b JOIN objets o ON b.id_objet = o.id WHERE b.id = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }
    }

?>