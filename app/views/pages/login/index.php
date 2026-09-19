<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css" />

    <link rel="stylesheet"
        href="<?= BASEURL . 'public/css/login.css' ?>">
</head>

<body class="login-page bg-body-tertiary">

    <div class="auth-wrapper">
        <div class="card auth-card">

            <div class="row g-0">

                <!-- Brand Side -->
                <div class="col-md-5 auth-brand">

                    <div class="auth-brand-icon">
                        <i class="bi bi-receipt"></i>
                    </div>

                    <h1 class="h3 mb-2">Invoice Manager</h1>

                    <p class="mb-0">
                        Manage your invoices, payments, and company data in one place.
                    </p>

                </div>

                <!-- Login Side -->
                <div class="col-md-7 auth-form-side">

                    <h2 class="h4 mb-1">Login</h2>

                    <p class="text-body-secondary mb-4">
                        Sign in to start your session
                    </p>

                    <form action="<?= BASEURL . 'login/store' ?>" method="post">

                        <!-- Email -->
                        <div class="input-group mb-3">

                            <div class="form-floating">
                                <input
                                    id="loginEmail"
                                    type="email"
                                    class="form-control"
                                    placeholder=""
                                    name="email"
                                    required
                                />

                                <label for="loginEmail">Email</label>
                            </div>

                            <div class="input-group-text">
                                <span class="bi bi-envelope"></span>
                            </div>

                        </div>

                        <!-- Password -->
                        <div class="input-group mb-4">

                            <div class="form-floating">
                                <input
                                    id="loginPassword"
                                    type="password"
                                    class="form-control"
                                    placeholder=""
                                    name="password"
                                    required
                                />

                                <label for="loginPassword">Password</label>
                            </div>

                            <div class="input-group-text">
                                <span class="bi bi-lock-fill"></span>
                            </div>

                        </div>

                        <!-- Login Button -->
                        <div class="d-grid mb-3">
                            <button
                                type="submit"
                                name="login"
                                class="btn btn-login">
                                Login
                            </button>
                        </div>

                    </form>

                    <!-- Demo Account -->
                    <div class="demo-account">

                        <div class="demo-account-header">
                            <div class="demo-account-icon">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>

                            <div>
                                <div class="demo-account-title">
                                    Demo Admin Account
                                </div>

                                <div class="demo-account-subtitle">
                                    Use this account to access the dashboard
                                </div>
                            </div>
                        </div>

                        <div class="demo-account-info">

                            <button
                                type="button"
                                class="demo-account-item"
                                onclick="fillLogin('admin@gmail.com', 'admin123')">

                                <span class="demo-account-label">
                                    <i class="bi bi-envelope"></i>
                                    Email
                                </span>

                                <span class="demo-account-value">
                                    admin@gmail.com
                                </span>

                            </button>

                            <button
                                type="button"
                                class="demo-account-item"
                                onclick="fillLogin('admin@gmail.com', 'admin123')">

                                <span class="demo-account-label">
                                    <i class="bi bi-key-fill"></i>
                                    Password
                                </span>

                                <span class="demo-account-value">
                                    admin123
                                </span>

                            </button>

                        </div>

                        <div class="demo-account-hint">
                            <i class="bi bi-info-circle"></i>
                            Click the account details to fill the login form automatically.
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        function fillLogin(email, password) {
            document.getElementById('loginEmail').value = email;
            document.getElementById('loginPassword').value = password;

            document.getElementById('loginEmail').focus();
        }
    </script>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>

</body>

</html>
