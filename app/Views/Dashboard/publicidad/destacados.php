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
                        <h2>Restaurantes Destacados</h2>
                        <a href="<?= base_url('public/superadmin/publicidad') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <!-- Empresas destacadas -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Empresas Destacadas (<?= count($empresasDestacadas) ?>)</h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($empresasDestacadas)): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-star fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">No hay empresas destacadas</p>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ($empresasDestacadas as $empresa): ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="card border-warning">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h6 class="card-title">
                                                                <i class="fas fa-star text-warning"></i>
                                                                <?= esc($empresa['nombre']) ?>
                                                            </h6>
                                                            <p class="card-text text-muted small">
                                                                <?= esc($empresa['email']) ?><br>
                                                                <?= esc($empresa['ciudad']) ?>
                                                            </p>
                                                        </div>
                                                        <form method="POST" action="<?= base_url('public/superadmin/publicidad/toggle-destacado/' . $empresa['id']) ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Quitar destacado">
                                                                <i class="fas fa-star-half-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Empresas disponibles -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Empresas Disponibles (<?= count($empresasDisponibles) ?>)</h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($empresasDisponibles)): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-building fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Todas las empresas activas ya están destacadas</p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Email</th>
                                                <th>Ciudad</th>
                                                <th>Plan</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($empresasDisponibles as $empresa): ?>
                                                <tr>
                                                    <td><strong><?= esc($empresa['nombre']) ?></strong></td>
                                                    <td><?= esc($empresa['email']) ?></td>
                                                    <td><?= esc($empresa['ciudad']) ?></td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($empresa['plan']) {
                                                            'free' => 'bg-secondary',
                                                            'basic' => 'bg-primary',
                                                            'pro' => 'bg-success',
                                                            default => 'bg-info'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($empresa['plan']) ?></span>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="<?= base_url('public/superadmin/publicidad/toggle-destacado/' . $empresa['id']) ?>" class="d-inline">
                                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Destacar empresa">
                                                                <i class="fas fa-star"></i> Destacar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>