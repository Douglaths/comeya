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
                        <h2>Facturas Morosas</h2>
                        <a href="<?= base_url('public/superadmin/contabilidad') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <!-- Alerta -->
                    <div class="alert alert-warning mb-4">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Atención:</strong> Estas empresas tienen facturas vencidas que requieren seguimiento.
                    </div>

                    <!-- Tabla de morosos -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Email</th>
                                            <th>Factura</th>
                                            <th>Monto</th>
                                            <th>Fecha Vencimiento</th>
                                            <th>Días Vencido</th>
                                            <th>Concepto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($facturasMorosas)): ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-success">
                                                    <i class="fas fa-check-circle fa-2x mb-2"></i><br>
                                                    No hay facturas morosas
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($facturasMorosas as $factura): ?>
                                                <?php
                                                $fechaVencimiento = new DateTime($factura['fecha_vencimiento']);
                                                $hoy = new DateTime();
                                                $diasVencido = $hoy->diff($fechaVencimiento)->days;
                                                
                                                $alertClass = '';
                                                if ($diasVencido > 30) {
                                                    $alertClass = 'table-danger';
                                                } elseif ($diasVencido > 15) {
                                                    $alertClass = 'table-warning';
                                                }
                                                ?>
                                                <tr class="<?= $alertClass ?>">
                                                    <td>
                                                        <strong><?= esc($factura['empresa_nombre']) ?></strong>
                                                    </td>
                                                    <td><?= esc($factura['email']) ?></td>
                                                    <td><?= esc($factura['numero']) ?></td>
                                                    <td>
                                                        <strong>€<?= number_format($factura['monto'], 2) ?></strong>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($factura['fecha_vencimiento'])) ?></td>
                                                    <td>
                                                        <span class="badge bg-danger"><?= $diasVencido ?> días</span>
                                                    </td>
                                                    <td><?= esc($factura['concepto']) ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="mailto:<?= esc($factura['email']) ?>?subject=Factura Vencida - <?= esc($factura['numero']) ?>" 
                                                               class="btn btn-outline-primary" title="Enviar Email">
                                                                <i class="fas fa-envelope"></i>
                                                            </a>
                                                            <button class="btn btn-outline-warning" title="Marcar como Recordatorio">
                                                                <i class="fas fa-bell"></i>
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

                    <?php if (!empty($facturasMorosas)): ?>
                    <!-- Resumen -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5>Resumen de Morosidad</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-danger"><?= count($facturasMorosas) ?></h4>
                                        <p class="text-muted">Facturas Vencidas</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-danger">€<?= number_format(array_sum(array_column($facturasMorosas, 'monto')), 2) ?></h4>
                                        <p class="text-muted">Monto Total</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <?php
                                        $empresasUnicas = array_unique(array_column($facturasMorosas, 'empresa_id'));
                                        ?>
                                        <h4 class="text-warning"><?= count($empresasUnicas) ?></h4>
                                        <p class="text-muted">Empresas Afectadas</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-envelope-bulk"></i> Enviar Recordatorios
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>