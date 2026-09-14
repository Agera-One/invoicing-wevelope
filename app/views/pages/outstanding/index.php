<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outstanding Invoices</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/outstanding.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/pagination.css' ?>">
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
                        <h3 class="fw-bold h2 m-0 text-white">Outstanding Invoices</h3>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none text-decoration-custom">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Outstanding Invoices</li>
                        </ol>
                    </div>
                </div>

                <div class="d-flex flex-wrap align-items-center justify-content-end gap-3 mb-4">
                    <div class="col-md-4 d-flex gap-2">
                        <form action="" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input name="search" id="table-filter" type="search"
                                    class="form-control border-start-0 ps-1" placeholder="Filter rows…"
                                    aria-label="Filter rows" autofocus autocomplete="off"
                                    value="<?= $search ?? '' ?>">
                            </div>
                        </form>
                        <a href="<?= BASEURL . 'outstanding' ?>" class="btn btn-outline-secondary w-25">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">#</th>
                                        <th class="ps-4">Invoice Code</th>
                                        <th>Customer Name</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-end">Total Bill</th>
                                        <th class="text-end">Amount Paid</th>
                                        <th class="text-end">Remaining Unpaid</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invoices as $invoice):
                                        $remaining_unpaid = $invoice['total_bill'] - $invoice['total_amount_paid']; ?>
                                        <tr>
                                            <th class="ps-4 text-light fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td class="fw-medium"><?= $invoice['invoice_code'] ?></td>
                                            <td><?= $invoice['customer_name'] ?></td>
                                            <td class="text-center"><?= $invoice['date'] ?></td>
                                            <td class="text-center"><?= $invoice['due_date'] ?></td>
                                            <td class="text-end">Rp<?= number_format($invoice['total_bill'], 0, ',', '.') ?></td>
                                            <td class="text-end">Rp<?= number_format($invoice['total_amount_paid'], 0, ',', '.') ?></td>
                                            <td class="text-danger text-end">Rp<?= number_format($remaining_unpaid, 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-custom" href="<?= BASEURL . 'payment/add' ?>/<?= $invoice['id'] ?>">Pay</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php include_once __DIR__ . '/../../components/pagination.php' ?>
                </div>

            </div>
        </main>
    </div>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/adminlte.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/bootstrap.bundle.js' ?>"></script>
</body>

</html>