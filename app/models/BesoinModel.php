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

        public function getAllWithObject(){
            $ret = $this->db->prepare("SELECT * from v_besoin_objet");
            $ret->execute();
            return $ret->fetchAll();
        }

        public function getById($id){
            $ret = $this->db->prepare("SELECT * FROM besoins WHERE id = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }

        public function getObject($id){
            $ret = $this->db->prepare("SELECT b.*, o.libelle, bv.quantite FROM besoins b JOIN objets o ON b.id_objet = o.id JOIN besoins_ville bv ON bv.id_besoin = b.id WHERE b.id = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }

        public function CalculBesoinTotal(){
            $ret = $this->db->prepare("SELECT SUM(b.prix_unitaire*bv.quantite) as total FROM besoins b JOIN besoins_ville bv ON b.id = bv.id_besoin");
            $ret->execute();

            return $ret->fetch();
        }

        public function CalculBesoinSatisfait(){
            $ret = $this->db->prepare("SELECT SUM(b.prix_unitaire*d.quantite) as satisfait FROM dispatch d
            JOIN besoins_ville bv ON d.id_ville = bv.id_ville
            JOIN besoins b ON bv.id_besoin = b.id");
            $ret->execute();
        public function getByIdObjet($id){
            $ret = $this->db->prepare("SELECT * FROM besoins WHERE id_objet = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }
    }

?>