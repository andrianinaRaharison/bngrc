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


        public function dispatch() {
            $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new DispatchModel($db);
            $lastDispatch = $dm->getLastDispatch();
            $ordered = $bvm->getByDateDesc();
            $dispo = $don->getDonsDispo($lastDispatch);
            $count = 0;
            try {
                $db->beginTransaction();
                foreach($dispo as $d) :
                    if($count == count($ordered)) :
                        $count == 0;
                    endif;
                    $data = [
                        $ordered[$count]['id_ville'],
                        $d['id']
                    ];
                    $dm->insert($data);
                    $count++;
                endforeach;
                $db->commit();
            } catch(Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
            }
        }  
    }

?>