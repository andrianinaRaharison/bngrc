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
            $ret = $this->db->prepare("INSERT INTO achat(id_besoin, quantite, id_ville, prix_ttc) VALUES (?,?,?,?)");
            $ret->execute($data);
        }

        public function getByVille($id){
            $ret = $this->db->prepare("SELECT * FROM v_achat_objet WHERE id_ville = ?");
            $ret->execute([$id]);

            return $ret->fetchAll();
        }

        public function getFrais($prix){
            $ret = $this->db->prepare("SELECT taux FROM config WHERE prix <= ? AND prix2 > ?");
            $ret->execute([$prix, $prix]);

            $data = $ret->fetch();
            $ttc = array(
                'ttc' => $prix + $prix * ($data['taux'] ?? 0)
            );
            return $ttc;
        }

        public function getAll() {
            $stm = $this->db->prepare("SELECT * FROM v_achat_objet");
             $stm->execute();

            return $stm->fetchAll();
        }
    }

?>