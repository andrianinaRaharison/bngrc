<?php

    namespace app\controllers;

    use Flight;
    use app\models\VilleModel;
    use app\models\BesoinVilleModel;

    class VilleController{

      public function renderAll(){
        $villeModel = new VilleModel(Flight::db());
        $villes = $villeModel->getAll();
        Flight::render('liste-villes', ['villes' => $villes]);
      }

      public function renderBesoinByVille($id) {
        $bvm = new BesoinVilleModel(Flight::db());
        $vm = new VilleModel(Flight::db());
        Flight::render('ville-besoin', ['data' => $bvm->getByIdVille($id), 'ville' => $vm->getById($id)]);
      }
    }

?>