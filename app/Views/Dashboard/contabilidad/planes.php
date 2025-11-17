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
                        <h2>Planes y Precios</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/contabilidad/crear-plan') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nuevo Plan
                            </a>
                            <a href="<?= base_url('public/superadmin/contabilidad') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Planes en cards -->
                    <div class="row">
                        <?php if (empty($planes)): ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center py-5">
                                        <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No hay planes configurados</h5>
                                        <p class="text-muted">Crea el primer plan para comenzar</p>
                                        <a href="<?= base_url('public/superadmin/contabilidad/crear-plan') ?>" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Crear Plan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($planes as $plan): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 <?= $plan['activo'] ? '' : 'border-secondary' ?>">
                                        <div class="card-header text-center <?= $plan['activo'] ? 'bg-primary text-white' : 'bg-secondary text-white' ?>">
                                            <h5 class="mb-0"><?= esc($plan['nombre']) ?></h5>
                                            <?php if (!$plan['activo']): ?>
                                                <small><i class="fas fa-pause"></i> Inactivo</small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <h2 class="text-primary">€<?= number_format($plan['precio'], 2) ?></h2>
                                                <small class="text-muted">por mes</small>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <span>Productos:</span>
                                                    <strong><?= $plan['limite_productos'] == -1 ? 'Ilimitados' : $plan['limite_productos'] ?></strong>
                                                </div>
                                            </div>

                                            <?php if ($plan['caracteristicas']): ?>
                                                <div class="mb-3">
                                                    <h6>Características:</h6>
                                                    <div class="text-start">
                                                        <?php
                                                        $caracteristicas = explode("\n", $plan['caracteristicas']);
                                                        foreach ($caracteristicas as $caracteristica):
                                                            if (trim($caracteristica)):
                                                        ?>
                                                            <div class="mb-1">
                                                                <i class="fas fa-check text-success"></i>
                                                                <small><?= esc(trim($caracteristica)) ?></small>
                                                            </div>
                                                        <?php 
                                                            endif;
                                                        endforeach; 
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group w-100">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-outline-<?= $plan['activo'] ? 'warning' : 'success' ?> btn-sm">
                                                    <i class="fas fa-<?= $plan['activo'] ? 'pause' : 'play' ?>"></i>
                                                    <?= $plan['activo'] ? 'Desactivar' : 'Activar' ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Estadísticas de uso de planes -->
                    <?php if (!empty($planes)): ?>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Estadísticas de Suscripciones</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Plan</th>
                                            <th>Precio</th>
                                            <th>Empresas Suscritas</th>
                                            <th>Ingresos Mensuales</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($planes as $plan): ?>
                                            <tr>
                                                <td><strong><?= esc($plan['nombre']) ?></strong></td>
                                                <td>€<?= number_format($plan['precio'], 2) ?></td>
                                                <td>
                                                    <span class="badge bg-info">0</span>
                                                    <small class="text-muted">empresas</small>
                                                </td>
                                                <td>
                                                    <strong>€0.00</strong>
                                                </td>
                                                <td>
                                                    <span class="badge <?= $plan['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                                                        <?= $plan['activo'] ? 'Activo' : 'Inactivo' ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>