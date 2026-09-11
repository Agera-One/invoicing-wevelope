<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Transactions</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/payment.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/pagination.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/custom.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row mb-3">
                    <div class="col-sm-6 mb-2">
                        <h3 class="fw-bold h2 m-0 text-white">Payment Transactions</h3>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none text-decoration-custom">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payment Transactions</li>
                        </ol>
                    </div>
                </div>

                <div class="d-flex flex-wrap align-Payments-center justify-content-between gap-3 mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASEURL . 'payment/add' ?>" class="btn btn-custom shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Add Payment
                        </a>
                    </div>

                    <div class="col-md-4 d-flex align-Payments-end gap-2">
                        <form action="" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input name="search" id="table-filter" type="search" class="form-control border-start-0 ps-1" placeholder="Filter rows…" aria-label="Filter rows" autofocus autocomplete="off" value="<?= $_GET['search'] ?? ''; ?>">
                            </div>
                        </form>
                        <a href="<?= BASEURL . 'payment' ?>" class="btn btn-outline-secondary w-25">
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
                                        <th class="ps-4">Payment Code</th>
                                        <th>Invoice Code</th>
                                        <th>Customer Name</th>
                                        <th class="text-center">Payment Date</th>
                                        <th class="text-end">Amount Paid</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                        <tr>
                                            <th class="ps-4 text-light fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td class="fw-medium"><?= $payment['payment_code'] ?></td>
                                            <td><?= $payment['invoice_code'] ?></td>
                                            <td><?= $payment['customer_name'] ?></td>
                                            <td class="text-center"><?= $payment['date'] ?></td>
                                            <td class="text-end">Rp<?= number_format($payment['amount'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon btn-primary" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item text-light" href="<?= BASEURL . 'payment/edit' ?>/<?= $payment['id'] ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="<?= BASEURL . 'payment/delete' ?>/<?= $payment['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
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