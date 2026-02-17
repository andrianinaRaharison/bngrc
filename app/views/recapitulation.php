<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération des Besoins - Mazer</title>

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
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Récapitulatif financier</h3>
                        <p class="text-subtitle text-muted">Aperçu des montants engagés et restants.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first text-end">
                        <button id="btn-refresh" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-clockwise"></i> Actualiser les données
                        </button>
                    </div>
                </div>
            </div>

            <section class="section mt-4">
                <div class="row">
                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi bi-calculator"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Besoins Totaux</h6>
                                        <h6 class="font-extrabold mb-0"><span id="total-amount"><?= $total?></span> Ar</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Montant Satisfait</h6>
                                        <h6 class="font-extrabold mb-0 text-success"><span id="satisfied-amount"><?= $satisfait?></span> Ar</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Montant Restant</h6>
                                        <h6 class="font-extrabold mb-0 text-danger"><span id="remaining-amount"><?= $reste?></span> Ar</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Progression globale de satisfaction</h4>
                            </div>
                            <div class="card-body">
                                <div class="progress progress-primary mb-4" style="height: 25px;">
                                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" 
                                         role="progressbar" style="width: 64%" 
                                         aria-valuenow="64" aria-valuemin="0" aria-valuemax="100">64%</div>
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

<script>
document.getElementById('btn-refresh').addEventListener('click', function() {
    const btn = this;
    const icon = btn.querySelector('i');
    
    // Animation de rotation
    icon.classList.add('bi-spin'); // Assurez-vous d'avoir un CSS pour la rotation ou gérez-le manuellement
    btn.disabled = true;

    // Simulation d'appel AJAX
    setTimeout(() => {
        // Ici vous feriez votre fetch() vers votre API/PHP
        console.log("Données actualisées");
        
        // Exemple de mise à jour DOM
        // document.getElementById('total-amount').innerText = "Nouveau Montant";
        
        icon.classList.remove('bi-spin');
        btn.disabled = false;
    }, 1000);
});
</script>

<style>
/* Petite animation pour le bouton refresh */
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.bi-spin {
    display: inline-block;
    animation: spin 1s linear infinite;
}
</style>

</body>
</html>