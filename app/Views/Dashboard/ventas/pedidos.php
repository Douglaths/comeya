<?= $this->include('dashboard/templates/header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?= $this->include('dashboard/templates/navbar') ?>
        </div>
        
        <div class="col-md-9">
            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Pedidos Globales</h2>
                    <a href="<?= base_url('public/superadmin/ventas') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <!-- Filtros -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Empresa</label>
                                <select class="form-select" name="empresa_id">
                                    <option value="">Todas las empresas</option>
                                    <?php foreach ($empresas as $empresa): ?>
                                        <option value="<?= $empresa['id'] ?>" <?= $filtros['empresa_id'] == $empresa['id'] ? 'selected' : '' ?>>
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
                                    <option value="procesando" <?= $filtros['estado'] == 'procesando' ? 'selected' : '' ?>>Procesando</option>
                                    <option value="completado" <?= $filtros['estado'] == 'completado' ? 'selected' : '' ?>>Completado</option>
                                    <option value="cancelado" <?= $filtros['estado'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
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
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                    <a href="<?= base_url('public/superadmin/ventas/pedidos') ?>" class="btn btn-outline-secondary">Limpiar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Lista de pedidos -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Lista de Pedidos</h5>
                        <span class="badge bg-info"><?= count($pedidos) ?> pedidos</span>
                    </div>
                    <div class="card-body">
                        <?php if (empty($pedidos)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No se encontraron pedidos con los filtros aplicados</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Empresa</th>
                                            <th>Cliente</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pedidos as $pedido): ?>
                                            <tr>
                                                <td>
                                                    <strong><?= esc($pedido['numero_pedido']) ?></strong>
                                                </td>
                                                <td>
                                                    <span class="text-primary"><?= esc($pedido['empresa_nombre']) ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <strong><?= esc($pedido['cliente_nombre']) ?></strong>
                                                        <?php if ($pedido['cliente_email']): ?>
                                                            <br><small class="text-muted"><?= esc($pedido['cliente_email']) ?></small>
                                                        <?php endif; ?>
                                                        <?php if ($pedido['cliente_telefono']): ?>
                                                            <br><small class="text-muted"><?= esc($pedido['cliente_telefono']) ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <small><?= date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])) ?></small>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-success">€<?= number_format($pedido['total'], 2) ?></span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $badgeClass = [
                                                        'pendiente' => 'warning',
                                                        'procesando' => 'info',
                                                        'completado' => 'success',
                                                        'cancelado' => 'danger'
                                                    ][$pedido['estado']] ?? 'secondary';
                                                    ?>
                                                    <span class="badge bg-<?= $badgeClass ?>">
                                                        <?= ucfirst($pedido['estado']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Resumen -->
                            <div class="mt-3 p-3 bg-light rounded">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <strong>Total Pedidos:</strong> <?= count($pedidos) ?>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Total Facturado:</strong> 
                                        €<?= number_format(array_sum(array_column($pedidos, 'total')), 2) ?>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Promedio por Pedido:</strong> 
                                        €<?= count($pedidos) > 0 ? number_format(array_sum(array_column($pedidos, 'total')) / count($pedidos), 2) : '0.00' ?>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="<?= base_url('public/superadmin/ventas/exportar?' . http_build_query($filtros)) ?>" class="btn btn-success btn-sm">
                                            <i class="fas fa-download"></i> Exportar
                                        </a>
                                    </div>
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