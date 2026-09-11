<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Invoice</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/custom.css' ?>">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <h3 class="fw-bold h4 m-0 text-white">Add New Invoice</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-decoration-custom" href="<?= BASEURL . 'dashboard' ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none text-decoration-custom" href="<?= BASEURL . 'invoice' ?>">Invoices Billing</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Invoice</li>
                        </ol>
                    </div>
                </div>

                <div class="card card-primary-custom card-outline mb-4">
                    <div class="card-header border-0">
                        <div class="card-title">Add New Invoice</div>
                    </div>
                    <form id="invoiceForm" action="" method="POST">
                        <div class="card-body border-0 row row-gap-2">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Invoice Code</label>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="form-control-plaintext fs-5 fw-bold text-custom bg-body-secondary border rounded px-3 py-2 mb-0">
                                        <i class="bi bi-upc-scan me-2"></i><span><?= $invoice_code ?></span>
                                    </div>
                                    <input type="hidden" name="invoice_code" value="<?= $invoice_code ?>">
                                </div>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">PIC Name</label>
                                <select name="pic_id" class="form-select" aria-label="Default select example" required>
                                    <option value="" disabled selected>Select PIC name</option>
                                    <?php foreach ($pic_data as $pic): ?>
                                        <option value="<?= $pic['id'] ?>" <?= ($pic_id == $pic['id']) ? 'selected' : ''; ?>>
                                            <?= $pic['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Customer Name</label>
                                <select name="customer_id" class="form-select" aria-label="Default select example" required>
                                    <option value="" disabled selected>Select customer name</option>
                                    <?php foreach ($customer_data as $customer): ?>
                                        <option value="<?= $customer['id'] ?>" <?= ($customer_id == $customer['id']) ? 'selected' : ''; ?>>
                                            <?= $customer['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 col-sm-6">
                            <label class="form-label">Date</label>
                                <input id="invoice_date" value="<?= $_POST['date'] ?? date('Y-m-d') ?>" name="date" type="date" class="form-control" required>
                                <div id="invoiceDateError" class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 col-sm-6">
                            <label class="form-label">Due Date</label>
                                <input id="due_date" value="<?= $_POST['due_date'] ?? date('Y-m-d', strtotime('+7 days')) ?>" name="due_date" type="date" class="form-control" required>
                                <div id="dueDateError" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <button type="submit" class="btn btn-custom me-2">Save</button>
                            <a href="<?= BASEURL . 'invoice' ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= BASEURL . 'public/js/invoice.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/adminlte.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/bootstrap.bundle.js' ?>"></script>
</body>

</html>