<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css" />
    @vite([
            'resources/js/app.js',
            'resources/css/app.css',
        ])
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1 class="mb-0">Login</h1>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="/" method="POST">
                    @csrf

                    @if (session('failed'))
                        <div class="mb-3 p-2 bg-red-900/30 border border-red-800 rounded-lg text-center">
                            <p class="text-red-400 text-sm font-medium">{{ session('failed') }}</p>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input id="loginEmail" type="email" class="form-control" placeholder="" name="email" required />
                            <label for="loginEmail">Email</label>
                            @error('email')
                                <small class="text-red-500 text-xs mt-1 block" role="alert">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input id="loginPassword" type="password" class="form-control" placeholder="" name="password" required />
                            <label for="loginPassword">Password</label>
                            @error('password')
                                <small class="text-red-500 text-xs mt-1 block" role="alert">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
