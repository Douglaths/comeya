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
                        <h2>Pagos Recibidos</h2>
                        <a href="<?= base_url('public/superadmin/contabilidad') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <!-- Filtros -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Empresa</label>
                                    <select class="form-select" name="empresa">
                                        <option value="">Todas las empresas</option>
                                        <?php foreach ($empresas as $empresa): ?>
                                            <option value="<?= $empresa['id'] ?>" <?= $filtros['empresa'] == $empresa['id'] ? 'selected' : '' ?>>
                                                <?= esc($empresa['nombre']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Método de Pago</label>
                                    <select class="form-select" name="metodo">
                                        <option value="">Todos</option>
                                        <option value="stripe" <?= $filtros['metodo'] == 'stripe' ? 'selected' : '' ?>>Stripe</option>
                                        <option value="transferencia" <?= $filtros['metodo'] == 'transferencia' ? 'selected' : '' ?>>Transferencia</option>
                                        <option value="paypal" <?= $filtros['metodo'] == 'paypal' ? 'selected' : '' ?>>PayPal</option>
                                        <option value="efectivo" <?= $filtros['metodo'] == 'efectivo' ? 'selected' : '' ?>>Efectivo</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="estado">
                                        <option value="">Todos</option>
                                        <option value="completado" <?= $filtros['estado'] == 'completado' ? 'selected' : '' ?>>Completado</option>
                                        <option value="pendiente" <?= $filtros['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="fallido" <?= $filtros['estado'] == 'fallido' ? 'selected' : '' ?>>Fallido</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary d-block">Filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabla de pagos -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Factura</th>
                                            <th>Empresa</th>
                                            <th>Monto</th>
                                            <th>Método</th>
                                            <th>Estado</th>
                                            <th>Fecha Pago</th>
                                            <th>Referencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($pagos)): ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No hay pagos registrados</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($pagos as $pago): ?>
                                                <tr>
                                                    <td><?= esc($pago['factura_numero']) ?></td>
                                                    <td><?= esc($pago['empresa_nombre']) ?></td>
                                                    <td>€<?= number_format($pago['monto'], 2) ?></td>
                                                    <td>
                                                        <?php
                                                        $iconClass = match($pago['metodo_pago']) {
                                                            'stripe' => 'fab fa-stripe text-primary',
                                                            'paypal' => 'fab fa-paypal text-info',
                                                            'transferencia' => 'fas fa-university text-success',
                                                            'efectivo' => 'fas fa-money-bill text-warning',
                                                            default => 'fas fa-credit-card'
                                                        };
                                                        ?>
                                                        <i class="<?= $iconClass ?>"></i> <?= ucfirst($pago['metodo_pago']) ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($pago['estado']) {
                                                            'completado' => 'bg-success',
                                                            'pendiente' => 'bg-warning',
                                                            'fallido' => 'bg-danger',
                                                            'reembolsado' => 'bg-secondary',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($pago['estado']) ?></span>
                                                    </td>
                                                    <td><?= date('d/m/Y H:i', strtotime($pago['fecha_pago'])) ?></td>
                                                    <td><?= esc($pago['referencia_externa']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>