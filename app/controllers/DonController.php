<?php

    namespace app\controllers;

    use Flight;
    use app\models\DonModel;
    use app\models\UniteModel;
    class DonController{

      public function insert(){
        $donModel = new DonModel(Flight::db());
        $donModel->insert();
        $uniteModel = new UniteModel(Flight::db());
        $unites = $uniteModel->getAll();    
            Flight::render('donate', ['unites' => $unites] );
      }
    }

?>