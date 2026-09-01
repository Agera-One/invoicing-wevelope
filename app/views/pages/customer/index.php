<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/customer.css' ?>">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <h3 class="fw-bold h4 m-0">Customers Management</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>"
                                    class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customers Management</li>
                        </ol>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary text-uppercase">Total Customers</small>
                                    <i class="bi bi-people text-primary"></i>
                                </div>
                                <div class="fs-5 fw-bold">...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap align-item-center justify-content-between gap-3 mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASEURL . 'customer/add' ?>" class="btn btn-primary shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Add Customer
                        </a>
                        <a href="<?= BASEURL . 'customer/export' ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-filetype-csv me-1"></i>
                            Export CSV
                        </a>
                        <a href="<?= BASEURL . 'customer/import' ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-filetype-csv me-1"></i>
                            Import CSV
                        </a>
                    </div>

                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <form action="" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input name="search" id="table-filter" type="search"
                                    class="form-control border-start-0 ps-1" placeholder="Filter rows…"
                                    aria-label="Filter rows" autofocus autocomplete="off"
                                    value="<?= $_GET['search'] ?? ''; ?>">
                            </div>
                        </form>
                        <a href="<?= BASEURL . 'customer' ?>" class="btn btn-outline-secondary w-25">
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
                                        <th class="ps-4">Customer Code</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customers as $customer): ?>
                                        <tr>
                                            <th class="text-secondary fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td class="fw-medium"><?= $customer['customer_code'] ?></td>
                                            <td><?= $customer['name'] ?></td>
                                            <td><?= $customer['email'] ?></td>
                                            <td><?= $customer['phone'] ?></td>
                                            <td><?= $customer['address'] ?></td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item text-warning"
                                                                href="<?= BASEURL . 'customer/edit' ?>/<?= $customer['id'] ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger"
                                                                href="<?= BASEURL . 'customer/delete' ?>/<?= $customer['id'] ?>"
                                                                onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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