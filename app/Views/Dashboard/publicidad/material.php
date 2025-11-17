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
                        <h2>Material Promocional</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/publicidad/crear-material') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nuevo Material
                            </a>
                            <a href="<?= base_url('public/superadmin/publicidad') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Material en cards -->
                    <div class="row">
                        <?php if (empty($materiales)): ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center py-5">
                                        <i class="fas fa-download fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No hay material promocional</h5>
                                        <p class="text-muted">Sube el primer material para los restaurantes</p>
                                        <a href="<?= base_url('public/superadmin/publicidad/crear-material') ?>" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Crear Material
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($materiales as $material): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><?= esc($material['nombre']) ?></h6>
                                            <span class="badge bg-primary"><?= ucfirst($material['tipo']) ?></span>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center mb-3">
                                                <?php
                                                $iconClass = match($material['tipo']) {
                                                    'flyer' => 'fas fa-file-image text-primary',
                                                    'qr' => 'fas fa-qrcode text-success',
                                                    'banner' => 'fas fa-image text-warning',
                                                    'plantilla' => 'fas fa-file-alt text-info',
                                                    'logo' => 'fas fa-copyright text-danger',
                                                    default => 'fas fa-file'
                                                };
                                                ?>
                                                <i class="<?= $iconClass ?> fa-3x mb-2"></i>
                                            </div>
                                            
                                            <p class="text-muted small"><?= esc($material['descripcion']) ?></p>
                                            
                                            <div class="mb-2">
                                                <small class="text-muted">Categoría:</small>
                                                <span class="badge bg-secondary"><?= ucfirst($material['categoria']) ?></span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <small class="text-muted">Descargas:</small>
                                                <span class="badge bg-info"><?= $material['descargas'] ?? 0 ?></span>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group w-100">
                                                <a href="<?= esc($material['archivo_url']) ?>" target="_blank" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i> Descargar
                                                </a>
                                                <button class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
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

                    <!-- Estadísticas de descargas -->
                    <?php if (!empty($materiales)): ?>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Estadísticas de Descargas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-primary"><?= count($materiales) ?></h4>
                                        <p class="text-muted">Total Materiales</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-success"><?= array_sum(array_column($materiales, 'descargas')) ?></h4>
                                        <p class="text-muted">Total Descargas</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <?php
                                        $tiposMas = array_count_values(array_column($materiales, 'tipo'));
                                        $tipoPopular = array_key_first($tiposMas);
                                        ?>
                                        <h4 class="text-warning"><?= ucfirst($tipoPopular) ?></h4>
                                        <p class="text-muted">Tipo Más Popular</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-info"><?= date('M Y') ?></h4>
                                        <p class="text-muted">Último Mes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>