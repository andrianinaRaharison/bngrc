<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails des Besoins - Mazer</title>

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
            <div class="row">
                <div class="col-12">
                    <div class="card bg-primary text-white">
                        <div class="card-body px-4 py-4-5 text-center">
                            <h6 class="text-white-50 font-semibold">Montant restant sur les dons. Ville: <b><?php echo $ville['nom'] ?></b></h6>
                            <h2 class="font-extrabold mb-0"><?php echo $ville['reste_don_arg']; ?> Ar</h2>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(isset($code)) { ?>
                <?php if($code['ok']) { ?>
                    <div class="bg-light-success text-center rounded text-success py-2 px-3">
                        Completed successfully.
                    </div>
                <?php } else { ?>
                    <div class="bg-light-danger text-center rounded text-danger py-2 px-3">
                        <?= $code['error'] ?>
                    </div>
                <?php } ?>
            <?php } ?>

            <div class="page-title mb-4">
                <h3>Gestion des Besoins</h3>
                <p class="text-subtitle text-muted">Achat et suivi des fournitures nécessaires.</p>
            </div>

            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des fournitures</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Besoin</th>
                                        <th>Statut</th>
                                        <th>Restant</th>
                                        <th width="300">Acheter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold mb-0">Riz Blanc (Sacs)</p>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <span class="badge bg-light-danger">Non satisfait</span>
                                        </td>
                                        <td class="col-2">
                                            <span class="badge bg-light-danger">120</span>
                                        </td>
                                        <td class="col-7">
                                            <form action="/buy" method="POST" class="row g-2">
                                                <div class="col-8">
                                                    <input type="number" class="form-control" name="quantity" placeholder="Qté" required min="1">
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <i class="bi bi-cart-plus"></i> Buy
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold mb-0 text-muted">Huile de table (L)</p>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <span class="badge bg-light-success">Satisfait</span>
                                        </td>
                                        <td class="col-2">
                                            <span class="badge bg-light-danger">0</span>
                                        </td>
                                        <td class="col-7">
                                            <form action="/buy" method="POST" class="row g-2">
                                                <div class="col-8">
                                                    <input type="number" class="form-control" name="quantity" placeholder="Qté" disabled>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button type="submit" class="btn btn-secondary w-100" disabled>
                                                        Complet
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr> -->
                                    <?php foreach($data as $d) {
                                        $classSat = $d['reste'] == 0 ? 'success' : 'danger';
                                        $valueSat = $d['reste'] == 0 ? 'Satisfait' : 'Non satisfait';
                                        ?>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold mb-0"><?= $d['libelle']; ?></p>
                                                </div>
                                            </td>
                                            <td class="col-2">
                                                <span class="badge bg-light-<?= $classSat ?>"><?= $valueSat ?></span>
                                            </td>
                                            <td class="col-2">
                                                <span class="badge bg-light-danger"><?= $d['reste'] ?></span>
                                            </td>
                                            <td class="col-7">
                                                <form action="/acheter" method="POST" class="row g-2">
                                                    <input type="hidden" name="id_ville" value="<?= $ville['id']; ?>">
                                                    <input type="hidden" name="id_besoin" value="<?= $d['id_besoin']; ?>">
                                                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                                                    <div class="col-8">
                                                        <input type="number" class="form-control" name="quantity" placeholder="Qté" required min="1" <?= $d['reste'] == 0 ? 'disabled' : '' ?>>
                                                    </div>
                                                    <div class="col-4 text-end">
                                                        <button type="submit" class="btn btn-primary w-100" <?= $d['reste'] == 0 ? 'disabled' : '' ?>>
                                                            <i class="bi bi-cart-plus"></i> Buy
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
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