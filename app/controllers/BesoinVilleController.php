<?php

    namespace app\controllers;

    use Flight;
    use app\models\BesoinVilleModel;
    use app\models\BesoinModel;
    use app\models\DonModel;

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

    }

?>