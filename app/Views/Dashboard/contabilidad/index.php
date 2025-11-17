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
                        <h2>Contabilidad</h2>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-invoice fa-2x text-primary mb-2"></i>
                                    <h4><?= $totalFacturas ?></h4>
                                    <p class="text-muted">Total Facturas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <h4><?= $totalPagos ?></h4>
                                    <p class="text-muted">Pagos Completados</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                    <h4><?= $pagosPendientes ?></h4>
                                    <p class="text-muted">Pagos Pendientes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                                    <h4><?= $facturasMorosas ?></h4>
                                    <p class="text-muted">Facturas Morosas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Cards -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-invoice fa-3x text-primary mb-3"></i>
                                    <h5>Facturación</h5>
                                    <p class="text-muted">Gestionar facturas generadas por suscripciones</p>
                                    <a href="<?= base_url('public/superadmin/contabilidad/facturas') ?>" class="btn btn-primary">Ver Facturas</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-credit-card fa-3x text-success mb-3"></i>
                                    <h5>Pagos</h5>
                                    <p class="text-muted">Registro de pagos recibidos y métodos</p>
                                    <a href="<?= base_url('public/superadmin/contabilidad/pagos') ?>" class="btn btn-success">Ver Pagos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-exclamation-circle fa-3x text-danger mb-3"></i>
                                    <h5>Morosos</h5>
                                    <p class="text-muted">Empresas con facturas vencidas</p>
                                    <a href="<?= base_url('public/superadmin/contabilidad/morosos') ?>" class="btn btn-danger">Ver Morosos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-tags fa-3x text-info mb-3"></i>
                                    <h5>Planes</h5>
                                    <p class="text-muted">Configuración de planes y precios</p>
                                    <a href="<?= base_url('public/superadmin/contabilidad/planes') ?>" class="btn btn-info">Ver Planes</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-download fa-3x text-secondary mb-3"></i>
                                    <h5>Reportes</h5>
                                    <p class="text-muted">Exportaciones para contable/asesor</p>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Descargar
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="<?= base_url('public/superadmin/contabilidad/exportar?tipo=facturas&formato=csv') ?>">Facturas CSV</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url('public/superadmin/contabilidad/exportar?tipo=pagos&formato=csv') ?>">Pagos CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>