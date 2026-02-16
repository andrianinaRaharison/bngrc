<?php

    namespace app\models;

    use Flight;
    use PDO;

    class BesoinVilleModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function getByRegion($id){
            $ret = $this->db->prepare("SELECT * FROM v_besoin_ville_region WHERE id_region = ?");
            $ret->execute([$id]);

            return $ret->fetchAll();
        }

        public function getByIdVille($id){
            $ret = $this->db->prepare("SELECT * FROM v_besoin_ville_region WHERE id_ville = ?");
            $ret->execute([$id]);

            return $ret->fetchAll();
        }

        public function donsVille($daty){
            $ret =  $this->db->prepare("SELECT * FROM dispatch WHERE 1 = 1 +
                    AND YEAR(daty) = ? AND MONTH(daty) = ? ");

            $ret->execute($daty);

            return $ret->fetchAll();
        }
    }

?>