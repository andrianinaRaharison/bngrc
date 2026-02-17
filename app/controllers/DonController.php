<?php

    namespace app\controllers;

    use Flight;
    use app\models\DonModel;
    use app\models\UniteModel;
    use app\models\BesoinVilleModel;
    use app\models\DispatchModel;
    use app\models\TempDispatchModel;
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
            $ordered = $bvm->getByDateDesc();
            $count = 0;
            $remaining = $don->getDonsDispo();
            try {
                $db->beginTransaction();
                foreach($ordered as $d) :
                    while($bvm->getResteBesoins($d['id']) > 0 && count($don->getMatchingDons($d['id_objet'])) > 0) {
                        $dispo = $don->getMatchingDons($d['id_objet']);
                        if($dispo == null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispo();
                        endif;
                        if($dispo == null || count($dispo) === 0) :
                            break;
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
                if($remaining != null && count($remaining) > 0) {
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
                $dispatches = $dm->getAll();
                Flight::render('simulationdispatch', ['dispatches' => $dispatches, 'success' => true]);
            } catch(Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }  
        public function simulerDispatch() {
         $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new TempDispatchModel($db);
            
            // Vider la table temporaire avant la simulation
            $dm->clearAll();
            
            $ordered = $bvm->getByDateDesc();
            $count = 0;
            $remaining = null;
            try {
                $db->beginTransaction();
                foreach($ordered as $d) :
                    // Utiliser les méthodes temp qui vérifient dispatch_temp
                    while($bvm->getResteBesoinsTemp($d['id']) > 0 && count($don->getMatchingDonsTemp($d['id_objet'])) > 0) {
                        $dispo = $don->getMatchingDonsTemp($d['id_objet']);
                        if($dispo == null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispoTemp();
                        endif;
                        if($dispo == null || count($dispo) === 0) :
                            break;
                        endif;
                        $data = [
                            $d['id_ville'],
                            $dispo[0]['id'],
                            min($dispo[0]['reste'], $bvm->getResteBesoinsTemp($d['id']))
                        ];
                        $dm->insert($data);
                        $remaining = $don->getDonsDispoTemp();
                    }
                    $count++;
                endforeach;
                if($remaining != null && count($remaining) > 0) {
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
                $dispatches = $dm->getAll();
                Flight::render('simulationdispatch', ['dispatches' => $dispatches, 'simulation' => true]);
            } catch(Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }

        public function dispatchByAsc(){
            $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new DispatchModel($db);
            $ordered = $bvm->getByQuantiteAsc();
            $count = 0;
            $remaining = $don->getDonsDispo();
            try {
                $db->beginTransaction();
                foreach($ordered as $d) :
                    while($bvm->getResteBesoins($d['id']) > 0 && count($don->getMatchingDons($d['id_objet'])) > 0) {
                        $dispo = $don->getMatchingDons($d['id_objet']);
                        if($dispo == null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispo();
                        endif;
                        if($dispo == null || count($dispo) === 0) :
                            break;
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
                if($remaining != null && count($remaining) > 0) {
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
                $dispatches = $dm->getAll();
                Flight::render('simulationdispatch', ['dispatches' => $dispatches, 'success' => true]);
            } catch(Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }
    }
?>