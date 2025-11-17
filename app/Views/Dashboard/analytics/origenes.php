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
                        <h2>Orígenes de Tráfico</h2>
                        <a href="<?= base_url('public/superadmin/analytics') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                <!-- Filtros de fecha -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fecha_inicio" value="<?= $fechaInicio ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control" name="fecha_fin" value="<?= $fechaFin ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Orígenes de tráfico -->
                <div class="card">
                    <div class="card-header">
                        <h5>Distribución de Orígenes de Tráfico</h5>
                        <small class="text-muted">Período: <?= $fechaInicio ?> - <?= $fechaFin ?></small>
                    </div>
                    <div class="card-body">
                        <?php if (empty($origenesStats)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-share-alt fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No hay datos de orígenes para el período seleccionado</p>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="origenesChart" height="300"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Origen</th>
                                                    <th>Visitas</th>
                                                    <th>Porcentaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $totalOrigenes = array_sum(array_column($origenesStats, 'total'));
                                                $iconos = [
                                                    'qr' => 'fas fa-qrcode text-primary',
                                                    'social' => 'fas fa-share-alt text-info',
                                                    'web' => 'fas fa-globe text-success',
                                                    'direct' => 'fas fa-link text-warning',
                                                    'other' => 'fas fa-question text-secondary'
                                                ];
                                                foreach ($origenesStats as $origen): 
                                                    $porcentaje = $totalOrigenes > 0 ? round(($origen['total'] / $totalOrigenes) * 100, 1) : 0;
                                                    $icono = $iconos[$origen['origen']] ?? 'fas fa-question text-secondary';
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <i class="<?= $icono ?>"></i>
                                                            <?= ucfirst($origen['origen']) ?>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-primary"><?= $origen['total'] ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="progress" style="height: 20px;">
                                                                <div class="progress-bar" style="width: <?= $porcentaje ?>%">
                                                                    <?= $porcentaje ?>%
                                                                </div>
                                                            </div>
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
            </div>
        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if (!empty($origenesStats)): ?>
const ctx = document.getElementById('origenesChart').getContext('2d');
const origenesData = <?= json_encode($origenesStats) ?>;

const labels = origenesData.map(item => item.origen.toUpperCase());
const data = origenesData.map(item => parseInt(item.total));
const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: colors.slice(0, data.length),
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
<?php endif; ?>
</script>

<?= $this->include('dashboard/templates/footer') ?>