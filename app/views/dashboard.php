<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion des Dons</title>

    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/extensions/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body data-theme="light">
<script src="/assets/static/js/initTheme.js"></script>

<div id="app">
    <!-- SIDEBAR -->
    <div id="sidebar">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="logo">
                    <h5 class="mt-2">Gestion Dons</h5>
                </div>
            </div>

            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Tableau de Bord</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title mb-4">
                <h3>Suivi des besoins et dons par ville</h3>
                <p class="text-subtitle text-muted">
                    Visualisation détaillée des besoins et des dons attribués.
                </p>
            </div>

            <section class="section">
                <div class="row">

                    <!-- VILLE 1 -->
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="bi bi-geo-alt-fill text-primary"></i> Antananarivo</h4>
                            </div>

                            <div class="card-body">

                                <!-- Besoins -->
                                <h6 class="text-danger">Besoins</h6>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between">
                                        Kits alimentaires
                                        <span class="badge bg-danger">500</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        Médicaments
                                        <span class="badge bg-danger">200</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        Couvertures
                                        <span class="badge bg-danger">300</span>
                                    </li>
                                </ul>

                                <!-- Dons -->
                                <h6 class="text-success">Dons attribués</h6>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        Kits alimentaires
                                        <span class="badge bg-success">320</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        Médicaments
                                        <span class="badge bg-success">150</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <!-- VILLE 2 -->
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="bi bi-geo-alt-fill text-primary"></i> Toamasina</h4>
                            </div>

                            <div class="card-body">

                                <h6 class="text-danger">Besoins</h6>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between">
                                        Eau potable (litres)
                                        <span class="badge bg-danger">1000</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        Riz (kg)
                                        <span class="badge bg-danger">800</span>
                                    </li>
                                </ul>

                                <h6 class="text-success">Dons attribués</h6>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        Eau potable (litres)
                                        <span class="badge bg-success">600</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        Riz (kg)
                                        <span class="badge bg-success">300</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2026 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Projet Gestion des Dons</p>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="/assets/static/js/components/dark.js"></script>
<script src="/assets/compiled/js/app.js"></script>

</body>
</html>
