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
                        <h2>Promociones Destacadas</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/publicidad/crear-promocion') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Promoción
                            </a>
                            <a href="<?= base_url('public/superadmin/publicidad') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Tabla de promociones -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Título</th>
                                            <th>Descuento</th>
                                            <th>Posición</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($promociones)): ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No hay promociones registradas</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($promociones as $promocion): ?>
                                                <tr>
                                                    <td><strong><?= esc($promocion['empresa_nombre']) ?></strong></td>
                                                    <td><?= esc($promocion['titulo']) ?></td>
                                                    <td>
                                                        <?php if ($promocion['descuento']): ?>
                                                            <span class="badge bg-success"><?= $promocion['descuento'] ?>%</span>
                                                        <?php else: ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($promocion['posicion']) {
                                                            'hero' => 'bg-primary',
                                                            'sidebar' => 'bg-info',
                                                            'footer' => 'bg-secondary',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($promocion['posicion']) ?></span>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($promocion['fecha_inicio'])) ?></td>
                                                    <td><?= date('d/m/Y', strtotime($promocion['fecha_fin'])) ?></td>
                                                    <td>
                                                        <span class="badge <?= $promocion['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                                                            <?= $promocion['activo'] ? 'Activa' : 'Inactiva' ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <button class="btn btn-outline-primary" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-outline-<?= $promocion['activo'] ? 'warning' : 'success' ?>" title="<?= $promocion['activo'] ? 'Desactivar' : 'Activar' ?>">
                                                                <i class="fas fa-<?= $promocion['activo'] ? 'pause' : 'play' ?>"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>