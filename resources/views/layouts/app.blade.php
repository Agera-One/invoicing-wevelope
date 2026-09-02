<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.9.1/dist/css/adminlte.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.4.0/dist/css/tabulator_bootstrap5.min.css" crossorigin="anonymous" />

        <title>@yield('title')</title>

        @vite([
            'resources/js/app.js',
            'resources/js/company.js',
            'resources/js/customer.js',
            'resources/js/detail.js',
            'resources/js/invoice.js',
            'resources/js/item.js',
            'resources/js/payment.js',
            'resources/js/sidebar.js',
            'resources/js/user.js',
            'resources/css/dashboard.css',
            'resources/css/company.css',
            'resources/css/error.css',
            'resources/css/generate-pdf.css',
            'resources/css/navbar.css',
            'resources/css/report.css',
            'resources/css/sidebar.css',
        ])
    </head>

    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
        <div class="app-wrapper">
            <nav class="app-header navbar navbar-expand custom-navbar">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-lte-toggle="sidebar"
                                href="#"
                                role="button"
                            >
                                <i class="bi bi-list"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown user-menu">
                            <a
                                href="#"
                                class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown"
                            >
                                <img
                                    src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&s=160"
                                    class="user-image rounded-circle shadow"
                                    alt="User"
                                >

                                <span class="d-none d-md-inline">
                                    {{-- <?= $current_user['name'] ?> --}}
                                    Administrator
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                                <li class="user-header">
                                    <img
                                        src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&s=160"
                                        alt="User"
                                    >

                                    <p>
                                        {{-- <?= $current_user['name'] ?> --}}
                                        Administrator
                                        <small>Admin</small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <a
                                        href="/logout"
                                        class="btn btn-outline-danger w-100"
                                    >
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <aside class="app-sidebar shadow-sm">
                <div class="sidebar-brand text-uppercase">
                    {{-- <span class="brand-text"><?= $current_company_name ?></span> --}}
                    <span class="brand-text">Red Hat, Inc</span>
                </div>

                <div class="sidebar-wrapper">
                    <nav class="mt-2">
                        <ul
                            class="nav sidebar-menu flex-column"
                            data-lte-toggle="treeview"
                            role="navigation"
                            data-accordion="false"
                        >
                            <li class="nav-item">
                                <a
                                    href="/dashboard"
                                    class="nav-link"
                                >
                                    <i class="nav-icon bi bi-grid-1x2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <li class="nav-item" data-menu="master">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-database"></i>
                                    <p>
                                        Master Data
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="/item"
                                            class="nav-link"
                                            data-page="item"
                                        >
                                            <i class="bi bi-box-seam nav-icon"></i>
                                            <p>Items</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/customer"
                                            class="nav-link"
                                            data-page="customer"
                                        >
                                            <i class="bi bi-people nav-icon"></i>
                                            <p>Customers</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/pic"
                                            class="nav-link"
                                            data-page="pic"
                                        >
                                            <i class="bi bi-person-check nav-icon"></i>
                                            <p>Company PIC</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item" data-menu="sales">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-cart-check"></i>
                                    <p>
                                        Sales
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="/invoice"
                                            class="nav-link"
                                            data-page="invoice"
                                        >
                                            <i class="bi bi-receipt-cutoff nav-icon"></i>
                                            <p>Invoices</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/payment"
                                            class="nav-link"
                                            data-page="payment"
                                        >
                                            <i class="bi bi-credit-card nav-icon"></i>
                                            <p>Payments</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/outstanding"
                                            class="nav-link"
                                            data-page="outstanding"
                                        >
                                            <i class="bi bi-hourglass-split nav-icon text-warning"></i>
                                            <p>Outstanding</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/overdue"
                                            class="nav-link"
                                            data-page="overdue"
                                        >
                                            <i class="bi bi-exclamation-triangle nav-icon text-warning"></i>
                                            <p>Overdue</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item" data-menu="reports">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-bar-chart"></i>
                                    <p>
                                        Reports
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="/revenue"
                                            class="nav-link"
                                            data-page="revenue"
                                        >
                                            <i class="bi bi-graph-up-arrow nav-icon"></i>
                                            <p>Revenue</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/best-seller"
                                            class="nav-link"
                                            data-page="best-seller"
                                        >
                                            <i class="bi bi-trophy nav-icon"></i>
                                            <p>Best Seller</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item" data-menu="admin">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon bi bi-gear"></i>
                                    <p>
                                        Administration
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a
                                            href="/company"
                                            class="nav-link"
                                            data-page="company"
                                        >
                                            <i class="bi bi-building-gear nav-icon"></i>
                                            <p>Company Setting</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a
                                            href="/user"
                                            class="nav-link"
                                            data-page="user"
                                        >
                                            <i class="bi bi-person-gear nav-icon"></i>
                                            <p>User Management</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <main class="app-main py-4">
                @yield('content')
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.9.1/dist/js/adminlte.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tooltipList = [...document.querySelectorAll('[data-bs-toggle="tooltip"]')]
                    .map(el => new bootstrap.Tooltip(el));
            });
    </script>
    </body>
</html>
