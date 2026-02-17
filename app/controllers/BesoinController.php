<?php

    namespace app\controllers;

    use Flight;
    use app\models\BesoinVilleModel;
    use app\models\BesoinModel;
    use app\models\DonModel;
    use app\models\UniteModel;

    class BesoinController{

        public function getAllBesoins(){
            $besoinModel = new BesoinModel(Flight::db());
            $besoins = $besoinModel->getAllWithObject();
            Flight::render('dashboard', ['besoins' => $besoins]);
        }
        public function getUniteForObject($id_objet){
            $uniteModel = new UniteModel(Flight::db());
            $unite = $uniteModel->getByObjet($id_objet);
            Flight::json($unite);
        }
    }

?>