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
        public function getDonsDispo($date){
            $dispatchModel = new DispatchModel($this->db);
            $ret = Flight::db()->prepare("SELECT * FROM dons WHERE daty > ? ");
            $ret->execute([$date]);
          return $ret->fetchAll();
   
        }


        public function getAll() {
            $dispatchModel = new DispatchModel($this->db);
            $ret = Flight::db()->prepare("SELECT * FROM dons");
            $ret->execute();
            return $ret->fetchAll();
        }
    }