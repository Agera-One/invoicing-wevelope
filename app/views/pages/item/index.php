<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Management</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/item.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/pagination.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/custom.css' ?>">
</head>

<body class="layout-fixed fixed-header sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row mb-3">
                    <div class="col-sm-6 mb-2">
                        <h3 class="fw-bold h2 m-0">Items Management</h3>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="<?= BASEURL . 'dashboard' ?>"
                                    class="text-decoration-none text-decoration-custom">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Items Management</li>
                        </ol>
                    </div>
                </div>
     
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= BASEURL . 'item/add' ?>" class="btn btn-custom shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Add Item
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
                                    aria-label="Filter rows" autofocus autocomplete="off" value="<?= $search ?? ''; ?>">
                            </div>
                        </form>
                        <a href="<?= BASEURL . 'item' ?>" class="btn btn-outline-secondary w-25">
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
                                        <th>Reference Number</th>
                                        <th>Name</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <tr>
                                            <th class="ps-4 text-light fw-normal"><?= ++$pagination['offset'] ?></th>
                                            <td class="fw-medium"><?= $item['ref_no'] ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td class="text-end">Rp<?= number_format($item['price'], 0, ',', '.') ?></td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon btn-custom" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item text-light"
                                                                href="<?= BASEURL . 'item/edit' ?>/<?= $item['id'] ?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-danger"
                                                                href="<?= BASEURL . 'item/delete' ?>/<?= $item['id'] ?>"
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