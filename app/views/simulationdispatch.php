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
                                <h4><i class="bi bi-gear-fill"></i> Actions</h4>
                            </div>

                            <div class="card-body d-grid gap-2">

                                <a href="/simuler-dispatch" class="btn btn-primary">
                                    <i class="bi bi-eye-fill"></i> Simuler
                                </a>

                                <a href="/dispatch" class="btn btn-success">
                                    <i class="bi bi-check-circle-fill"></i> Valider & Dispatcher
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- RESULTAT -->
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4><i class="bi bi-diagram-3-fill"></i> Résultat</h4>
                                <?php if (isset($simulation) && $simulation) : ?>
                                    <span class="badge bg-warning">Simulation</span>
                                <?php elseif (isset($success) && $success) : ?>
                                    <span class="badge bg-success">Validé</span>
                                <?php endif; ?>
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

                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ville</th>
                                                <th>Don</th>
                                                <th>Quantité dispatchée</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dispatches as $d) : ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($d['ville']) ?></td>
                                                    <td><?= htmlspecialchars($d['objet']) ?></td>
                                                    <td><?= htmlspecialchars($d['quantite']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

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
