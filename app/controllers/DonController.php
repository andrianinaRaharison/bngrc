<?php

    namespace app\controllers;

    use Flight;
    use app\models\DonModel;
    use app\models\UniteModel;
    use app\models\BesoinVilleModel;
    use app\models\DispatchModel;
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
            $dispo = $lastDispatch == null ? $don->getAll() : $don->getDonsDispo($lastDispatch['daty']);
            $ordered = $bvm->getByDateDesc();
            $count = 0;
            try {
                $db->beginTransaction();
                foreach($dispo as $d) :
                    if($count == count($ordered)) :
                        $count = 0;
                    endif;
                    $data = [
                        $ordered[$count]['id_ville'],
                        $d['id']
                    ];
                    $dm->insert($data);
                    $count++;
                endforeach;
                $db->commit();
                Flight::render('test-dispatch');
            } catch(Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('test-dispatch', ['error' => $error]);
            }
        }  
    }

?>