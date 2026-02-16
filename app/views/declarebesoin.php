<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déclaration de Besoin</title>

    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/extensions/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
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
                <h3>Déclarer un besoin</h3>
                <p class="text-subtitle text-muted">
                    Sélectionnez la ville et le type de besoin à enregistrer.
                </p>
            </div>

            <section class="section">
                <div class="row justify-content-center">

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <i class="bi bi-plus-circle-fill text-primary"></i>
                                    Nouveau Besoin
                                </h4>
                            </div>

                            <div class="card-body">

                                <form action="/add-besoin" method="POST">

                                    <!-- Ville -->
                                    <div class="mb-3">
                                        <label class="form-label">Ville</label>
                                        <select class="form-select" name="ville_id" required>
                                            <option value="">-- Sélectionner une ville --</option>
                                            <?php foreach ($villes as $ville): ?>
                                                <option value="<?= $ville['id']; ?>">
                                                    <?= htmlspecialchars($ville['nom']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Objet -->
                                    <div class="mb-3">
                                        <label class="form-label">Type de besoin</label>
                                        <select class="form-select" 
                                                name="id_objet" 
                                                id="id_objet" 
                                                required>
                                            <option value="">-- Sélectionner un besoin --</option>
                                            <?php foreach ($besoins as $besoin): ?>
                                                <option value="<?= $besoin['id_objet']; ?>">
                                                    <?= htmlspecialchars($besoin['libelle']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Quantité avec unité dynamique -->
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Quantité 
                                            <span id="unite_label" 
                                                  class="text-primary fw-bold ms-1">
                                            </span>
                                        </label>

                                        <div class="input-group">
                                            <input type="number"
                                                   class="form-control"
                                                   name="quantite"
                                                   min="1"
                                                   required>

                                            <span class="input-group-text" id="unite_badge">
                                                -
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Enregistrer le besoin
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
<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectObjet = document.getElementById('id_objet');
    console.log('Select #id_objet trouvé :', !!selectObjet);
    if (!selectObjet) {
        console.error("Element #id_objet introuvable");
        return;
    }

    selectObjet.addEventListener('change', function () {

        const idObjet = this.value;
        console.log('Objet sélectionné, ID :', idObjet);

        const uniteLabel = document.getElementById('unite_label');
        const uniteBadge = document.getElementById('unite_badge');

        if (!idObjet) {
            uniteLabel.textContent = '';
            uniteBadge.textContent = '-';
            return;
        }

        fetch('/api/unite/' + idObjet)
            .then(response => response.json())
            .then(data => {
                if (data && data.ref) {
                    uniteLabel.textContent = '(' + data.ref + ')';
                    uniteBadge.textContent = data.ref;
                } else {
                    uniteLabel.textContent = '';
                    uniteBadge.textContent = '-';
                }
            })
            .catch(error => {
                console.error('Erreur récupération unité:', error);
            });

    });

});
</script>


<script src="/assets/static/js/components/dark.js"></script>
<script src="/assets/compiled/js/app.js"></script>

<!-- SCRIPT AJAX UNITE -->

</body>
</html>
