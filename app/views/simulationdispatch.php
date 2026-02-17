<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Simulation Dispatch</title>

    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/extensions/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body data-theme="light">
<script src="/assets/static/js/initTheme.js"></script>

<div id="app">

    <?php include('fragments/sidebar.php'); ?>

    <div id="main">

        <div class="page-heading">
            <div class="page-title mb-4">
                <h3>Simulation et Dispatch des Dons</h3>
                <p class="text-subtitle text-muted">
                    Simulez ou validez la répartition des dons vers les villes.
                </p>
            </div>

            <section class="section">
                <div class="row">

                    <!-- BOUTONS ACTION -->
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="bi bi-gear-fill"></i> Simulation</h4>
                            </div>
                            <div class="card-body d-grid gap-2">
                                <a href="/simuler-dispatch" class="btn btn-outline-primary <?= (isset($methode) && $methode === 'date_desc') ? 'active' : '' ?>">
                                    <i class="bi bi-clock-fill"></i> Par date (récent d'abord)
                                </a>
                                <small class="text-muted px-2">Priorité aux besoins les plus récents</small>
                                
                                <a href="/simuler-dispatch-asc" class="btn btn-outline-info <?= (isset($methode) && $methode === 'quantite_asc') ? 'active' : '' ?>">
                                    <i class="bi bi-sort-numeric-up"></i> Par quantité croissante
                                </a>
                                <small class="text-muted px-2">Les petits besoins sont servis en premier (1 → 5 → 10)</small>
                                
                                <a href="/simuler-dispatch-proportionnel" class="btn btn-outline-warning <?= (isset($methode) && $methode === 'proportionnel') ? 'active' : '' ?>">
                                    <i class="bi bi-pie-chart-fill"></i> Distribution proportionnelle
                                </a>
                                <small class="text-muted px-2">Chaque ville reçoit selon son besoin : (besoin × stock) / total</small>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h4><i class="bi bi-check-circle-fill"></i> Valider & Dispatcher</h4>
                            </div>
                            <div class="card-body d-grid gap-2">
                                <a href="/dispatch" class="btn btn-success">
                                    <i class="bi bi-clock-fill"></i> Par date
                                </a>
                                <a href="/dispatch-asc" class="btn btn-success">
                                    <i class="bi bi-sort-numeric-up"></i> Par quantité croissante
                                </a>
                                <a href="/dispatch-proportionnel" class="btn btn-success">
                                    <i class="bi bi-pie-chart-fill"></i> Proportionnel
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- RESULTAT -->
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4><i class="bi bi-diagram-3-fill"></i> Résultat</h4>
                                <div>
                                    <?php if (isset($methode)) : ?>
                                        <span class="badge bg-secondary">
                                            <?php
                                                $methodes = [
                                                    'date_desc' => 'Par date',
                                                    'quantite_asc' => 'Par quantité',
                                                    'proportionnel' => 'Proportionnel'
                                                ];
                                                echo htmlspecialchars($methodes[$methode] ?? $methode);
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (isset($simulation) && $simulation) : ?>
                                        <span class="badge bg-warning">Simulation</span>
                                    <?php elseif (isset($success) && $success) : ?>
                                        <span class="badge bg-success">Validé</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="card-body">

                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        <?= htmlspecialchars($error) ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($success) && $success) : ?>
                                    <div class="alert alert-success">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Dispatch validé et enregistré avec succès !
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($simulation) && $simulation) : ?>
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        Ceci est une simulation. Les données ne sont pas enregistrées définitivement.
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($dispatches) && count($dispatches) > 0) : ?>
                                    <?php
                                    // Grouper les dispatches par ville et objet
                                    $groupedDispatches = [];
                                    foreach ($dispatches as $d) {
                                        $key = $d['ville'] . '|' . $d['objet'];
                                        if (!isset($groupedDispatches[$key])) {
                                            $groupedDispatches[$key] = [
                                                'ville' => $d['ville'],
                                                'objet' => $d['objet'],
                                                'quantite' => 0
                                            ];
                                        }
                                        $groupedDispatches[$key]['quantite'] += $d['quantite'];
                                    }
                                    ?>

                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ville</th>
                                                <th>Don</th>
                                                <th>Quantité dispatchée</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($groupedDispatches as $d) : ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($d['ville']) ?></td>
                                                    <td><?= htmlspecialchars($d['objet']) ?></td>
                                                    <td><?= htmlspecialchars($d['quantite']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <!-- Statistiques par quantité croissante -->
                                    <?php if (isset($totaux_par_ville) && !empty($totaux_par_ville) && isset($methode) && $methode === 'quantite_asc') : ?>
                                        <div class="mt-4">
                                            <h5><i class="bi bi-bar-chart-fill"></i> Totaux par ville (ordre croissant)</h5>
                                            <p class="text-muted">Cette vue montre que la distribution suit bien un ordre croissant des quantités.</p>
                                            <table class="table table-sm table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Ville</th>
                                                        <th>Total reçu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    asort($totaux_par_ville);
                                                    foreach ($totaux_par_ville as $ville => $total) : 
                                                    ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($ville) ?></td>
                                                            <td><?= htmlspecialchars($total) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Statistiques proportionnelles -->
                                    <?php if (isset($stats_proportionnel) && !empty($stats_proportionnel) && isset($methode) && $methode === 'proportionnel') : ?>
                                        <div class="mt-4">
                                            <h5><i class="bi bi-pie-chart-fill"></i> Distribution proportionnelle par objet</h5>
                                            <p class="text-muted">Chaque objet est distribué proportionnellement selon les besoins de chaque ville.</p>
                                            
                                            <?php foreach ($stats_proportionnel as $objet => $stats) : ?>
                                                <div class="card mb-3">
                                                    <div class="card-header bg-light">
                                                        <strong><?= htmlspecialchars($objet) ?></strong>
                                                        <span class="badge bg-primary ms-2">Stock: <?= htmlspecialchars($stats['stock_total']) ?></span>
                                                        <span class="badge bg-warning ms-2">Besoins: <?= htmlspecialchars($stats['besoin_total']) ?></span>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php if (!empty($stats['villes'])) : ?>
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Ville</th>
                                                                        <th>Besoin</th>
                                                                        <th>Reçu</th>
                                                                        <th>Pourcentage</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    $villesUniques = [];
                                                                    foreach ($stats['villes'] as $v) {
                                                                        $nomVille = $v['nom'];
                                                                        if (!isset($villesUniques[$nomVille])) {
                                                                            $villesUniques[$nomVille] = [
                                                                                'besoin' => 0,
                                                                                'recu' => 0
                                                                            ];
                                                                        }
                                                                        $villesUniques[$nomVille]['besoin'] += $v['besoin'];
                                                                        $villesUniques[$nomVille]['recu'] += $v['recu'];
                                                                    }
                                                                    
                                                                    foreach ($villesUniques as $nomVille => $data) : 
                                                                        $pourcentage = $data['besoin'] > 0 ? round(($data['recu'] / $data['besoin']) * 100, 2) : 0;
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= htmlspecialchars($nomVille) ?></td>
                                                                            <td><?= htmlspecialchars($data['besoin']) ?></td>
                                                                            <td><?= htmlspecialchars($data['recu']) ?></td>
                                                                            <td>
                                                                                <div class="progress" style="height: 20px;">
                                                                                    <div class="progress-bar" role="progressbar" style="width: <?= min($pourcentage, 100) ?>%">
                                                                                        <?= $pourcentage ?>%
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        <?php else : ?>
                                                            <p class="text-muted">Aucune distribution pour cet objet.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                <?php else : ?>

                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle-fill"></i>
                                        Aucun dispatch effectué pour le moment.
                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <?php include('fragments/footer.php'); ?>

    </div>
</div>

<script src="/assets/static/js/components/dark.js"></script>
<script src="/assets/compiled/js/app.js"></script>
</body>
</html>
