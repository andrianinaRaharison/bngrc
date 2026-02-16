<?php

    namespace app\controllers;

    use Flight;
    use app\BesoinVilleModel;

    class BesoinVilleController{


        public function getVilleBesoin(){
            $id = Flight::request()->data->id_ville;
            $besoinModel = new BesoinVilleModel(Flight::db());
            $besoins = $besoinModel->getByIdVille($id);

            Flight::render('dash', ['besoins' => $besoins]);
        }

        public function getDonsVille(){
            $year = Flight::request()->data->year;
            $month = Flight::request()->data->month;
            $besoinModel = new BesoinVilleModel(Flight::db());

            $daty = [$year, $month];
            $dons = $besoinModel->donsVille($daty);

            Flight::render('dash', ['besoins' => $besoins]);
        }
    }

?>