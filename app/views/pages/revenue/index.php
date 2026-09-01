<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Overview</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/report.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/revenue.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css" crossorigin="anonymous" />
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <h3 class="fw-bold h4 m-0 text-white">Revenue Overview</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Revenue Overview</li>
                        </ol>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="btn-group period-filter" role="group" aria-label="Period filter">
                        <a href="?period=daily"
                            class="btn btn-outline-primary <?= $period === 'daily' ? 'active btn-primary text-white' : '' ?>">
                            Daily
                        </a>
                        <a href="?period=weekly"
                            class="btn btn-outline-primary <?= $period === 'weekly' ? 'active btn-primary text-white' : '' ?>">
                            Weekly
                        </a>
                        <a href="?period=monthly"
                            class="btn btn-outline-primary <?= $period === 'monthly' ? 'active btn-primary text-white' : '' ?>">
                            Monthly
                        </a>
                    </div>
                    <span class="text-white-50 mt-2 mt-sm-0">
                        Showing: <span class="fw-semibold text-white"><?= ucfirst($period) ?></span>
                    </span>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">#</th>
                                        <th class="ps-4">Period</th>
                                        <th class="text-center">Invoices Paid</th>
                                        <th class="text-center">Total Payments</th>
                                        <th class="text-end">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($omsets)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">No revenue data found.</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php foreach ($omsets as $omset): ?>
                                        <tr>
                                            <th class="ps-4 text-muted fw-normal"><?= $number++ ?></th>
                                            <td class="fw-medium"><?= $omset['period'] ?></td>
                                            <td class="text-center"><?= $omset['total_invoice'] ?></td>
                                            <td class="text-center"><?= $omset['total_payment'] ?></td>
                                            <td class="text-end fw-semibold">Rp<?= number_format($omset['revenue'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
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