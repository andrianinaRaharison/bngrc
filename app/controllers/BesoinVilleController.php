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

            $villes = $besoinModel->getVilles();
            $dons = array();
            foreach($villes as $v) {
                 $Besoins[$v['id_ville']] = $besoinModel->getByIdVille($v['id_ville']);
                 $Dons = $besoinModel->donsVille($v['id_ville']);
     
                 foreach($Dons as $d){
                     $dons[$v['id_ville']][] = $donModel->getObject($d['id_dons']);
                 }
            }
            $besoins = array();

            foreach($Besoins as $key => $b){
                foreach($b as $b1) {
                    $besoins[$key][] = $besModel->getObject($b1['id_besoin']);
                }
            }



            Flight::render('dashboard', ['besoins' => $besoins, 'dons' => $dons, 'villes' => $villes]);
        }

    }

?>