<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices Billing</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/invoice.css' ?>">
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
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <h3 class="fw-bold h4 m-0 text-white">Invoices Billing</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none text-decoration-custom">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Invoices Billing</li>
                        </ol>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary text-uppercase">Total Invoice</small>
                                    <i class="bi bi-receipt text-custom"></i>
                                </div>
                                <div class="fs-5 fw-bold"><?= $total_invoice ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary text-uppercase">Total Paid Invoice</small>
                                    <i class="bi bi-receipt-cutoff text-custom-success"></i>
                                </div>
                                <div class="fs-5 fw-bold"><?= $total_paid_invoice ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary text-uppercase">Total Unpaid Invoice</small>
                                    <i class="bi bi-receipt text-custom-warning"></i>
                                </div>
                                <div class="fs-5 fw-bold">...</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary text-uppercase">Total Overdue Invoice</small>
                                    <i class="bi bi-receipt text-custom-danger"></i>
                                </div>
                                <div class="fs-5 fw-bold">...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <form action="" method="GET">
                        <div class="row g-2 mb-3 d-flex justify-content-end">
                            <div class="col-md-2 d-flex align-items-end">
                                <a href="<?= BASEURL . 'invoice/add' ?>" class="btn btn-custom shadow-sm">
                                    <i class="bi bi-plus-lg me-1"></i> Add Invoice
                                </a>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Keyword</label>
                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control"
                                    placeholder="Search for customers and invoice codes..."
                                    value="<?= $keyword ?? '' ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Date From</label>
                                <input
                                    type="date"
                                    name="date_from"
                                    class="form-control"
                                    value="<?= $date_from ?? ''; ?>">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Date To</label>
                                <input
                                    type="date"
                                    name="date_to"
                                    class="form-control"
                                    value="<?= $date_to ?? ''; ?>">
                            </div>
                            <div class="col-md-2 d-flex align-items-end gap-2">
                                <button id="btn-search" type="submit" class="btn btn-md btn-secondary w-100" name="search">
                                    <i class="bi bi-search me-1"></i>Search
                                </button>
                                <a href="<?= BASEURL . 'invoice' ?>" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>
                    </form>
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
                                        <th>Invoice Date</th>
                                        <th>Due Date</th>
                                        <th>Total Bill</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invoices as $invoice):
                                        $invoice_item = $invoice_detail->invoiceItemCount($invoice['id']);
                                        $remaining_unpaid = $invoice['total_bill'] - $invoice['total_payment']; ?>
                                        <tr>
                                            <th class="ps-4 text-muted fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td class="fw-medium"><?= $invoice['invoice_code'] ?></td>
                                            <td><?= $invoice['customer_name'] ?></td>
                                            <td><?= $invoice['date'] ?></td>
                                            <td><?= $invoice['due_date'] ?></td>
                                            <td>Rp<?= number_format($invoice['total_bill'] ?? 0, 0, ',', '.') ?></td>
                                            <?php if ($remaining_unpaid > 0 && $invoice['due_date'] < $today): ?>
                                                <td class="text-center"><span class="badge text-custom-overdue">Overdue</span></td>
                                            <?php elseif ($invoice_item == 0): ?>
                                                <td class="text-center"><span class="badge text-bg-secondary">No Item</span></td>
                                            <?php elseif ($invoice['total_payment'] < $invoice['total_bill']): ?>
                                                <td class="text-center"><span class="badge text-custom-unpaid">Unpaid</span></td>
                                            <?php elseif ($invoice['total_payment'] == $invoice['total_bill']): ?>
                                                <td class="text-center"><span class="badge text-custom-paid">Paid</span></td>
                                            <?php endif; ?>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item text-light" href="<?= BASEURL . 'invoice/detail' ?>/<?= $invoice['id'] ?>">Detail</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-custom" href="<?= BASEURL . 'invoice/edit' ?>/<?= $invoice['id'] ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="<?= BASEURL . 'invoice/delete' ?>/<?= $invoice['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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

                    <div class="card-footer bg-transparent border-top d-flex justify-content-end p-3">
                        <?php
                        $active = $pagination['active_page'];
                        $total  = $pagination['total_page'];
                        $filter_params = '&keyword=' . urlencode($keyword) . '&date_from=' . urlencode($date_from) . '&date_to=' . urlencode($date_to) . '&search=';

                        function pg_range($active, $total) {
                            $range = [];
                            $range[] = 1;
                            for ($i = $active - 1; $i <= $active + 1; $i++) {
                                if ($i > 1 && $i < $total) $range[] = $i;
                            }
                            if ($total > 1) $range[] = $total;
                            $range = array_unique($range);
                            sort($range);

                            $result = [];
                            $prev = null;
                            foreach ($range as $p) {
                                if ($prev !== null && $p - $prev > 1) $result[] = '...';
                                $result[] = $p;
                                $prev = $p;
                            }
                            return $result;
                        }
                        ?>
                        <nav aria-label="Page navigation" class="m-0">
                            <ul class="pagination pagination-dark m-0">

                                <li class="page-item <?= $active <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=1<?= $filter_params ?>"><i class="bi bi-chevron-double-left"></i></a>
                                </li>

                                <li class="page-item <?= $active <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $active - 1 ?><?= $filter_params ?>"><i class="bi bi-chevron-left"></i></a>
                                </li>

                                <?php foreach (pg_range($active, $total) as $p): ?>
                                    <?php if ($p === '...'): ?>
                                        <li class="page-item disabled"><span class="page-link page-dots">...</span></li>
                                    <?php else: ?>
                                        <li class="page-item <?= $p == $active ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $p ?><?= $filter_params ?>"><?= $p ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <li class="page-item <?= $active >= $total ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $active + 1 ?><?= $filter_params ?>"><i class="bi bi-chevron-right"></i></a>
                                </li>

                                <li class="page-item <?= $active >= $total ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $total ?><?= $filter_params ?>"><i class="bi bi-chevron-double-right"></i></a>
                                </li>

                            </ul>
                        </nav>
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
