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
            $ordered = $bvm->getByDateDesc();
            $count = 0;
            $remaining = $don->getDonsDispo();
            try {
                $db->beginTransaction();
                foreach($ordered as $d) :
                    while($bvm->getResteBesoins($d['id']) > 0 && count($don->getMatchingDons($d['id_objet'])) > 0) {
                        $dispo = $don->getMatchingDons($d['id_objet']);
                        if($dispo == null) :
                            $dispo = $don->getDonsDispo();
                        endif;
                        $data = [
                            $d['id_ville'],
                            $dispo[0]['id'],
                            min($dispo[0]['reste'], $bvm->getResteBesoins($d['id']))
                        ];
                        $dm->insert($data);
                        $remaining = $don->getDonsDispo();
                    }
                    $count++;
                endforeach;
                if($remaining != null) {
                    foreach($remaining as $r) {
                        if($count >= count($ordered)) :
                            $count = 0;
                        endif;
                        $data = [
                            $ordered[$count]['id_ville'],
                            $r['id'],
                            $r['reste']
                        ];
                        $dm->insert($data);
                        $count++;
                    }
                }
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