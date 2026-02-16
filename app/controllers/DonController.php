<?php

    namespace app\controllers;

    use Flight;
    use app\DonModel;
    use app\BesoinVilleModel;
    use app\DispatchModel;

    class DonController {

        public function dispatch() {
            $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new DispatchModel($db);
            $ordered = $bvm->getByDateDesc();
            $dispo = $don->getDonsDispo();
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