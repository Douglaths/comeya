<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - comeya</title>
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/logos/ico.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/libs.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/logik.css?v=1.0.0') ?>">
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <div class="robot">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-lg-5 col-md-8">
                        <div class="card" style="transform: translate(0px, 25px);">
                            <div class="card-header">
                                <img src="<?= base_url('public/assets/images/logos/logo-dark.png') ?>" alt="Logo" class="img-fluid mx-auto d-block" style="height: 160px;">
                            </div>
                            <div class="card-body">
                                <h5 class="text-start mb-3">Iniciar Sesion</h5>
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                <?php endif; ?>
                                <form action="<?= base_url('login/authenticate') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-between mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">Recordar contraseña</label>
                                            </div>
                                            <a href="#" class="text-dark">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn text-white w-100" style="background-color: #ff6b35;">Iniciar Sesión</button>
                                    
                                </form>
                                
                                <div class="text-center mt-3">
                                    <p class="text-muted">¿No tienes cuenta?</p>
                                    <a href="<?= base_url('registro') ?>" class="btn btn-outline-secondary w-100">Solicitar Registro</a>
                                </div>
                            </div>
                        </div>
                        <div class="auth-img">
                            <img src="<?= base_url('public/assets/images/auth/01.png') ?>" alt="page" class="signin-outer-img w-25">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="<?= base_url('public/assets/js/libs.min.js') ?>"></script>

    <!-- Dashboard Charts JavaScript -->
    <script src="<?= base_url('public/assets/js/charts/dashboard.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/charts/apexcharts.js') ?>"></script>
    <!-- fslightbox JavaScript -->
    <script src="<?= base_url('public/assets/js/fslightbox.js') ?>"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('public/assets/js/app.js') ?>"></script>


</body>

</html>