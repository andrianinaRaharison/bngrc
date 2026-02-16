<?php

    namespace app\controllers;

    use Flight;
    use app\models\AchatModel;

    class AchatController{

        public function renderByVille(){
            $id = Flight::request()->data->id;
            $achatModel = new AchatModel(Flight::db());

            $achatVille = $achatModel->getByVille();

            Flight::render('achat', ['achatVille' => $achatVille]);
        }
    }

?>