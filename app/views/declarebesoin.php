<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Besoin</title>

    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/extensions/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body data-theme="light">
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
                <h3>Enregistrer un nouveau besoin</h3>
                <p class="text-subtitle text-muted">
                    Indiquez la ville, le besoin spécifique et la quantité nécessaire.
                </p>
            </div>

            <section class="section">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="bi bi-geo-alt-fill text-primary"></i> Nouveau Besoin</h4>
                            </div>

                            <div class="card-body">

                                <form action="/besoin" method="POST">

                                    <!-- Ville -->
                                    <div class="form-group mb-3">
                                        <label for="ville_id" class="form-label">Ville</label>
                                        <select class="form-select" id="ville_id" name="ville_id" required>
                                            <option value="">-- Sélectionner une ville --</option>
                                            <option value="1">Antananarivo</option>
                                            <option value="2">Toamasina</option>    
                                        </select>
                                    </div>

                                    <!-- Besoin spécifique -->
                                    <div class="form-group mb-3">
                                        <label for="libelle" class="form-label">Besoin spécifique</label>
                                        <input type="text"
                                               class="form-control"
                                               id="libelle"
                                               name="libelle"
                                               placeholder="Ex : Riz, Médicaments"
                                               required>
                                    </div>

                                    <!-- Quantité -->
                                    <div class="form-group mb-3">
                                        <label for="quantite" class="form-label">Quantité</label>
                                        <input type="number"
                                               class="form-control"
                                               id="quantite"
                                               name="quantite"
                                               min="1"
                                               placeholder="Ex : 100"
                                               required>
                                    </div>

                                    <!-- Bouton -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Ajouter le besoin
                                        </button>
                                    </div>

                                </form>

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
