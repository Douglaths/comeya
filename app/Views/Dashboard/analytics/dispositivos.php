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
                        <h2>Dispositivos y Navegadores</h2>
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

                <!-- Stats de dispositivos -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Dispositivos</h5>
                            </div>
                            <div class="card-body text-center">
                                <?php if (empty($dispositivosStats)): ?>
                                    <p class="text-muted">No hay datos de dispositivos</p>
                                <?php else: ?>
                                    <div class="d-flex justify-content-center mb-3">
                                        <div style="width: 250px; height: 250px;">
                                            <canvas id="dispositivosChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php foreach ($dispositivosStats as $dispositivo): ?>
                                            <div class="col-4">
                                                <div class="text-center">
                                                    <h6><?= ucfirst($dispositivo['dispositivo']) ?></h6>
                                                    <span class="badge bg-primary"><?= $dispositivo['total'] ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Navegadores</h5>
                            </div>
                            <div class="card-body">
                                <?php if (empty($navegadoresStats)): ?>
                                    <p class="text-muted">No hay datos de navegadores</p>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Navegador</th>
                                                    <th>Visitas</th>
                                                    <th>%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $totalNavegadores = array_sum(array_column($navegadoresStats, 'total'));
                                                foreach ($navegadoresStats as $navegador): 
                                                    $porcentaje = $totalNavegadores > 0 ? round(($navegador['total'] / $totalNavegadores) * 100, 1) : 0;
                                                ?>
                                                    <tr>
                                                        <td><?= esc($navegador['navegador']) ?></td>
                                                        <td><span class="badge bg-primary"><?= $navegador['total'] ?></span></td>
                                                        <td><?= $porcentaje ?>%</td>
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
            </div>
        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if (!empty($dispositivosStats)): ?>
const ctx = document.getElementById('dispositivosChart').getContext('2d');
const dispositivosData = <?= json_encode($dispositivosStats) ?>;

const labels = dispositivosData.map(item => item.dispositivo);
const data = dispositivosData.map(item => parseInt(item.total));
const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'];

new Chart(ctx, {
    type: 'doughnut',
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
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
<?php endif; ?>
</script>

<?= $this->include('dashboard/templates/footer') ?>