<?php

    namespace app\controllers;

    use Flight;
    use app\models\BesoinVilleModel;

    class BesoinVilleController{

        public function getVilleBesoin(){
            $id = Flight::request()->data->id_ville;
            $besoinModel = new BesoinVilleModel(Flight::db());
            $besoins = $besoinModel->getByIdVille($id);

            $dons = $besoinModel->donsVille();

            $villes = $besoinModel->getVilles();

            Flight::render('dashboard', ['besoins' => $besoins, 'dons' => $dons, 'villes' => $villes]);
        }

    }

?>