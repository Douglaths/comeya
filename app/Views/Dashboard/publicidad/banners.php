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
                        <h2>Banners Publicitarios</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/publicidad/crear-banner') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nuevo Banner
                            </a>
                            <a href="<?= base_url('public/superadmin/publicidad') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Banners en cards -->
                    <div class="row">
                        <?php if (empty($banners)): ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center py-5">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No hay banners configurados</h5>
                                        <p class="text-muted">Crea el primer banner publicitario</p>
                                        <a href="<?= base_url('public/superadmin/publicidad/crear-banner') ?>" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Crear Banner
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($banners as $banner): ?>
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><?= esc($banner['titulo']) ?></h6>
                                            <div>
                                                <?php
                                                $badgeClass = match($banner['posicion']) {
                                                    'header' => 'bg-primary',
                                                    'sidebar' => 'bg-info',
                                                    'footer' => 'bg-secondary',
                                                    'popup' => 'bg-warning',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $badgeClass ?>"><?= ucfirst($banner['posicion']) ?></span>
                                                <span class="badge <?= $banner['activo'] ? 'bg-success' : 'bg-secondary' ?> ms-1">
                                                    <?= $banner['activo'] ? 'Activo' : 'Inactivo' ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <img src="<?= esc($banner['imagen_url']) ?>" alt="Banner" class="img-fluid rounded" style="max-height: 150px;">
                                            </div>
                                            
                                            <div class="row text-center">
                                                <div class="col-6">
                                                    <small class="text-muted">Clicks</small>
                                                    <div><strong><?= $banner['clicks'] ?></strong></div>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Fecha Inicio</small>
                                                    <div><strong><?= date('d/m/Y', strtotime($banner['fecha_inicio'])) ?></strong></div>
                                                </div>
                                            </div>

                                            <?php if ($banner['fecha_fin']): ?>
                                                <div class="text-center mt-2">
                                                    <small class="text-muted">Expira: <?= date('d/m/Y', strtotime($banner['fecha_fin'])) ?></small>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($banner['enlace']): ?>
                                                <div class="mt-2">
                                                    <small class="text-muted">Enlace:</small>
                                                    <div class="text-truncate">
                                                        <a href="<?= esc($banner['enlace']) ?>" target="_blank" class="text-primary">
                                                            <?= esc($banner['enlace']) ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group w-100">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-outline-<?= $banner['activo'] ? 'warning' : 'success' ?> btn-sm">
                                                    <i class="fas fa-<?= $banner['activo'] ? 'pause' : 'play' ?>"></i>
                                                    <?= $banner['activo'] ? 'Pausar' : 'Activar' ?>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>