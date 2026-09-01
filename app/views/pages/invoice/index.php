<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices Billing</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/invoice.css' ?>">
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
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Invoices Billing</li>
                        </ol>
                    </div>
                </div>

                <div class="flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASEURL . 'invoice/add' ?>" class="btn btn-primary shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Add Invoice
                        </a>
                    </div>

                    <form action="" method="GET">
                        <div class="row g-2 my-3">
                            <div class="col-md-4">
                                <label class="form-label">Keyword</label>
                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control"
                                    placeholder="Search for customers and invoice codes..."
                                    value="<?= $keyword ?? '' ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date From</label>
                                <input
                                    type="date"
                                    name="date_from"
                                    class="form-control"
                                    value="<?= $date_from ?? ''; ?>">
                            </div>
                            <div class="col-md-3">
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
                                        <th>PIC Name</th>
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
                                        $remaining_unpaid = $invoice['total_bill'] - $invoice['total_payment'];
                                        $is_paid = ($invoice_item > 0) && ($invoice['total_bill'] > 0) && ($invoice['total_payment'] == $invoice['total_bill']); ?>
                                        <tr>
                                            <th class="ps-4 text-muted fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td class="fw-medium"><?= $invoice['invoice_code'] ?></td>
                                            <td><?= $invoice['pic_name'] ?></td>
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
                                                            <a class="dropdown-item text-info" href="<?= BASEURL . 'invoice/detail' ?>/<?= $invoice['id'] ?>">Detail</a>
                                                        </li>
                                                        
                                                        <?php if (!$is_paid): ?>
                                                        <li>
                                                            <a class="dropdown-item text-warning" href="<?= BASEURL . 'invoice/edit' ?>/<?= $invoice['id'] ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="<?= BASEURL . 'invoice/delete' ?>/<?= $invoice['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                                        </li>
                                                        <?php endif; ?>
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
                        <nav aria-label="Page navigation example" class="m-0">
                            <ul class="pagination pagination-sm m-0">
                                <?php $filter_params = '&keyword=' . urlencode($keyword) . '&date_from=' . urlencode($date_from) . '&date_to=' . urlencode($date_to) . '&search='; ?>

                                <?php if ($pagination['active_page'] > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $pagination['active_page'] - 1 ?><?= $filter_params ?>">Previous</a></li>
                                <?php else: ?>
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $pagination['total_page']; $i++): ?>
                                    <li class="page-item <?= ($i == $pagination['active_page']) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?><?= $filter_params ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($pagination['active_page'] < $pagination['total_page']): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $pagination['active_page'] + 1 ?><?= $filter_params ?>">Next</a></li>
                                <?php else: ?>
                                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                                <?php endif; ?>
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