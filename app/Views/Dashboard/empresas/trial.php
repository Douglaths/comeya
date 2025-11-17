<?= $this->include('Dashboard/templates/header') ?>
<body class="">
    <?= $this->include('Dashboard/templates/navbar') ?>

    <div class="content-page">
        <main class="main-content">
            <div class="conatiner-fluid content-inner mt-5 py-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                        <h4>Empresas en Periodo de Prueba</h4>
                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Cuentas Trial (<?= count($empresas) ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Ciudad</th>
                                                <th>Plan</th>
                                                <th>Fin Trial</th>
                                                <th>Días Restantes</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($empresas)): ?>
                                                <?php foreach ($empresas as $empresa): ?>
                                                    <?php 
                                                    $diasRestantes = 0;
                                                    if ($empresa['fecha_trial_fin']) {
                                                        $fechaFin = new DateTime($empresa['fecha_trial_fin']);
                                                        $hoy = new DateTime();
                                                        $diasRestantes = $hoy->diff($fechaFin)->days;
                                                        if ($hoy > $fechaFin) $diasRestantes = -$diasRestantes;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <strong><?= esc($empresa['nombre']) ?></strong><br>
                                                                <small class="text-muted"><?= esc($empresa['email']) ?></small>
                                                            </div>
                                                        </td>
                                                        <td><?= esc($empresa['ciudad']) ?></td>
                                                        <td>
                                                            <span class="badge bg-info">
                                                                <?= ucfirst($empresa['plan']) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?= $empresa['fecha_trial_fin'] ? date('d/m/Y', strtotime($empresa['fecha_trial_fin'])) : 'No definido' ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($diasRestantes > 0): ?>
                                                                <span class="badge bg-success"><?= $diasRestantes ?> días</span>
                                                            <?php elseif ($diasRestantes == 0): ?>
                                                                <span class="badge bg-warning">Hoy vence</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-danger">Vencido</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button class="btn btn-sm btn-success" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'activo')">
                                                                    <i class="fas fa-check"></i> Activar
                                                                </button>
                                                                <button class="btn btn-sm btn-warning" onclick="extenderTrial(<?= $empresa['id'] ?>)">
                                                                    <i class="fas fa-clock"></i> Extender
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No hay empresas en trial</td>
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
            if (confirm('¿Convertir esta empresa trial a activa?')) {
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

        function extenderTrial(empresaId) {
            const dias = prompt('¿Cuántos días extender el trial?', '15');
            if (dias && !isNaN(dias)) {
                // Aquí iría la lógica para extender el trial
                alert('Funcionalidad de extender trial pendiente de implementar');
            }
        }
    </script>

<?= $this->include('Dashboard/templates/footer') ?>