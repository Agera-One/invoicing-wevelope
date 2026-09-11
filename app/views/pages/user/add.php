<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
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
                        <h3 class="fw-bold h4 m-0 text-white">Add New User</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-decoration-custom" href="<?= BASEURL . 'dashboard' ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none text-decoration-custom" href="<?= BASEURL . 'user' ?>">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                        </ol>
                    </div>
                </div>

                <div class="card card-primary-custom card-outline mb-4">
                    <div class="card-header border-0">
                        <div class="card-title">Add New User</div>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body border-0">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input id="name" value="<?= $_SESSION['old']['name'] ?? '' ?>" name="name" type="text" class="form-control" required>
                                <div class="invalid-feedback" id="nameError"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input id="email" value="<?= $_SESSION['old']['email'] ?? '' ?>" name="email" type="email" class="form-control" required>
                                <div class="invalid-feedback" id="emailError"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input id="password" value="<?= $_SESSION['old']['password'] ?? '' ?>" name="password" type="password" class="form-control" required>
                                <div class="invalid-feedback" id="passwordError"></div>
                            </div>

                            <?php if (isset($_SESSION['error'])): ?>
                                <script>
                                    alert("<?= $_SESSION['error'] ?>")
                                </script>
                                <?php unset($_SESSION['error']); ?>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer border-0">
                            <button type="submit" class="btn btn-custom me-2">Save</button>
                            <a href="<?= BASEURL . 'user' ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/adminlte.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/bootstrap.bundle.js' ?>"></script>
</body>

</html>