<!doctype html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="<?= BASEURL . 'public/css/login.css' ?>">
</head>

<body class="login-page bg-body-tertiary">
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="row g-0">
                <div class="col-md-5 auth-brand">
                    <div class="auth-brand-icon">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <h1 class="h3 mb-2">Invoice Manager</h1>
                    <p class="mb-0">Manage your invoices, payments, and company data in one place.</p>
                </div>

                <div class="col-md-7 auth-form-side">
                    <h2 class="h4 mb-1">Login</h2>
                    <p class="text-body-secondary mb-4">Sign in to start your session</p>

                    <form action="<?= BASEURL . 'login/store' ?>" method="post">
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input id="loginEmail" type="email" class="form-control" placeholder="" name="email" required />
                                <label for="loginEmail">Email</label>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-envelope"></span>
                            </div>
                        </div>
                        <div class="input-group mb-5">
                            <div class="form-floating">
                                <input id="loginPassword" type="password" class="form-control" placeholder="" name="password" required />
                                <label for="loginPassword">Password</label>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-lock-fill"></span>
                            </div>
                        </div>
                        <!-- <div class="form-check">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                        </div> -->
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-login">Login</button>
                        </div>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        <a href="<?= BASEURL . 'register' ?>" class="text-decoration-none">
                            Register a new account
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASEURL . 'public/js/lte-theme.js' ?>"></script>
</body>

</html>