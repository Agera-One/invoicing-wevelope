<?php
$trend_values = $trend_values ?? [];
$trend_labels = $trend_labels ?? [];
$unpaid_trend_values = $unpaid_trend_values ?? [];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/adminlte.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/dashboard.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/custom.css' ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php include_once __DIR__ . '/../../components/navbar.php' ?>
        <?php include_once __DIR__ . '/../../components/sidebar.php' ?>

        <main class="app-main py-4">
            <div class="container-fluid px-4">
                <div class="row mb-3">
                    <div class="col-sm-6 mb-2">
                        <h3 class="fw-bold h2 m-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <ol class="breadcrumb float-sm-end mb-0">
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <?php foreach ($mini_stats as $stat): ?>
                        <div class="col-6 col-lg-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-secondary text-uppercase"><?= $stat['label'] ?></small>
                                        <i class="bi <?= $stat['icon'] ?>"></i>
                                    </div>
                                    <div class="<?= $stat['text'] ?> fs-5 fw-bold"><?= $stat['value'] ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-lg-8">
                        <div class="card h-100 shadow-sm border-0">
                            <!-- Tambahkan d-flex flex-column agar header dan grafik tersusun rapi -->
                            <div class="card-body d-flex flex-column">

                                <!-- Header Statistik (Tetap sama) -->
                                <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-3">
                                    <div>
                                        <div class="dash-section-title mb-2"><span class="channel-dot" style="background:#5abd85"></span> Revenue Trend</div>
                                        <?php if ($trend_values): ?>
                                            <div class="d-flex align-items-baseline gap-2">
                                                <span class="fs-3 fw-bold">Rp<?= number_format($trend_latest, 0, ',', '.') ?></span>
                                            </div>
                                            <small class="text-secondary">vs previous day</small>
                                        <?php else: ?>
                                            <div class="text-secondary small">No payment data yet.</div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="dash-section-title mb-2"><span class="channel-dot" style="background:#ffc107"></span> Unpaid Trend</div>
                                        <?php if ($unpaid_trend_values): ?>
                                            <div class="d-flex align-items-baseline gap-2">
                                                <span class="fs-3 fw-bold">Rp<?= number_format($unpaid_trend_latest, 0, ',', '.') ?></span>
                                            </div>
                                            <small class="text-secondary">vs previous day</small>
                                        <?php else: ?>
                                            <div class="text-secondary small">No unpaid data yet.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- KUNCI PERBAIKAN: Bungkus canvas dengan div yang memiliki tinggi statis -->
                                <div style="position: relative; height: 250px; width: 100%; flex-grow: 1;">
                                    <!-- Tag canvas harus BERSIH dari atribut height, width, dan class pembentuk ukuran -->
                                    <canvas id="revenueTrendChart"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center">
                                <div class="dash-section-title mb-3 text-start">Outstanding vs Overdue</div>
                                <div class="satisfaction-donut mx-auto my-5">
                                    <canvas id="ooChart"></canvas>
                                </div>
                                <div class="d-flex justify-content-center flex-wrap gap-3 align-items-end">
                                    <?php foreach ($oo_breakdown as $s): ?>
                                        <small class="text-secondary">
                                            <span class="channel-dot" style="background:<?= $s['color'] ?>"></span>
                                            <?= $s['label'] ?> Rp<?= number_format($s['value'], 0, ',', '.') ?>
                                        </small>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body p-0 d-flex flex-column">
                                <div class="dash-section-title p-3 pb-0">Best Selling Product (All Time)</div>
                                <div class="table-responsive flex-grow-1">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Sold</th>
                                                <th class="text-end">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($top_item as $top_product): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="product-rank"><?= $number++ ?></span>
                                                            <div>
                                                                <div class="small fw-semibold">
                                                                    <?= $top_product['item_name'] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold"><?= $top_product['total_unit_sold'] ?> sold</td>
                                                    <td class="fw-semibold text-end">
                                                        Rp<?= number_format($top_product['total_revenue'], 0, ',', '.') ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/adminlte.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/bootstrap.bundle.js' ?>"></script>
    <script src="<?= BASEURL . 'public/js/dashboard.js' ?>"></script>
    <script>
        window.dashboardData = {
            trendLabels: <?= json_encode($trend_labels) ?>,
            trendValues: <?= json_encode($trend_values) ?>,
            unpaidTrendValues: <?= json_encode($unpaid_trend_values) ?>,
            ooData: <?= json_encode(array_column($oo_breakdown, 'value')) ?>,
            ooColors: <?= json_encode(array_column($oo_breakdown, 'color')) ?>
        };
    </script>
    <script src="<?= BASEURL . 'public/js/dashboard.js' ?>"></script>
</body>

</html>