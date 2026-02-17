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

        public function getById($id) {
            $ret = $this->db->prepare("SELECT * FROM ville WHERE id = ?");
            $ret->execute([$id]);
            $data = $ret->fetch();
            $data['reste_don_arg'] = $this->getDonArgentReste($id);
            return $data;
        }

        public function getDonArgentReste($id) {
            $stm = $this->db->prepare("SELECT SUM(bv.quantite) as don FROM dispatch bv JOIN dons d ON d.id = bv.id_dons WHERE d.id_type = 3 AND bv.id_ville = ?");
            $stm->execute([$id]);
            $dons = $stm->fetch()['don'];
            $stm = $this->db->prepare("SELECT SUM(a.prix_ttc) as achat FROM achat a JOIN besoins b ON b.id = a.id_besoin WHERE a.id_ville = ?");
            $stm->execute([$id]);
            $achat = $stm->fetch()['achat'];
            return $dons - $achat;
        }
        
        public function getNomById($id) {
            $ret = $this->db->prepare("SELECT nom FROM ville WHERE id = ?");
            $ret->execute([$id]);
            $result = $ret->fetch();
            return $result ? $result['nom'] : null;
        }
        
}
