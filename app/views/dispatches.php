<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispatch des Besoins</title>

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
        <h3>Dispatch des Besoins</h3>
        <p class="text-subtitle text-muted">
            Répartition et suivi des montants dispatchés.
        </p>
    </div>

    <!-- 🔹 BOUTONS DISPATCH -->
    <section class="section">
        <div class="row">

            <!-- Dispatch total -->
            <div class="col-12 col-lg-4">
                <button class="card w-100 btn btn-outline-primary text-start p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon blue me-3">
                            <i class="bi bi-calculator fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted">Dispatcher Besoins Totaux</h6>
                            <h4 class="fw-bold mb-0">DISPATCH</h4>
                        </div>
                    </div>
                </button>
            </div>

            <!-- Dispatch satisfait -->
            <div class="col-12 col-lg-4">
                <button class="card w-100 btn btn-outline-success text-start p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon green me-3">
                            <i class="bi bi-check-circle fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted">Dispatcher Montant Satisfait</h6>
                            <h4 class="fw-bold mb-0">DISPATCH</h4>
                        </div>
                    </div>
                </button>
            </div>

            <!-- Dispatch restant -->
            <div class="col-12 col-lg-4">
                <button class="card w-100 btn btn-outline-danger text-start p-4">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon red me-3">
                            <i class="bi bi-exclamation-triangle fs-3"></i>
                        </div>
                        <div>
                            <h6 class="text-muted">Dispatcher Montant Restant</h6>
                            <h4 class="fw-bold mb-0">DISPATCH</h4>
                        </div>
                    </div>
                </button>
            </div>

        </div>
    </section>

    <!-- 🔹 TABLEAU DES DISPATCHS -->
    <section class="section mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Historique des Dispatchs</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Ville</th>
                                <th>Type</th>
                                <th>Montant</th>
                                <th>Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Exemple statique -->
                            <tr>
                                <td>2026-02-16</td>
                                <td>Antananarivo</td>
                                <td>Besoins Totaux</td>
                                <td class="text-primary fw-bold">1 200 000 Ar</td>
                                <td>Admin</td>
                            </tr>

                            <tr>
                                <td>2026-02-17</td>
                                <td>Toamasina</td>
                                <td>Montant Satisfait</td>
                                <td class="text-success fw-bold">800 000 Ar</td>
                                <td>Admin</td>
                            </tr>

                            <!-- Plus tard : foreach ($dispatchs as $d) -->
                        </tbody>
                    </table>
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
