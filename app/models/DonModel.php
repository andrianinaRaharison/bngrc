<?php

    namespace app\models;

    use Flight;
    use PDO;
    use app\models\ObjetModel;
    class DonModel{

        private $db;

        public function __construct($db){
            $this->db = $db;
        } 

        public function insert(){
            $idUnite = Flight::request()->data->id_unite;
            $quantite = Flight::request()->data->quantite;
            $libelle = Flight::request()->data->libelle;
            $objetModel = new ObjetModel($this->db);
            $idObjet = null;
            if(!$objetModel->AlreadyExist($libelle)){
                $objetModel->insert($libelle, $idUnite);
            }
            $idObjet = $objetModel->getIdByLibelle($libelle);
            $ret = Flight::db()->prepare("INSERT INTO dons (id_objet, quantite) VALUES (?, ?)");
            $ret->execute([$idObjet, $quantite]);
        }   
        public function getDonsDispo(){
            $dispatchModel = new DispatchModel($this->db);
            $ret = Flight::db()->prepare("SELECT dons.*, dispatch.id_dons FROM dons LEFT JOIN dispatch ON dons.id = dispatch.id_dons WHERE dispatch.id_dons IS NULL");
            $ret->execute();
            return $ret->fetchAll();
   
        }

        public function getById($id){
            $ret = $this->db->prepare("SELECT * FROM dons WHERE id = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }

        public function getObject($id){
            $ret = $this->db->prepare("SELECT d.*, o.libelle FROM dons d JOIN objets o ON d.id_objet = o.id WHERE d.id = ?");
            $ret->execute([$id]);

            return $ret->fetch();
        }

        
        public function getAll() {
            $ret = Flight::db()->prepare("SELECT * FROM dons");
            $ret->execute();
            return $ret->fetchAll();
            }
            
            public function getMatchingDons($idObjet) {
                $ret = Flight::db()->prepare("SELECT dons.*, dispatch.id_dons FROM dons LEFT JOIN dispatch ON dons.id = dispatch.id_dons WHERE dispatch.id_dons IS NULL AND dons.id_objet = ?");
                $ret->execute([$idObjet]);
                return $ret->fetchAll();
                }
                
        }
