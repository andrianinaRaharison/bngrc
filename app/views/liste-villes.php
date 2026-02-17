<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Villes - Mazer</title>

    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/extensions/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body data-theme="light">
<script src="/assets/static/js/initTheme.js"></script>

<div id="app">
    <?php include('fragments/sidebar.php'); ?>


    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title mb-4">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Villes Répertoriées</h3>
                        <p class="text-subtitle text-muted">Cliquez sur une ville pour accéder aux données locales.</p>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Sélectionnez une localité</h4>
                                <span class="badge bg-primary"><?php echo sizeof($villes); ?> Villes</span>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="list-group">
                                        <!-- <a href="/ville/paris" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Paris</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a>
                                        <a href="/ville/lyon" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Lyon</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a>
                                        <a href="/ville/marseille" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Marseille</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a>
                                        <a href="/ville/bordeaux" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Bordeaux</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a>
                                        <a href="/ville/lille" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Lille</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a>
                                        <a href="/ville/nantes" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Nantes</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a>
                                        <a href="/ville/strasbourg" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-geo-alt text-primary me-2"></i> Strasbourg</span>
                                            <i class="bi bi-chevron-right small text-muted"></i>
                                        </a> -->
                                        <?php foreach($villes as $v) { ?>
                                            <a href="/ville-besoin/<?php echo $v['id']; ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <span><i class="bi bi-geo-alt text-primary me-2"></i> <?php echo $v['nom']; ?></span>
                                                <i class="bi bi-chevron-right small text-muted"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
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