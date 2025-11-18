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
                    <h4>Mi Plan y Facturación 💳</h4>
                </div>
                
                <!-- Información del Plan Actual -->
                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Plan Actual</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <?php if ($empresa['plan'] == 'premium'): ?>
                                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            <?php elseif ($empresa['plan'] == 'enterprise'): ?>
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-crown"></i>
                                                </div>
                                            <?php else: ?>
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <h4 class="mb-0">Plan <?= ucfirst($empresa['plan']) ?></h4>
                                            <?php if ($plan_actual): ?>
                                                <h5 class="text-primary mb-0">$<?= number_format($plan_actual['precio'], 0) ?>/mes</h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>Estado:</strong>
                                        <span class="badge <?= 
                                            $empresa['estado'] == 'activo' ? 'bg-success' : 
                                            ($empresa['estado'] == 'trial' ? 'bg-warning' : 'bg-danger')
                                        ?>">
                                            <?= ucfirst($empresa['estado']) ?>
                                        </span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>Próximo cobro:</strong> <?= date('d/m/Y', strtotime($proximo_vencimiento)) ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <strong>Límite de productos:</strong> 
                                        <?= $empresa['limite_productos'] == -1 ? 'Ilimitado' : number_format($empresa['limite_productos']) ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <?php if ($plan_actual): ?>
                                        <h6>Características incluidas:</h6>
                                        <div class="text-muted">
                                            <?= nl2br(esc($plan_actual['caracteristicas'])) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php if ($empresa['estado'] == 'trial'): ?>
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-clock me-2"></i>
                                    <strong>Período de prueba:</strong> Tu trial expira el <?= date('d/m/Y', strtotime($empresa['fecha_trial_fin'])) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Resumen de Facturación -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Resumen de Facturación</h6>
                        </div>
                        <div class="card-body">
                            <?php 
                            $totalPagado = 0;
                            $facturasPendientes = 0;
                            foreach ($facturas as $factura) {
                                if ($factura['estado'] == 'pagada') {
                                    $totalPagado += $factura['monto'];
                                } elseif ($factura['estado'] == 'pendiente') {
                                    $facturasPendientes++;
                                }
                            }
                            ?>
                            
                            <div class="mb-3">
                                <small class="text-muted">Total pagado este año</small>
                                <h4 class="text-success">$<?= number_format($totalPagado, 0) ?></h4>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Facturas pendientes</small>
                                <h5 class="<?= $facturasPendientes > 0 ? 'text-warning' : 'text-success' ?>">
                                    <?= $facturasPendientes ?>
                                </h5>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Última factura</small>
                                <div>
                                    <?php if (!empty($facturas)): ?>
                                        <?= date('d/m/Y', strtotime($facturas[0]['fecha_emision'])) ?>
                                    <?php else: ?>
                                        Sin facturas
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Historial de Facturas -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Historial de Facturas</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($facturas)): ?>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Número</th>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($facturas as $factura): ?>
                                                <tr>
                                                    <td><?= esc($factura['numero']) ?></td>
                                                    <td><?= date('d/m/Y', strtotime($factura['fecha_emision'])) ?></td>
                                                    <td>$<?= number_format($factura['monto'], 0) ?></td>
                                                    <td>
                                                        <span class="badge <?= 
                                                            $factura['estado'] == 'pagada' ? 'bg-success' : 
                                                            ($factura['estado'] == 'pendiente' ? 'bg-warning' : 
                                                            ($factura['estado'] == 'vencida' ? 'bg-danger' : 'bg-secondary'))
                                                        ?>">
                                                            <?= ucfirst($factura['estado']) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted text-center">No hay facturas registradas</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Historial de Pagos -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Historial de Pagos</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($pagos)): ?>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Factura</th>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Método</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pagos as $pago): ?>
                                                <tr>
                                                    <td><?= esc($pago['factura_numero']) ?></td>
                                                    <td><?= date('d/m/Y', strtotime($pago['fecha_pago'])) ?></td>
                                                    <td>$<?= number_format($pago['monto'], 0) ?></td>
                                                    <td>
                                                        <span class="badge bg-info">
                                                            <?= ucfirst($pago['metodo_pago']) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted text-center">No hay pagos registrados</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Planes Disponibles -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Planes Disponibles</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card <?= $empresa['plan'] == 'basico' ? 'border-primary' : '' ?>">
                                        <div class="card-body text-center">
                                            <h5>Plan Básico</h5>
                                            <h3 class="text-primary">$29.900<small>/mes</small></h3>
                                            <ul class="list-unstyled text-start">
                                                <li>✓ Hasta 100 productos</li>
                                                <li>✓ Menú digital</li>
                                                <li>✓ Pedidos online</li>
                                                <li>✓ Soporte por email</li>
                                            </ul>
                                            <?php if ($empresa['plan'] == 'basico'): ?>
                                                <span class="badge bg-primary">Plan Actual</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card <?= $empresa['plan'] == 'premium' ? 'border-warning' : '' ?>">
                                        <div class="card-body text-center">
                                            <h5>Plan Premium</h5>
                                            <h3 class="text-warning">$59.900<small>/mes</small></h3>
                                            <ul class="list-unstyled text-start">
                                                <li>✓ Hasta 500 productos</li>
                                                <li>✓ Todo del plan básico</li>
                                                <li>✓ Reportes avanzados</li>
                                                <li>✓ Soporte prioritario</li>
                                                <li>✓ Promociones</li>
                                            </ul>
                                            <?php if ($empresa['plan'] == 'premium'): ?>
                                                <span class="badge bg-warning">Plan Actual</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="card <?= $empresa['plan'] == 'enterprise' ? 'border-success' : '' ?>">
                                        <div class="card-body text-center">
                                            <h5>Plan Enterprise</h5>
                                            <h3 class="text-success">$99.900<small>/mes</small></h3>
                                            <ul class="list-unstyled text-start">
                                                <li>✓ Productos ilimitados</li>
                                                <li>✓ Todo del plan premium</li>
                                                <li>✓ API completa</li>
                                                <li>✓ Soporte 24/7</li>
                                                <li>✓ Consultoría incluida</li>
                                            </ul>
                                            <?php if ($empresa['plan'] == 'enterprise'): ?>
                                                <span class="badge bg-success">Plan Actual</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->include('Admin/templates/footer') ?>