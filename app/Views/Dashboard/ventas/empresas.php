<?= $this->include('dashboard/templates/header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?= $this->include('dashboard/templates/navbar') ?>
        </div>
        
        <div class="col-md-9">
            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Ventas por Empresa</h2>
                    <a href="<?= base_url('public/superadmin/ventas') ?>" class="btn btn-secondary">
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

                <!-- Ranking de empresas -->
                <div class="card">
                    <div class="card-header">
                        <h5>Ranking de Empresas por Ventas</h5>
                        <small class="text-muted">Período: <?= $fechaInicio ?> - <?= $fechaFin ?></small>
                    </div>
                    <div class="card-body">
                        <?php if (empty($rankingEmpresas)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No hay datos de ventas para el período seleccionado</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Posición</th>
                                            <th>Empresa</th>
                                            <th>Total Ventas</th>
                                            <th>Pedidos</th>
                                            <th>Promedio por Pedido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rankingEmpresas as $index => $empresa): ?>
                                            <tr>
                                                <td>
                                                    <span class="badge bg-<?= $index < 3 ? ['warning', 'secondary', 'dark'][$index] : 'light' ?> text-dark">
                                                        #<?= $index + 1 ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong><?= esc($empresa['nombre']) ?></strong>
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold">
                                                        €<?= number_format($empresa['total_ventas'], 2) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?= $empresa['total_pedidos'] ?></span>
                                                </td>
                                                <td>
                                                    €<?= number_format($empresa['total_ventas'] / $empresa['total_pedidos'], 2) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Gráfico de barras -->
                            <div class="mt-4">
                                <canvas id="empresasChart" height="100"></canvas>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if (!empty($rankingEmpresas)): ?>
const ctx = document.getElementById('empresasChart').getContext('2d');
const empresasData = <?= json_encode($rankingEmpresas) ?>;

const labels = empresasData.map(item => item.nombre);
const data = empresasData.map(item => parseFloat(item.total_ventas));

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Ventas (€)',
            data: data,
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return '€' + value.toFixed(2);
                    }
                }
            }
        }
    }
});
<?php endif; ?>
</script>

<?= $this->include('dashboard/templates/footer') ?>