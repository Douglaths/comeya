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
                        <h2>Campañas de Marketing</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/marketing/crear-campana') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Campaña
                            </a>
                            <a href="<?= base_url('public/superadmin/marketing') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Tipo de Campaña</label>
                                    <select class="form-select" name="tipo">
                                        <option value="">Todos los tipos</option>
                                        <option value="google_ads" <?= $filtros['tipo'] == 'google_ads' ? 'selected' : '' ?>>Google Ads</option>
                                        <option value="meta_ads" <?= $filtros['tipo'] == 'meta_ads' ? 'selected' : '' ?>>Meta Ads</option>
                                        <option value="email" <?= $filtros['tipo'] == 'email' ? 'selected' : '' ?>>Email Marketing</option>
                                        <option value="seo" <?= $filtros['tipo'] == 'seo' ? 'selected' : '' ?>>SEO</option>
                                        <option value="contenido" <?= $filtros['tipo'] == 'contenido' ? 'selected' : '' ?>>Marketing de Contenido</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="estado">
                                        <option value="">Todos</option>
                                        <option value="borrador" <?= $filtros['estado'] == 'borrador' ? 'selected' : '' ?>>Borrador</option>
                                        <option value="activa" <?= $filtros['estado'] == 'activa' ? 'selected' : '' ?>>Activa</option>
                                        <option value="pausada" <?= $filtros['estado'] == 'pausada' ? 'selected' : '' ?>>Pausada</option>
                                        <option value="finalizada" <?= $filtros['estado'] == 'finalizada' ? 'selected' : '' ?>>Finalizada</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary d-block">Filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabla de campañas -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Plataforma</th>
                                            <th>Presupuesto</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($campanas)): ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No hay campañas registradas</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($campanas as $campana): ?>
                                                <tr>
                                                    <td><strong><?= esc($campana['nombre']) ?></strong></td>
                                                    <td>
                                                        <?php
                                                        $iconClass = match($campana['tipo']) {
                                                            'google_ads' => 'fab fa-google text-danger',
                                                            'meta_ads' => 'fab fa-facebook text-primary',
                                                            'email' => 'fas fa-envelope text-info',
                                                            'seo' => 'fas fa-search text-success',
                                                            'contenido' => 'fas fa-edit text-warning',
                                                            default => 'fas fa-bullhorn'
                                                        };
                                                        ?>
                                                        <i class="<?= $iconClass ?>"></i> <?= ucfirst(str_replace('_', ' ', $campana['tipo'])) ?>
                                                    </td>
                                                    <td><?= esc($campana['plataforma']) ?></td>
                                                    <td>€<?= number_format($campana['presupuesto'], 2) ?></td>
                                                    <td><?= date('d/m/Y', strtotime($campana['fecha_inicio'])) ?></td>
                                                    <td><?= $campana['fecha_fin'] ? date('d/m/Y', strtotime($campana['fecha_fin'])) : '-' ?></td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($campana['estado']) {
                                                            'activa' => 'bg-success',
                                                            'pausada' => 'bg-warning',
                                                            'finalizada' => 'bg-secondary',
                                                            'borrador' => 'bg-info',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($campana['estado']) ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <button class="btn btn-outline-primary" title="Ver Métricas">
                                                                <i class="fas fa-chart-line"></i>
                                                            </button>
                                                            <button class="btn btn-outline-secondary" title="Editar">
                                                                <i class="fas fa-edit"></i>
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