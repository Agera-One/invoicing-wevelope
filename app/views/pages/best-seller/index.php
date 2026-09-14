<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Selling Products</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/report.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/best-seller.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/custom.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css" crossorigin="anonymous" />
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row mb-3">
                    <div class="col-sm-6 mb-2">
                        <h3 class="fw-bold h2 m-0 text-white">Best Selling Products</h3>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none text-decoration-custom">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Best Selling Products</li>
                        </ol>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="btn-group period-filter" role="group" aria-label="Period filter">
                        <a href="?period=all"
                            class="btn btn-outline-custom <?= $period === 'all' ? 'active btn-custom text-white' : '' ?>">
                            All Time
                        </a>
                        <a href="?period=yearly"
                            class="btn btn-outline-custom <?= $period === 'yearly' ? 'active btn-custom text-white' : '' ?>">
                            Yearly
                        </a>
                        <a href="?period=monthly"
                            class="btn btn-outline-custom <?= $period === 'monthly' ? 'active btn-custom text-white' : '' ?>">
                            Monthly
                        </a>
                        <a href="?period=weekly"
                            class="btn btn-outline-custom <?= $period === 'weekly' ? 'active btn-custom text-white' : '' ?>">
                            Weekly
                        </a>
                    </div>
                    <span class="text-white-50 mt-2 mt-sm-0">
                        Showing: <span class="fw-semibold text-white"><?= $period_label ?></span>
                    </span>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4" width="60">#</th>
                                        <th class="ps-4">Item Name</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-center">Units Sold</th>
                                        <th class="text-end">Total Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($top_products)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                No sales data found for this period.
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($top_products as $top_product): ?>
                                            <tr>
                                                <th class="ps-4 text-light fw-normal"><?= $number++ ?></th>
                                                <td class="fw-medium"><?= $top_product['item_name'] ?></td>
                                                <td class="text-end">Rp<?= number_format($top_product['price'], 0, ',', '.') ?></td>
                                                <td class="text-center"><?= $top_product['total_unit_sold'] ?></td>
                                                <td class="text-end fw-semibold">Rp<?= number_format($top_product['total_sales'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/adminlte.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/bootstrap.bundle.js' ?>"></script>
</body>

</html>