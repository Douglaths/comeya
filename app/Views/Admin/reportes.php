<?= $this->include('Admin/templates/header') ?>

<body class="">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>

    <?= $this->include('Admin/templates/navbar') ?>

    <div class="content-page">
        <div class="container-fluid content-inner mt-5 py-0">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                    <h4>Reportes y Ventas</h4>
                </div>
                
                <!-- Filtros -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input type="date" name="fecha_inicio" class="form-control" value="<?= $fecha_inicio ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Fecha Fin</label>
                                    <input type="date" name="fecha_fin" class="form-control" value="<?= $fecha_fin ?>">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                                    <a href="<?= base_url('admin/reportes/exportar-excel?' . http_build_query(['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin])) ?>" 
                                       class="btn btn-success">
                                        <i class="fas fa-file-excel"></i> Exportar Excel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Resumen -->
                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Total Pedidos</h5>
                                    <h2><?= $total_pedidos ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Total Ventas</h5>
                                    <h2>$<?= number_format($total_ventas, 0) ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reporte de Ventas por Pedido -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Ventas por Pedido</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Pedido</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($ventas_por_pedido)): ?>
                                            <?php foreach ($ventas_por_pedido as $venta): ?>
                                                <tr>
                                                    <td><?= date('d/m/Y', strtotime($venta['fecha_pedido'])) ?></td>
                                                    <td><?= esc($venta['numero_pedido']) ?></td>
                                                    <td><?= esc($venta['nombre_cliente'] ?? 'N/A') ?></td>
                                                    <td>$<?= number_format($venta['total'], 0) ?></td>
                                                    <td>
                                                        <span class="badge <?= 
                                                            $venta['estado'] == 'pendiente' ? 'bg-warning' : 
                                                            ($venta['estado'] == 'procesando' ? 'bg-info' : 
                                                            ($venta['estado'] == 'completado' ? 'bg-success' : 'bg-primary'))
                                                        ?>">
                                                            <?= ucfirst($venta['estado']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= ($venta['medio_pago'] ?? 'efectivo') === 'efectivo' ? 'Efectivo' : 'Transferencia' ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No hay ventas en el período seleccionado</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Top Productos Más Vendidos -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Top Productos Más Vendidos</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($top_productos)): ?>
                                <?php foreach ($top_productos as $index => $producto): ?>
                                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 <?= $index < 3 ? 'bg-light rounded' : '' ?>">
                                        <div>
                                            <div class="fw-bold">
                                                <?php if ($index === 0): ?>
                                                    <i class="fas fa-trophy text-warning"></i>
                                                <?php elseif ($index === 1): ?>
                                                    <i class="fas fa-medal text-secondary"></i>
                                                <?php elseif ($index === 2): ?>
                                                    <i class="fas fa-award text-warning"></i>
                                                <?php else: ?>
                                                    <span class="text-muted"><?= $index + 1 ?>.</span>
                                                <?php endif; ?>
                                                <?= esc($producto['nombre']) ?>
                                            </div>
                                            <small class="text-muted">$<?= number_format($producto['total_ingresos'], 0) ?> en ingresos</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold text-primary"><?= $producto['total_vendido'] ?></div>
                                            <small class="text-muted">vendidos</small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted">No hay datos de productos</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->include('Admin/templates/footer') ?>