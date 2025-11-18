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
                    <h4>Hola, Galvis Café 👋</h4>
                    <a href="#" class="btn btn-primary">Ver mi menú digital</a>
                </div>
                
                <!-- Estadísticas del día -->
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">✅ Pedidos de hoy</h5>
                                    <h2 class="mb-0"><?= $estadisticas['pedidos_hoy'] ?? 8 ?></h2>
                                    <small>Pedidos recibidos hoy</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">💰 Total vendido hoy</h5>
                                    <h2 class="mb-0">$<?= number_format($estadisticas['ventas_hoy'] ?? 156000, 0) ?></h2>
                                    <small>Ingresos del día</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">🧁 Producto más vendido</h5>
                                    <h2 class="mb-0"><?= $estadisticas['producto_top'] ?? 'Capuchino' ?></h2>
                                    <small><?= $estadisticas['producto_top_cantidad'] ?? 12 ?> vendidos hoy</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Últimos pedidos -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Últimos Pedidos</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hora</th>
                                            <th>Pedido</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($pedidos) && !empty($pedidos)): ?>
                                            <?php foreach ($pedidos as $pedido): ?>
                                                <tr>
                                                    <td><?= date('H:i', strtotime($pedido['fecha_pedido'])) ?></td>
                                                    <td><?= esc($pedido['numero_pedido']) ?></td>
                                                    <td>$<?= number_format($pedido['total'], 0) ?></td>
                                                    <td>
                                                        <span class="badge <?= 
                                                            $pedido['estado'] == 'pendiente' ? 'bg-warning' : 
                                                            ($pedido['estado'] == 'procesando' ? 'bg-info' : 
                                                            ($pedido['estado'] == 'completado' ? 'bg-success' : 'bg-danger'))
                                                        ?>">
                                                            <?= ucfirst($pedido['estado']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/pedidos/ver/' . $pedido['id']) ?>" 
                                                           class="btn btn-sm btn-primary">
                                                            Ver Detalles
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No hay pedidos recientes</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->include('Admin/templates/footer') ?>