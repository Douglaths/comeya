<?= $this->include('Dashboard/templates/header') ?>
<body class="">
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>

    <?= $this->include('Dashboard/templates/navbar') ?>

    <div class="content-page">
        <main class="main-content">
            <div class="conatiner-fluid content-inner mt-5 py-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                        <h2>Marketing</h2>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-bullhorn fa-2x text-primary mb-2"></i>
                                    <h4><?= $totalCampanas ?></h4>
                                    <p class="text-muted">Total Campañas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-play-circle fa-2x text-success mb-2"></i>
                                    <h4><?= $campanasActivas ?></h4>
                                    <p class="text-muted">Campañas Activas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-gift fa-2x text-warning mb-2"></i>
                                    <h4><?= $codigosActivos ?></h4>
                                    <p class="text-muted">Códigos Referidos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-envelope fa-2x text-info mb-2"></i>
                                    <h4><?= $emailsEnviados ?></h4>
                                    <p class="text-muted">Emails Enviados</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Cards -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-bullhorn fa-3x text-primary mb-3"></i>
                                    <h5>Campañas</h5>
                                    <p class="text-muted">Gestionar campañas de Google Ads, Meta, etc.</p>
                                    <a href="<?= base_url('public/superadmin/marketing/campanas') ?>" class="btn btn-primary">Ver Campañas</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                                    <h5>Códigos Referidos</h5>
                                    <p class="text-muted">Generar y gestionar códigos para partners</p>
                                    <a href="<?= base_url('public/superadmin/marketing/referidos') ?>" class="btn btn-success">Ver Códigos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-envelope-bulk fa-3x text-info mb-3"></i>
                                    <h5>Email Marketing</h5>
                                    <p class="text-muted">Campañas de email y notificaciones masivas</p>
                                    <a href="<?= base_url('public/superadmin/marketing/emails') ?>" class="btn btn-info">Ver Emails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>