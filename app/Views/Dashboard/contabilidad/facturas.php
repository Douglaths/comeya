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
                        <h2>Facturas</h2>
                        <a href="<?= base_url('public/superadmin/contabilidad') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <!-- Filtros -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-3">
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
                                <div class="col-md-2">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="estado">
                                        <option value="">Todos</option>
                                        <option value="pendiente" <?= $filtros['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="pagada" <?= $filtros['estado'] == 'pagada' ? 'selected' : '' ?>>Pagada</option>
                                        <option value="vencida" <?= $filtros['estado'] == 'vencida' ? 'selected' : '' ?>>Vencida</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" value="<?= $filtros['fecha_inicio'] ?>">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" value="<?= $filtros['fecha_fin'] ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary d-block">Filtrar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabla de facturas -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Empresa</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th>Fecha Emisión</th>
                                            <th>Fecha Vencimiento</th>
                                            <th>Concepto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($facturas)): ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No hay facturas registradas</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($facturas as $factura): ?>
                                                <tr>
                                                    <td><?= esc($factura['numero']) ?></td>
                                                    <td><?= esc($factura['empresa_nombre']) ?></td>
                                                    <td>€<?= number_format($factura['monto'], 2) ?></td>
                                                    <td>
                                                        <?php
                                                        $badgeClass = match($factura['estado']) {
                                                            'pendiente' => 'bg-warning',
                                                            'pagada' => 'bg-success',
                                                            'vencida' => 'bg-danger',
                                                            'cancelada' => 'bg-secondary',
                                                            default => 'bg-secondary'
                                                        };
                                                        ?>
                                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst($factura['estado']) ?></span>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                                                    <td><?= date('d/m/Y', strtotime($factura['fecha_vencimiento'])) ?></td>
                                                    <td><?= esc($factura['concepto']) ?></td>
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