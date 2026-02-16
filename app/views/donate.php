<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collecte de Don</title>

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
                <h3>Enregistrer un don (Stock global)</h3>
                <p class="text-subtitle text-muted">
                    Les dons enregistrés ici alimentent le stock central.
                </p>
            </div>

            <section class="section">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="bi bi-gift-fill text-success"></i> Nouveau don</h4>
                            </div>

                            <div class="card-body">

                                <form action="traitement-don.php" method="POST">

                                    <!-- Libellé -->
                                    <div class="form-group mb-3">
                                        <label for="libelle" class="form-label">Libellé du don</label>
                                        <input type="text"
                                               class="form-control"
                                               id="libelle"
                                               name="libelle"
                                               placeholder="Ex : Kits alimentaires"
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
                                               placeholder="Ex : 250"
                                               required>
                                    </div>

                                    <!-- Description -->
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description (optionnelle)</label>
                                        <textarea class="form-control"
                                                  id="description"
                                                  name="description"
                                                  rows="3"
                                                  placeholder="Détails supplémentaires..."></textarea>
                                    </div>

                                    <!-- Bouton -->
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Ajouter au stock global
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
