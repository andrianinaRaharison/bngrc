<?php

    namespace app\controllers;

    use Flight;
    use app\DonModel;
    use app\BesoinVilleModel;

    class DonController {

        public function dispatch() {
            $don = new DonModel(Flight::db());
            $bvm = new BesoinVilleModel(Flight::db());
            $ordered = $bvm->getByDateDesc();
        }    

    }

?>