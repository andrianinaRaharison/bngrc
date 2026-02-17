<?php

    namespace app\controllers;

    use Flight;
    use app\models\AchatModel;
    use app\models\BesoinModel;

    class AchatController{

        public function renderByVille(){
            $id = Flight::request()->data->id;
            $achatModel = new AchatModel(Flight::db());

            $achatVille = $achatModel->getByVille();

            Flight::render('achat', ['achatVille' => $achatVille]);
        }

        public function acheter() {
            $idV = Flight::request()->data->id_ville;
            $quantity = Flight::request()->data->id_ville;
            $idB = Flight::request()->data->id_besoin;
            $besoinM = new BesoinModel(Flight::db());
            $besoin = $besoinM->getById($idB);
            $achatModel = new AchatModel(Flight::db());
            $prix = $quantity * $besoin['prix_unitaire'];
            $prixttc = $achatModel->getFrais($prix);
        }
    }

?>