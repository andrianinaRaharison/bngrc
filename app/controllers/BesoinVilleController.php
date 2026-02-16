<?php

    namespace app\controllers;

    use Flight;
    use app\models\BesoinVilleModel;
    use app\models\BesoinModel;
    use app\models\DonModel;
    use app\models\VilleModel;

    class BesoinVilleController{

        public function getVilleBesoin(){
            $id = Flight::request()->data->id_ville;
            $besoinModel = new BesoinVilleModel(Flight::db());
            $besModel = new BesoinModel(Flight::db());
            $donModel = new DonModel(Flight::db());

            $Besoins = $besoinModel->getByIdVille($id);
            $besoins = array();

            foreach($Besoins as $b){
                $besoins[] = $besModel->getObject($b['id']);
            }

            $Dons = $besoinModel->donsVille();
            $dons = array();

            foreach($Dons as $d){
                $dons[] = $donModel->getObject($d['id']);
            }

            $villes = $besoinModel->getVilles();

            Flight::render('dashboard', ['besoins' => $besoins, 'dons' => $dons, 'villes' => $villes]);
        }

        public function InfoForBesoinDeclaration(){
            $besoinModel = new BesoinModel(Flight::db());
            $besoins = $besoinModel->getAllWithObject();
            $VilleModel = new VilleModel(Flight::db());
            $villes = $VilleModel->getAll();
            Flight::render('declarebesoin', ['besoins' => $besoins, 'villes' => $villes]);
        }
        public function insert(){
            $besoinVilleModel = new BesoinVilleModel(Flight::db());
            $besoinVilleModel->insert();
            $this->InfoForBesoinDeclaration();
        }


    }

?>