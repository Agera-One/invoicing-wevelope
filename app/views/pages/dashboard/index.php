<?php
$mini_stats = [
    ['label' => 'Invoice Value', 'value' => 'Rp' . number_format($invoice_value, 0, ',', '.'), 'text' => 'text-white' ,'icon' => 'bi-receipt-cutoff text-custom'],
    ['label' => 'Total Revenue', 'value' => 'Rp' . number_format($total_revenue, 0, ',', '.'), 'text' => 'text-white' ,'icon' => 'bi-cash-coin text-custom-success'],
    ['label' => 'Total Outstanding', 'value' => 'Rp' . number_format($total_unpaid, 0, ',', '.'), 'text' => 'text-white' ,'icon' => 'bi-hourglass-split text-custom-warning'],
    ['label' => 'Total Overdue', 'value' => 'Rp' . number_format($total_overdue, 0, ',', '.'), 'text' => 'text-danger' ,'icon' => 'bi-exclamation-triangle text-custom-danger'],
];

$trend_values = $trend_values ?? [];
$trend_labels = $trend_labels ?? [];
$trend_latest = $trend_values ? end($trend_values) : 0;
$trend_prev = count($trend_values) > 1 ? $trend_values[count($trend_values) - 2] : 0;

$unpaid_trend_values = $unpaid_trend_values ?? [];
$unpaid_trend_latest = $unpaid_trend_values ? end($unpaid_trend_values) : 0;
$unpaid_trend_prev = count($unpaid_trend_values) > 1 ? $unpaid_trend_values[count($unpaid_trend_values) - 2] : 0;

$oo_outstanding = $total_unpaid;
$oo_overdue = $total_overdue;
$oo_breakdown = [
    ['label' => 'Outstanding', 'value' => $oo_outstanding, 'color' => '#dbd847'],
    ['label' => 'Overdue', 'value' => $oo_overdue, 'color' => '#dc3545'],
];
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
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="fw-bold h4 m-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
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
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-3">
                                    <div>
                                        <div class="dash-section-title mb-2"><span class="channel-dot" style="background:#5abd85"></span> Revenue Trend</div>
                                        <?php if ($trend_values): ?>
                                            <div class="d-flex align-items-baseline gap-2">
                                                <span
                                                    class="fs-3 fw-bold">Rp<?= number_format($trend_latest, 0, ',', '.') ?></span>
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
                                                <span
                                                    class="fs-3 fw-bold">Rp<?= number_format($unpaid_trend_latest, 0, ',', '.') ?></span>
                                            </div>
                                            <small class="text-secondary">vs previous day</small>
                                        <?php else: ?>
                                            <div class="text-secondary small">No unpaid data yet.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <canvas id="revenueTrendChart" height="90"></canvas>
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
    <script>
        const trendLabels = <?= json_encode($trend_labels) ?>;
        const trendValues = <?= json_encode($trend_values) ?>;
        const unpaidTrendValues = <?= json_encode($unpaid_trend_values) ?>;
        const trendCtx = document.getElementById('revenueTrendChart');
        const revenueGradient = trendCtx.getContext('2d').createLinearGradient(0, 0, 0, 220);
        revenueGradient.addColorStop(0, 'rgba(45, 212, 64, 0.48)');
        revenueGradient.addColorStop(1, 'rgba(45, 212, 120, 0.16)');
        const unpaidGradient = trendCtx.getContext('2d').createLinearGradient(0, 0, 0, 220);
        unpaidGradient.addColorStop(0, 'rgba(255, 193, 7, 0.35)');
        unpaidGradient.addColorStop(1, 'rgba(255, 193, 7, 0.05)');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Revenue',
                        data: trendValues,
                        borderColor: '#00ff00',
                        backgroundColor: revenueGradient,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        borderWidth: 2
                    },
                    {
                        label: 'Unpaid',
                        data: unpaidTrendValues,
                        borderColor: '#ffff00',
                        backgroundColor: unpaidGradient,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        borderWidth: 2
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {display: true, position: 'top', align: 'end', labels: {boxWidth: 10, boxHeight: 10}},
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.dataset.label + ': Rp' + ctx.parsed.y.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {grid: {display: false}},
                    y: {grid: {color: 'rgba(255,255,255,0.06)'}, ticks: {callback: v => 'Rp' + (v / 1000000).toLocaleString('id-ID') + 'M'}}
                }
            }
        });

        const ooData = <?= json_encode(array_column($oo_breakdown, 'value')) ?>;
        const ooColors = <?= json_encode(array_column($oo_breakdown, 'color')) ?>;
        new Chart(document.getElementById('ooChart'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: ooData,
                    backgroundColor: ooColors,
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '65%',
                plugins: {legend: {display: false}}
            }
        });
    </script>
</body>

</html>