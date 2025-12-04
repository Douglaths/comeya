<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registro - comeya</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/logos/ico.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/libs.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/logik.css?v=1.0.0') ?>">
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
                    <div class="col-lg-6 col-md-8">
                        <div class="card" style="transform: translate(0px, 25px);">
                            <div class="card-header">
                                <img src="<?= base_url('assets/images/logos/logo-dark.png') ?>" alt="Logo" class="img-fluid mx-auto d-block" style="height: 120px;">
                                <h5 class="text-center mt-3">Solicitar Registro</h5>
                                <p class="text-center text-muted">Completa el formulario y nos pondremos en contacto contigo</p>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                <?php endif; ?>
                                
                                <form action="<?= base_url('registro/solicitar') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="nombre_empresa">Nombre del Restaurante *</label>
                                                <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="nombre_contacto">Nombre del Contacto *</label>
                                                <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="email">Email *</label>
                                                <input type="email" class="form-control" name="email" id="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" name="telefono" id="telefono">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" class="form-control" name="direccion" id="direccion">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="mensaje">Mensaje (opcional)</label>
                                                <textarea class="form-control" name="mensaje" id="mensaje" rows="3" placeholder="Cuéntanos sobre tu restaurante..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn text-white w-100 mb-3" style="background-color: #ff6b35;">Enviar Solicitud</button>
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary w-100">Volver al Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/libs.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>

</html>