<?= $this->include('Dashboard/templates/header') ?>
<body class="">
    <?= $this->include('Dashboard/templates/navbar') ?>

    <div class="content-page">
        <main class="main-content">
            <div class="conatiner-fluid content-inner mt-5 py-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                        <h4>Empresas Inactivas / Suspendidas</h4>
                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Empresas con Estado Inactivo o Suspendido (<?= count($empresas) ?>)</h5>
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
                                                            <span class="badge bg-secondary">
                                                                <?= ucfirst($empresa['plan']) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-danger">
                                                                <?= ucfirst($empresa['estado']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= date('d/m/Y', strtotime($empresa['fecha_alta'])) ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-success" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'activo')">
                                                                <i class="fas fa-check"></i> Activar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No hay empresas inactivas</td>
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
            if (confirm('¿Está seguro de activar esta empresa?')) {
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
    </script>

<?= $this->include('Dashboard/templates/footer') ?>