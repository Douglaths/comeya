<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recuperar Contraseña - comeya</title>
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/logos/ico.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/libs.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/logik.css?v=1.0.0') ?>">
</head>
    
<body class=" ">
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>

    <div class="wrapper">
        <div class="robot">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-lg-5 col-md-8">
                        <div class="card" style="transform: translate(0px, 25px);">
                            <div class="card-header">
                                <img src="<?= base_url('public/assets/images/logos/logo-dark.png') ?>" alt="Logo" class="img-fluid mx-auto d-block" style="height: 120px;">
                                <h5 class="text-center mt-3">Recuperar Contraseña</h5>
                                <p class="text-center text-muted">Ingresa tu email para recibir el enlace de recuperación</p>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                <?php endif; ?>
                                
                                <form action="<?= base_url('password/send-reset') ?>" method="POST">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    
                                    <button type="submit" class="btn text-white w-100 mb-3" style="background-color: #ff6b35;">Enviar Enlace</button>
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary w-100">Volver al Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('public/assets/js/libs.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/app.js') ?>"></script>
</body>

</html>