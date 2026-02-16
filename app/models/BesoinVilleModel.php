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

        public function donsVille(){
            $ret =  $this->db->prepare("SELECT * FROM dispatch ");

            $ret->execute();

            return $ret->fetchAll();
        }

        public function getVilles(){
            $ret = $this->db->prepare("SELECT id_ville, ville_nom FROM v_besoin_ville_region GROUP BY ville_nom");

            $ret->execute();
            return $ret->fetchAll();
        }
         public function getByDateDesc() {
            $stm = $this->db->prepare("SELECT bv.*, o.id as id_objet FROM besoins_ville bv JOIN besoins b ON bv.id_besoin = b.id JOIN objets o ON o.id = b.id_objet ORDER BY daty DESC");
            $stm->execute();
            return $stm->fetchAll();
        }

        public function getResteBesoins($id) {
            $stm = $this->db->prepare("SELECT get_besoin_reste(?) as reste");
            $stm->execute([$id]);
            return $stm->fetch()['reste'];
        }
    }

?>