<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/user.css' ?>">
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
                        <h3 class="fw-bold h4 m-0 text-white">User Management</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>" class="text-decoration-none text-decoration-custom">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Management</li>
                        </ol>
                    </div>
                </div>

                <!-- <div class="row g-3 mb-3">
                    <div class="col-6 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary text-uppercase">Total Payment</small>
                                    <i class="bi bi-credit-card text-custom"></i>
                                </div>
                                <div class="fs-5 fw-bold">...</div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASEURL . 'user/add' ?>" class="btn btn-custom shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Add User
                        </a>
                    </div>

                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <form action="" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input name="search" id="table-filter" type="search" class="form-control border-start-0 ps-1" placeholder="Filter rows…" aria-label="Filter rows" autofocus autocomplete="off" value="<?= $_GET['search'] ?? ''; ?>">
                            </div>
                        </form>
                        <a href="<?= BASEURL . 'user' ?>" class="btn btn-outline-secondary w-25">
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
                                        <th class="ps-4">Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user):
                                        $updated_at = new DateTime($user['updated_at']); ?>
                                        <tr>
                                            <th class="ps-4 text-muted fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= date('d F Y', strtotime($user['created_at'])) ?></td>
                                            <td><?= $updated_at->format('d F Y H:i') ?></td>
                                            <?= ($user['id'] == $user_id) ? '<td class="text-center"><span class="badge text-custom-success"> Online </span></td>' : '<td class="text-center"><span class="badge text-bg-secondary"> Offline </span></td>'; ?>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item text-custom" href="<?= BASEURL . 'user/edit' ?>/<?= $user['id'] ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="<?= BASEURL . 'user/delete' ?>/<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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