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

                    <!-- LISTE -->
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4><i class="bi bi-list-ul"></i> Liste des achats</h4>

                                <select class="form-select w-auto">
                                    <!-- <option>Toutes les villes</option>
                                    <option>Antananarivo</option>
                                    <option>Toamasina</option>
                                    <option>Mahajanga</option> -->
                                    <?php foreach($villes as $v) { ?>
                                        <option value="<?php echo $v['id'] ?>"><?php echo $v['nom']; ?></option>
                                    <?php } ?>
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
                                        <!-- <tr>
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
                                        </tr> -->
                                        <?php foreach($achatVille as $av) { ?>
                                            <tr>
                                                <td><?php echo $av['nom']; ?></td>
                                                <td><?php echo $av['libelle']; ?></td>
                                                <td><?php echo $av['quantite']; ?></td>
                                                <td><?php echo $av['prix_unitaire']; ?> Ar</td>
                                                <td><?php echo $av['prix_ttc']; ?> Ar</td>
                                            </tr>
                                        <?php } ?>
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
