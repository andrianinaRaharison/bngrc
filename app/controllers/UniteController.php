<?php

    namespace app\controllers;

    use Flight;
    use app\models\UniteModel;

    class UniteController{

      public function getAll(){
        $uniteModel = new UniteModel(Flight::db());
        $unites = $uniteModel->getAll();
        Flight::render('donate', ['unites' => $unites]);
      }
    }

?>