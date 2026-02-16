<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Maquette - Achat des besoins</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/extensions/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
<script src="/assets/static/js/initTheme.js"></script>

<div id="app">

    <!-- SIDEBAR -->
    <?php include('fragments/sidebar.php'); ?>

    <!-- MAIN -->
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title mb-4">
                <h3>Achat des besoins via dons en argent</h3>
                <p class="text-subtitle text-muted">
                    Les achats sont financés à partir du stock monétaire disponible.
                </p>
            </div>

            <section class="section">
                <div class="row">

                    <!-- FORMULAIRE -->
                    <div class="col-12 col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="bi bi-plus-circle-fill text-primary"></i> Nouvel achat</h4>
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Ville</label>
                                    <select class="form-select">
                                        <option>Antananarivo</option>
                                        <option>Toamasina</option>
                                        <option>Mahajanga</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Besoin</label>
                                    <select class="form-select">
                                        <option>Riz</option>
                                        <option>Kits médicaux</option>
                                        <option>Bâches</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Quantité</label>
                                    <input type="number" id="quantite" class="form-control" min="1">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Prix unitaire (Ar)</label>
                                    <input type="number" id="prix_unitaire" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total (Ar)</label>
                                    <input type="number" id="total" class="form-control" readonly>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Valider l'achat
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- LISTE -->
                    <div class="col-12 col-lg-7">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4><i class="bi bi-list-ul"></i> Liste des achats</h4>

                                <select class="form-select w-auto">
                                    <option>Toutes les villes</option>
                                    <option>Antananarivo</option>
                                    <option>Toamasina</option>
                                    <option>Mahajanga</option>
                                </select>
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ville</th>
                                            <th>Besoin</th>
                                            <th>Quantité</th>
                                            <th>Prix U.</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Antananarivo</td>
                                            <td>Riz</td>
                                            <td>100</td>
                                            <td>2 000 Ar</td>
                                            <td>200 000 Ar</td>
                                        </tr>
                                        <tr>
                                            <td>Toamasina</td>
                                            <td>Bâches</td>
                                            <td>50</td>
                                            <td>15 000 Ar</td>
                                            <td>750 000 Ar</td>
                                        </tr>
                                    </tbody>
                                </table>
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
