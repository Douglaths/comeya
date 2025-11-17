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
                        <h2>Analytics y Visitas</h2>
                    </div>

                <!-- Estadísticas principales -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Visitas Hoy</h6>
                                        <h4><?= number_format($visitasHoy) ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-eye fa-2x"></i>
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
                                        <h6 class="card-title">Visitas del Mes</h6>
                                        <h4><?= number_format($visitasMes) ?></h4>
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
                                        <h6 class="card-title">Total Visitas</h6>
                                        <h4><?= number_format($visitasTotal) ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-users fa-2x"></i>
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
                                        <h6 class="card-title">Empresas Activas</h6>
                                        <h4><?= $empresasActivas ?></h4>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-building fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráfico de visitas -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Visitas de los Últimos 30 Días</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="visitasChart" height="100"></canvas>
                    </div>
                </div>

                <!-- Enlaces rápidos -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-building fa-3x text-primary mb-3"></i>
                                <h5>Visitas por Empresa</h5>
                                <p>Ranking y análisis por empresa</p>
                                <a href="<?= base_url('public/superadmin/analytics/empresas') ?>" class="btn btn-primary">Ver Ranking</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt fa-3x text-success mb-3"></i>
                                <h5>Dispositivos</h5>
                                <p>Móvil vs Desktop y navegadores</p>
                                <a href="<?= base_url('public/superadmin/analytics/dispositivos') ?>" class="btn btn-success">Ver Stats</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-share-alt fa-3x text-info mb-3"></i>
                                <h5>Orígenes de Tráfico</h5>
                                <p>QR, redes sociales, web</p>
                                <a href="<?= base_url('public/superadmin/analytics/origenes') ?>" class="btn btn-info">Ver Orígenes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('visitasChart').getContext('2d');
const chartData = <?= json_encode($chartData) ?>;

const labels = chartData.map(item => item.fecha);
const data = chartData.map(item => parseInt(item.total));

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Visitas',
            data: data,
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<?= $this->include('dashboard/templates/footer') ?>