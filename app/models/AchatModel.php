<?php

    namespace app\models;

    use Flight;
    use PDO;

    class AchatModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function insert($data){
            $ret = $this->db->prepare("INSERT INTO achat(id_besoin, daty, quantite, id_ville, prix_ttc) VALUES (?,?,?,?)");
            $ret->execute($data);
        }

        public function getByVille($id){
            $ret = $this->db->prepare("SELECT * FROM achat WHERE id_ville = ?");
            $ret->execute([$id]);

            return $ret->fetchAll();
        }

        public function getFrais($prix){
            $ret = $this->db->prepare("SELECT (?*taux)+? FROM achat WHERE prix <= ? AND prix > ?");
            $ret->execute([$prix, $prix, $prix, $prix]);

            return $ret->fetch();
        }
    }

?>