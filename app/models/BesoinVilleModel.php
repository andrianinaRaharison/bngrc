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
        public function insert() {
            $idVille = Flight::request()->data->ville_id;
            $idBesoin = Flight::request()->data->id_objet;
            $BesoinModel = new BesoinModel($this->db);
            $besoin = $BesoinModel->getByIdObjet($idBesoin);
            $quantite = Flight::request()->data->quantite;
            $stm = $this->db->prepare("INSERT INTO besoins_ville (id_ville, id_besoin, quantite) VALUES (?, ?, ?)");
            $stm->execute([$idVille, $besoin['id'], $quantite]);
        }
        
    }

?>