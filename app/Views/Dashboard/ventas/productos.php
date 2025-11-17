<?= $this->include('dashboard/templates/header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?= $this->include('dashboard/templates/navbar') ?>
        </div>
        
        <div class="col-md-9">
            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Top Productos Más Vendidos</h2>
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

                <!-- Top productos -->
                <div class="card">
                    <div class="card-header">
                        <h5>Productos Más Vendidos</h5>
                        <small class="text-muted">Período: <?= $fechaInicio ?> - <?= $fechaFin ?></small>
                    </div>
                    <div class="card-body">
                        <?php if (empty($topProductos)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No hay datos de productos para el período seleccionado</p>
                            </div>
                        <?php else: ?>
                            <div class="row">
                                <?php foreach ($topProductos as $index => $producto): ?>
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <span class="badge bg-<?= $index < 3 ? ['warning', 'secondary', 'dark'][$index] : 'light' ?> text-dark">
                                                        #<?= $index + 1 ?>
                                                    </span>
                                                    <small class="text-muted"><?= esc($producto['empresa_nombre']) ?></small>
                                                </div>
                                                <h6 class="card-title"><?= esc($producto['nombre']) ?></h6>
                                                <div class="mb-2">
                                                    <small class="text-muted">Precio unitario:</small>
                                                    <span class="fw-bold">€<?= number_format($producto['precio'], 2) ?></span>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <div class="border-end">
                                                            <div class="fw-bold text-primary"><?= $producto['total_vendido'] ?></div>
                                                            <small class="text-muted">Vendidos</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="fw-bold text-success">€<?= number_format($producto['total_ingresos'], 2) ?></div>
                                                        <small class="text-muted">Ingresos</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Tabla detallada -->
                            <div class="mt-4">
                                <h6>Detalle Completo</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Pos.</th>
                                                <th>Producto</th>
                                                <th>Empresa</th>
                                                <th>Precio</th>
                                                <th>Cantidad Vendida</th>
                                                <th>Total Ingresos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($topProductos as $index => $producto): ?>
                                                <tr>
                                                    <td>#<?= $index + 1 ?></td>
                                                    <td><?= esc($producto['nombre']) ?></td>
                                                    <td><?= esc($producto['empresa_nombre']) ?></td>
                                                    <td>€<?= number_format($producto['precio'], 2) ?></td>
                                                    <td><span class="badge bg-primary"><?= $producto['total_vendido'] ?></span></td>
                                                    <td class="text-success fw-bold">€<?= number_format($producto['total_ingresos'], 2) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('dashboard/templates/footer') ?>