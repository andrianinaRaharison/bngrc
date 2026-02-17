<?php

    namespace app\models;

    use Flight;
    use PDO;
    use app\models\BesoinModel;

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
            $ret = $this->db->prepare("SELECT v.*, vbr.reste, o.libelle FROM v_besoin_ville_region v JOIN besoins b ON b.id = v.id_besoin JOIN objets o ON o.id = b.id_objet JOIN v_besoin_reste vbr ON v.id = vbr.id WHERE v.id_ville = ?");
            $ret->execute([$id]);

            $data = $ret->fetchAll();
            return $data;
        }

        public function donsVille($id){
            $ret =  $this->db->prepare("SELECT * FROM dispatch WHERE id_ville = ?");

            $ret->execute([$id]);

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
            $stm = $this->db->prepare("SELECT reste FROM v_besoin_reste WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch()['reste'];
        }

        // Méthode pour simulation avec dispatch_temp
        public function getResteBesoinsTemp($id) {
            $stm = $this->db->prepare("SELECT reste FROM v_besoin_reste_temp WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch()['reste'];
        }
        public function insert() {
            $idVille = Flight::request()->data->ville_id;
            $idBesoin = Flight::request()->data->id_objet;
            $BesoinModel = new BesoinModel($this->db);
            $besoin = $BesoinModel->getByIdObjet($idBesoin);
            $quantite = Flight::request()->data->quantite;
            $stm = $this->db->prepare("INSERT INTO besoins_ville (id_ville, id_besoin, quantite) VALUES (?, ?, ?)");
            $stm->execute([$idVille, $besoin['id'], $quantite]);
        }
        public function getByQuantiteAsc(){
            $ret = $this->db->prepare("SELECT bv.*, o.id as id_objet FROM besoins_ville bv JOIN besoins b ON bv.id_besoin = b.id JOIN objets o ON o.id = b.id_objet ORDER BY bv.quantite ASC");
            $ret->execute();
            return $ret->fetchAll();
        }

        public function countBesoin($id){
            $ret = $this->db->prepare("SELECT SUM(quantite) as count FROM besoins_ville WHERE id_besoin = ?");
            $ret->execute([$id]);
            return $ret->fetch();
        }

        // Récupérer tous les besoins groupés par objet (pour dispatch proportionnel)
        public function getBesoinsParObjet() {
            $stm = $this->db->prepare("
                SELECT bv.id, bv.id_ville, bv.id_besoin, bv.quantite, b.id_objet, o.libelle,
                       vbr.reste
                FROM besoins_ville bv
                JOIN besoins b ON bv.id_besoin = b.id
                JOIN objets o ON o.id = b.id_objet
                JOIN v_besoin_reste vbr ON bv.id = vbr.id
                WHERE vbr.reste > 0
                ORDER BY b.id_objet, bv.id_ville
            ");
            $stm->execute();
            return $stm->fetchAll();
        }

        public function getBesoinsParObjetTemp() {
            $stm = $this->db->prepare("
                SELECT bv.id, bv.id_ville, bv.id_besoin, bv.quantite, b.id_objet, o.libelle,
                       vbrt.reste
                FROM besoins_ville bv
                JOIN besoins b ON bv.id_besoin = b.id
                JOIN objets o ON o.id = b.id_objet
                JOIN v_besoin_reste_temp vbrt ON bv.id = vbrt.id
                WHERE vbrt.reste > 0
                ORDER BY b.id_objet, bv.id_ville
            ");
            $stm->execute();
            return $stm->fetchAll();
        }
        
    }
?>