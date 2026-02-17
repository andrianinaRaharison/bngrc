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
            $ret = Flight::db()->prepare("SELECT dons.*, vdr.reste FROM dons JOIN v_don_reste vdr ON dons.id = vdr.id WHERE vdr.reste > 0");
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
                $ret = Flight::db()->prepare("SELECT dons.*, vdr.reste, ABS(vdr.reste - vbr.reste) AS diff FROM dons JOIN v_don_reste vdr ON dons.id = vdr.id JOIN besoins b ON dons.id_objet = b.id_objet JOIN besoins_ville bv ON bv.id_besoin = b.id JOIN v_besoin_reste vbr ON bv.id = vbr.id WHERE vdr.reste > 0 AND dons.id_objet = ? ORDER BY diff DESC LIMIT 1");
                $ret->execute([$idObjet]);
                return $ret->fetchAll();
            }

            // Méthodes pour simulation avec dispatch_temp
            public function getDonsDispoTemp(){
                $ret = Flight::db()->prepare("SELECT dons.*, vdrt.reste FROM dons JOIN v_don_reste_temp vdrt ON dons.id = vdrt.id WHERE vdrt.reste > 0");
                $ret->execute();
                return $ret->fetchAll();
            }

            public function getMatchingDonsTemp($idObjet) {
                $ret = Flight::db()->prepare("SELECT dons.*, vdrt.reste, ABS(vdrt.reste - vbrt.reste) AS diff FROM dons JOIN v_don_reste_temp vdrt ON dons.id = vdrt.id JOIN besoins b ON dons.id_objet = b.id_objet JOIN besoins_ville bv ON bv.id_besoin = b.id JOIN v_besoin_reste_temp vbrt ON bv.id = vbrt.id WHERE vdrt.reste > 0 AND dons.id_objet = ? ORDER BY diff DESC LIMIT 1");
                $ret->execute([$idObjet]);
                return $ret->fetchAll();
            }

            public function getStock($id){
                $ret = $this->db->prepare("SELECT reste AS stock FROM v_don_reste WHERE id = ?");
                $ret->execute([$id]);
                return $ret->fetch();
            }


                
    }
