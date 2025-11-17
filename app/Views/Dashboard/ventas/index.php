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
                    <h2>Resumen de Ventas</h2>
                    <div>
                        <a href="<?= base_url('public/superadmin/ventas/exportar?tipo=csv') ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-file-csv"></i> Exportar CSV
                        </a>
                        <a href="<?= base_url('public/superadmin/ventas/exportar?tipo=excel') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-file-excel"></i> Exportar Excel
                        </a>
                    </div>
                </div>

                <!-- Estadísticas principales -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Ventas Hoy</h6>
                                        <h4>€<?= number_format($ventasHoy, 2) ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-euro-sign fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Ventas del Mes</h6>
                                        <h4>€<?= number_format($ventasMes, 2) ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-chart-line fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Total Facturado</h6>
                                        <h4>€<?= number_format($ventasTotal, 2) ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-coins fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Pedidos Hoy</h6>
                                        <h4><?= $pedidosHoy ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-shopping-cart fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de ventas -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Ventas de los Últimos 30 Días</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="ventasChart" height="100"></canvas>
                    </div>
                </div>

                <!-- Enlaces rápidos -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-building fa-3x text-primary mb-3"></i>
                                <h5>Ventas por Empresa</h5>
                                <p>Ranking y análisis por empresa</p>
                                <a href="<?= base_url('public/superadmin/ventas/empresas') ?>" class="btn btn-primary">Ver Ranking</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-box fa-3x text-success mb-3"></i>
                                <h5>Top Productos</h5>
                                <p>Productos más vendidos</p>
                                <a href="<?= base_url('public/superadmin/ventas/productos') ?>" class="btn btn-success">Ver Productos</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-list fa-3x text-info mb-3"></i>
                                <h5>Pedidos Globales</h5>
                                <p>Listado completo de pedidos</p>
                                <a href="<?= base_url('public/superadmin/ventas/pedidos') ?>" class="btn btn-info">Ver Pedidos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('ventasChart').getContext('2d');
const chartData = <?= json_encode($chartData) ?>;

const labels = chartData.map(item => item.fecha);
const data = chartData.map(item => parseFloat(item.total));

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Ventas (€)',
            data: data,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
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
</script>

<?= $this->include('dashboard/templates/footer') ?>