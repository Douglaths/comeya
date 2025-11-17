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
                        <h2>Publicidad</h2>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-percentage fa-2x text-primary mb-2"></i>
                                    <h4><?= $promocionesActivas ?></h4>
                                    <p class="text-muted">Promociones Activas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-image fa-2x text-success mb-2"></i>
                                    <h4><?= $bannersActivos ?></h4>
                                    <p class="text-muted">Banners Activos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-download fa-2x text-warning mb-2"></i>
                                    <h4><?= $materialesDisponibles ?></h4>
                                    <p class="text-muted">Material Promocional</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-star fa-2x text-info mb-2"></i>
                                    <h4><?= $empresasDestacadas ?></h4>
                                    <p class="text-muted">Empresas Destacadas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Cards -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-percentage fa-3x text-primary mb-3"></i>
                                    <h5>Promociones</h5>
                                    <p class="text-muted">Promos destacadas de restaurantes en landing</p>
                                    <a href="<?= base_url('public/superadmin/publicidad/promociones') ?>" class="btn btn-primary">Ver Promociones</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-image fa-3x text-success mb-3"></i>
                                    <h5>Banners</h5>
                                    <p class="text-muted">Banners publicitarios dentro de la app</p>
                                    <a href="<?= base_url('public/superadmin/publicidad/banners') ?>" class="btn btn-success">Ver Banners</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-download fa-3x text-warning mb-3"></i>
                                    <h5>Material Promocional</h5>
                                    <p class="text-muted">Plantillas descargables para restaurantes</p>
                                    <a href="<?= base_url('public/superadmin/publicidad/material') ?>" class="btn btn-warning">Ver Material</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-star fa-3x text-info mb-3"></i>
                                    <h5>Restaurantes Destacados</h5>
                                    <p class="text-muted">Visibilidad extra en la landing page</p>
                                    <a href="<?= base_url('public/superadmin/publicidad/destacados') ?>" class="btn btn-info">Ver Destacados</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>