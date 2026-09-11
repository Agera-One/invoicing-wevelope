<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <h3 class="fw-bold h4 m-0 text-white">Edit Customer</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-decoration-custom" href="<?= BASEURL . 'dashboard' ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none text-decoration-custom" href="<?= BASEURL . 'customer' ?>">Customers Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
                        </ol>
                    </div>
                </div>

                <div class="card card-primary-custom card-outline mb-4">
                    <div class="card-header border-0">
                        <div class="card-title">Edit Customer</div>
                    </div>
                    <form id="customerForm" action="" method="POST">
                        <div class="card-body border-0 row row-gap-2">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Customer Code</label>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="form-control-plaintext fs-5 fw-bold text-custom bg-body-secondary border rounded px-3 py-2 mb-0">
                                        <i class="bi bi-upc-scan me-2"></i><span id="noFakturText"><?= $data['customer_code'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Name</label>
                                <input name="name" value="<?= $name ?>" type="text" class="form-control">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Email</label>
                                <input name="email" value="<?= $email ?>" type="email" class="form-control">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Phone</label>
                                <input name="phone" value="<?= $phone ?>" type="text" class="form-control">
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label class="form-label">Address</label>
                                <input name="address" value="<?= $address ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <button type="submit" class="btn btn-custom me-2">Update</button>
                            <a href="<?= BASEURL . 'customer' ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/adminlte.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/bootstrap.bundle.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/customer.js' ?>"></script>
</body>

</html>