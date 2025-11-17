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
                        <h2>Email Marketing</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/marketing/crear-email') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Campaña
                            </a>
                            <a href="<?= base_url('public/superadmin/marketing') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Tabla de campañas de email -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Asunto</th>
                                            <th>Destinatarios</th>
                                            <th>Programado Para</th>
                                            <th>Enviado En</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($campanas)): ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No hay campañas de email registradas</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($campanas as $campana): ?>
                                                <tr>
                                                    <td><strong><?= esc($campana['asunto']) ?></strong></td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($campana['destinatarios']) {
                                                            'todos' => 'bg-primary',
                                                            'activos' => 'bg-success',
                                                            'inactivos' => 'bg-warning',
                                                            'trial' => 'bg-info',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($campana['destinatarios']) ?></span>
                                                    </td>
                                                    <td>
                                                        <?= $campana['programado_para'] ? date('d/m/Y H:i', strtotime($campana['programado_para'])) : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?= $campana['enviado_en'] ? date('d/m/Y H:i', strtotime($campana['enviado_en'])) : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($campana['estado']) {
                                                            'enviado' => 'bg-success',
                                                            'programado' => 'bg-info',
                                                            'fallido' => 'bg-danger',
                                                            'borrador' => 'bg-secondary',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($campana['estado']) ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <?php if ($campana['estado'] == 'borrador'): ?>
                                                                <button class="btn btn-outline-success" title="Enviar Ahora">
                                                                    <i class="fas fa-paper-plane"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                            <button class="btn btn-outline-primary" title="Ver Estadísticas">
                                                                <i class="fas fa-chart-bar"></i>
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

                    <!-- Resumen de empresas -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Resumen de Destinatarios</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-primary"><?= count($empresas) ?></h4>
                                        <p class="text-muted">Total Empresas</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <?php $activas = array_filter($empresas, fn($e) => $e['activo'] == 1); ?>
                                        <h4 class="text-success"><?= count($activas) ?></h4>
                                        <p class="text-muted">Empresas Activas</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <?php $inactivas = array_filter($empresas, fn($e) => $e['activo'] == 0); ?>
                                        <h4 class="text-warning"><?= count($inactivas) ?></h4>
                                        <p class="text-muted">Empresas Inactivas</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <?php $trial = array_filter($empresas, fn($e) => $e['plan'] == 'trial'); ?>
                                        <h4 class="text-info"><?= count($trial) ?></h4>
                                        <p class="text-muted">En Trial</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>