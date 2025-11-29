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
                        <h4>Gestión de Empresas</h4>
                        <div>
                            <a href="<?= base_url('superadmin/empresas/solicitudes') ?>" class="btn btn-warning me-2 position-relative">
                                <i class="fas fa-clock"></i> Solicitudes
                                <?php if ($solicitudes_pendientes > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $solicitudes_pendientes ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <a href="<?= base_url('superadmin/empresas/crear') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Empresa
                            </a>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Estado</label>
                                        <select name="estado" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="activo" <?= ($filtros['estado'] ?? '') == 'activo' ? 'selected' : '' ?>>Activo</option>
                                            <option value="inactivo" <?= ($filtros['estado'] ?? '') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                            <option value="suspendido" <?= ($filtros['estado'] ?? '') == 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
                                            <option value="trial" <?= ($filtros['estado'] ?? '') == 'trial' ? 'selected' : '' ?>>Trial</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Plan</label>
                                        <select name="plan" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="basico" <?= ($filtros['plan'] ?? '') == 'basico' ? 'selected' : '' ?>>Básico</option>
                                            <option value="premium" <?= ($filtros['plan'] ?? '') == 'premium' ? 'selected' : '' ?>>Premium</option>
                                            <option value="enterprise" <?= ($filtros['plan'] ?? '') == 'enterprise' ? 'selected' : '' ?>>Enterprise</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Ciudad</label>
                                        <input type="text" name="ciudad" class="form-control" value="<?= $filtros['ciudad'] ?? '' ?>" placeholder="Buscar ciudad">
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">Limpiar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de empresas -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Lista de Empresas (<?= count($empresas) ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Ciudad</th>
                                                <th>Plan</th>
                                                <th>Estado</th>
                                                <th>Fecha Alta</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($empresas)): ?>
                                                <?php foreach ($empresas as $empresa): ?>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <strong><?= esc($empresa['nombre']) ?></strong><br>
                                                                <small class="text-muted"><?= esc($empresa['email']) ?></small>
                                                            </div>
                                                        </td>
                                                        <td><?= esc($empresa['ciudad']) ?></td>
                                                        <td>
                                                            <span class="badge bg-<?= $empresa['plan'] == 'enterprise' ? 'success' : ($empresa['plan'] == 'premium' ? 'warning' : 'secondary') ?>">
                                                                <?= ucfirst($empresa['plan']) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-<?= $empresa['estado'] == 'activo' ? 'success' : ($empresa['estado'] == 'trial' ? 'info' : 'danger') ?>">
                                                                <?= ucfirst($empresa['estado']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= date('d/m/Y', strtotime($empresa['fecha_alta'])) ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="<?= base_url('superadmin/empresas/impersonar/' . $empresa['id']) ?>" 
                                                                   class="btn btn-sm btn-primary" title="Impersonar">
                                                                    <i class="fas fa-sign-in-alt"></i>
                                                                </a>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                        <i class="fas fa-cog"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'activo')">Activar</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'inactivo')">Desactivar</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'suspendido')">Suspender</a></li>
                                                                        <li><hr class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarPlan(<?= $empresa['id'] ?>, 'basico')">Plan Básico</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarPlan(<?= $empresa['id'] ?>, 'premium')">Plan Premium</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarPlan(<?= $empresa['id'] ?>, 'enterprise')">Plan Enterprise</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No hay empresas registradas</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function cambiarEstado(empresaId, estado) {
            if (confirm('¿Está seguro de cambiar el estado de esta empresa?')) {
                fetch('<?= base_url('superadmin/empresas/cambiar-estado') ?>/' + empresaId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ estado: estado })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el estado');
                    }
                });
            }
        }

        function cambiarPlan(empresaId, plan) {
            if (confirm('¿Está seguro de cambiar el plan de esta empresa?')) {
                fetch('<?= base_url('superadmin/empresas/cambiar-plan') ?>/' + empresaId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ plan: plan })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el plan');
                    }
                });
            }
        }
    </script>

<?= $this->include('Dashboard/templates/footer') ?>