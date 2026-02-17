<?php

    namespace app\controllers;

    use Flight;
    use app\models\AchatModel;
    use app\models\BesoinModel;
    use app\models\VilleModel;
    use app\models\BesoinVilleModel;

    class AchatController{

        public function renderByVille(){
            $id = Flight::request()->data->id;
            $achatModel = new AchatModel(Flight::db());
            $vm = new VilleModel(Flight::db());

            $achatVille = $achatModel->getByVille($id);

            Flight::render('achatbesoin', ['achatVille' => $achatVille, 'villes' => $vm->getAll()]);
        }

        public function renderAll() {
            $achatModel = new AchatModel(Flight::db());
            $vm = new VilleModel(Flight::db());
            $achatVille = $achatModel->getAll();

            Flight::render('achatbesoin', ['achatVille' => $achatVille, 'villes' => $vm->getAll()]);
        }

        public function acheter() {
            $idV = Flight::request()->data->id_ville;
            $quantity = Flight::request()->data->quantity;
            $idB = Flight::request()->data->id_besoin;
            $id = Flight::request()->data->id;
            $besoinM = new BesoinModel(Flight::db());
            $besoin = $besoinM->getById($idB);
            $achatModel = new AchatModel(Flight::db());
            $prix = $quantity * $besoin['prix_unitaire'];
            $prixttc = $achatModel->getFrais($prix)['ttc'];
            $data = [$idB, $quantity, $idV, $prixttc];
            $vm = new VilleModel(Flight::db());
            $bvm = new BesoinVilleModel(Flight::db());
            $code = array();
            $code['ok'] = true;
            if(empty($quantity)) {
                $code['ok'] = false;
                $code['error'] = 'Fill the quantity field.';
                Flight::render('ville-besoin', ['data' => $bvm->getByIdVille($idV), 'ville' => $vm->getById($idV), 'code' => $code]);
                return;
            }
            if($vm->getDonArgentReste($idV) < $prixttc) {
                // echo 'Insufficient cash';
                $code['ok'] = false;
                $code['error'] = 'Insufficient cash';
                Flight::render('ville-besoin', ['data' => $bvm->getByIdVille($idV), 'ville' => $vm->getById($idV), 'code' => $code]);
                return;
            }
            $achatModel->insert($data);
            Flight::render('ville-besoin', ['data' => $bvm->getByIdVille($idV), 'ville' => $vm->getById($idV), 'code' => $code]);
        }
    }

?>