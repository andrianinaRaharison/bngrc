<?php

    namespace app\controllers;

    use Flight;
    use app\models\DonModel;
    use app\models\UniteModel;
    use app\models\BesoinVilleModel;
    use app\models\DispatchModel;
    use app\models\TempDispatchModel;
    use app\models\VilleModel;
    class DonController{

      /**
       * Calcule la distribution proportionnelle avec arrondi intelligent
       * @param array $besoinsList Liste des besoins [{id, id_ville, reste, ...}, ...]
       * @param float $stockTotal Stock total disponible
       * @return array Distribution par ville [{id_ville, quantite}, ...]
       */
      private function calculerDistributionProportionnelle($besoinsList, $stockTotal) {
          if (empty($besoinsList) || $stockTotal <= 0) {
              return [];
          }

          // Total des besoins
          $besoinTotal = 0;
          foreach ($besoinsList as $b) {
              $besoinTotal += $b['reste'];
          }

          if ($besoinTotal <= 0) {
              return [];
          }

          $distribution = [];
          
          // Calculer les parts proportionnelles
          foreach ($besoinsList as $b) {
              $partExacte = ($b['reste'] * $stockTotal) / $besoinTotal;
              $partExacte = min($partExacte, $b['reste']); // Ne pas dépasser le besoin
              
              $distribution[] = [
                  'id_ville' => $b['id_ville'],
                  'id_besoin' => $b['id'],
                  'part_exacte' => $partExacte,
                  'part_entier' => floor($partExacte),
                  'part_decimal' => $partExacte - floor($partExacte)
              ];
          }

          // Total distribué après arrondi
          $totalDistribue = 0;
          foreach ($distribution as $d) {
              $totalDistribue += $d['part_entier'];
          }

          // Reste à distribuer
          $reste = $stockTotal - $totalDistribue;

          // Trier par partie décimale décroissante
          usort($distribution, function($a, $b) {
              return $b['part_decimal'] <=> $a['part_decimal'];
          });

          // Distribuer le reste en ajoutant 1 aux plus grandes décimales
          for ($i = 0; $i < $reste && $i < count($distribution); $i++) {
              $distribution[$i]['part_entier'] += 1;
          }

          return $distribution;
      }

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
                        if($dispo === null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispo();
                        endif;
                        if($dispo === null || count($dispo) === 0) :
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
                if($remaining !== null && count($remaining) > 0) {
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
                Flight::render('simulationdispatch', ['dispatches' => $dispatches, 'success' => true, 'methode' => 'date_desc']);
            } catch(\Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }

        public function dispatchByAsc() {
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
                        if($dispo === null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispo();
                        endif;
                        if($dispo === null || count($dispo) === 0) :
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
                if($remaining !== null && count($remaining) > 0) {
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
                
                // Grouper par ville pour montrer l'ordre croissant
                $parVille = [];
                foreach ($dispatches as $d) {
                    if (!isset($parVille[$d['ville']])) {
                        $parVille[$d['ville']] = 0;
                    }
                    $parVille[$d['ville']] += $d['quantite'];
                }
                
                Flight::render('simulationdispatch', [
                    'dispatches' => $dispatches, 
                    'success' => true, 
                    'methode' => 'quantite_asc',
                    'totaux_par_ville' => $parVille
                ]);
            } catch(\Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }

        public function dispatchProportionnel() {
            $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new DispatchModel($db);
            $villeModel = new VilleModel($db);
            try {
                $db->beginTransaction();

                $besoins = $bvm->getBesoinsParObjet();
                $parObjet = [];
                foreach ($besoins as $b) {
                    $parObjet[$b['id_objet']][] = $b;
                }

                $statsParObjet = [];
                
                foreach ($parObjet as $idObjet => $besoinsList) {
                    $stocks = $don->getStockByObjet($idObjet);
                    if (empty($stocks)) {
                        continue;
                    }

                    $stockTotal = 0;
                    foreach ($stocks as $s) {
                        $stockTotal += $s['reste'];
                    }
                    
                    $besoinTotal = 0;
                    foreach ($besoinsList as $b) {
                        $besoinTotal += $b['reste'];
                    }

                    // Stocker les statistiques
                    $statsParObjet[$besoinsList[0]['libelle']] = [
                        'stock_total' => floor($stockTotal),
                        'besoin_total' => $besoinTotal,
                        'villes' => []
                    ];

                    // Calculer la distribution proportionnelle avec arrondi intelligent
                    $distribution = $this->calculerDistributionProportionnelle($besoinsList, floor($stockTotal));

                    // Stocker les distributions par ville
                    foreach ($distribution as $d) {
                        foreach ($besoinsList as $b) {
                            if ($b['id_ville'] === $d['id_ville']) {
                                $nomVille = $villeModel->getNomById($b['id_ville']);
                                $statsParObjet[$besoinsList[0]['libelle']]['villes'][] = [
                                    'nom' => $nomVille,
                                    'besoin' => $b['reste'],
                                    'recu' => $d['part_entier']
                                ];
                                break;
                            }
                        }
                    }

                    // Distribuer selon le calcul
                    $stockIndex = 0;
                    $stockDonRestant = $stocks[$stockIndex]['reste'];

                    foreach ($distribution as $d) {
                        $aDistribuer = $d['part_entier'];

                        while ($aDistribuer > 0 && $stockIndex < count($stocks)) {
                            $quantite = min($aDistribuer, floor($stockDonRestant));
                            if ($quantite > 0) {
                                $data = [
                                    $d['id_ville'],
                                    $stocks[$stockIndex]['id'],
                                    $quantite
                                ];
                                $dm->insert($data);
                            }
                            $aDistribuer -= $quantite;
                            $stockDonRestant -= $quantite;

                            if ($stockDonRestant <= 0) {
                                $stockIndex++;
                                if ($stockIndex < count($stocks)) {
                                    $stockDonRestant = $stocks[$stockIndex]['reste'];
                                }
                            }
                        }
                    }
                }

                $db->commit();
                $dispatches = $dm->getAll();
                Flight::render('simulationdispatch', [
                    'dispatches' => $dispatches, 
                    'success' => true, 
                    'methode' => 'proportionnel',
                    'stats_proportionnel' => $statsParObjet
                ]);
            } catch(\Exception $e) {
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
            $dm->clearAll();
            $ordered = $bvm->getByDateDesc();
            $count = 0;
            $remaining = null;
            try {
                $db->beginTransaction();
                foreach($ordered as $d) :
                    while($bvm->getResteBesoinsTemp($d['id']) > 0 && count($don->getMatchingDonsTemp($d['id_objet'])) > 0) {
                        $dispo = $don->getMatchingDonsTemp($d['id_objet']);
                        if($dispo === null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispoTemp();
                        endif;
                        if($dispo === null || count($dispo) === 0) :
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
                if($remaining !== null && count($remaining) > 0) {
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
                Flight::render('simulationdispatch', ['dispatches' => $dispatches, 'simulation' => true, 'methode' => 'date_desc']);
            } catch(\Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }

        public function simulerDispatchByAsc() {
            $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new TempDispatchModel($db);
            $dm->clearAll();
            $ordered = $bvm->getByQuantiteAsc();
            $count = 0;
            $remaining = null;
            try {
                $db->beginTransaction();
                foreach($ordered as $d) :
                    while($bvm->getResteBesoinsTemp($d['id']) > 0 && count($don->getMatchingDonsTemp($d['id_objet'])) > 0) {
                        $dispo = $don->getMatchingDonsTemp($d['id_objet']);
                        if($dispo === null || count($dispo) === 0) :
                            $dispo = $don->getDonsDispoTemp();
                        endif;
                        if($dispo === null || count($dispo) === 0) :
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
                if($remaining !== null && count($remaining) > 0) {
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
                
                // Grouper par ville pour montrer l'ordre croissant
                $parVille = [];
                foreach ($dispatches as $d) {
                    if (!isset($parVille[$d['ville']])) {
                        $parVille[$d['ville']] = 0;
                    }
                    $parVille[$d['ville']] += $d['quantite'];
                }
                
                Flight::render('simulationdispatch', [
                    'dispatches' => $dispatches, 
                    'simulation' => true, 
                    'methode' => 'quantite_asc',
                    'totaux_par_ville' => $parVille
                ]);
            } catch(\Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }

        public function simulerDispatchProportionnel() {
            $db = Flight::db();
            $don = new DonModel($db);
            $bvm = new BesoinVilleModel($db);
            $dm = new TempDispatchModel($db);
            $villeModel = new VilleModel($db);
            $dm->clearAll();
            try {
                $db->beginTransaction();

                $besoins = $bvm->getBesoinsParObjetTemp();
                $parObjet = [];
                foreach ($besoins as $b) {
                    $parObjet[$b['id_objet']][] = $b;
                }

                $statsParObjet = [];
                
                foreach ($parObjet as $idObjet => $besoinsList) {
                    $stocks = $don->getStockByObjetTemp($idObjet);
                    if (empty($stocks)) {
                        continue;
                    }

                    $stockTotal = 0;
                    foreach ($stocks as $s) {
                        $stockTotal += $s['reste'];
                    }
                    
                    $besoinTotal = 0;
                    foreach ($besoinsList as $b) {
                        $besoinTotal += $b['reste'];
                    }

                    // Stocker les statistiques
                    $statsParObjet[$besoinsList[0]['libelle']] = [
                        'stock_total' => floor($stockTotal),
                        'besoin_total' => $besoinTotal,
                        'villes' => []
                    ];

                    // Calculer la distribution proportionnelle avec arrondi intelligent
                    $distribution = $this->calculerDistributionProportionnelle($besoinsList, floor($stockTotal));

                    // Stocker les distributions par ville
                    foreach ($distribution as $d) {
                        foreach ($besoinsList as $b) {
                            if ($b['id_ville'] === $d['id_ville']) {
                                $nomVille = $villeModel->getNomById($b['id_ville']);
                                $statsParObjet[$besoinsList[0]['libelle']]['villes'][] = [
                                    'nom' => $nomVille,
                                    'besoin' => $b['reste'],
                                    'recu' => $d['part_entier']
                                ];
                                break;
                            }
                        }
                    }

                    // Distribuer selon le calcul
                    $stockIndex = 0;
                    $stockDonRestant = $stocks[$stockIndex]['reste'];

                    foreach ($distribution as $d) {
                        $aDistribuer = $d['part_entier'];

                        while ($aDistribuer > 0 && $stockIndex < count($stocks)) {
                            $quantite = min($aDistribuer, floor($stockDonRestant));
                            if ($quantite > 0) {
                                $data = [
                                    $d['id_ville'],
                                    $stocks[$stockIndex]['id'],
                                    $quantite
                                ];
                                $dm->insert($data);
                            }
                            $aDistribuer -= $quantite;
                            $stockDonRestant -= $quantite;

                            if ($stockDonRestant <= 0) {
                                $stockIndex++;
                                if ($stockIndex < count($stocks)) {
                                    $stockDonRestant = $stocks[$stockIndex]['reste'];
                                }
                            }
                        }
                    }
                }

                $db->commit();
                $dispatches = $dm->getAll();
                Flight::render('simulationdispatch', [
                    'dispatches' => $dispatches, 
                    'simulation' => true, 
                    'methode' => 'proportionnel',
                    'stats_proportionnel' => $statsParObjet
                ]);
            } catch(\Exception $e) {
                $db->rollback();
                $error = "Error while dispatching...";
                Flight::render('simulationdispatch', ['error' => $error]);
            }
        }

        public function renderPage() {
            Flight::render('simulationdispatch');
        }
    }
?>