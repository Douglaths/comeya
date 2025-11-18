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
                    <h4>Pedidos en Tiempo Real 🍽️</h4>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" onclick="location.reload()">
                            <i class="fas fa-sync"></i> Actualizar
                        </button>
                        <div class="badge bg-success fs-6">
                            <i class="fas fa-circle"></i> En vivo
                        </div>
                    </div>
                </div>
                
                <!-- Filtros -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Fecha</label>
                                    <input type="date" class="form-control" name="fecha" value="<?= $fecha_filtro ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Estado</label>
                                    <select class="form-select" name="estado">
                                        <option value="">Todos los estados</option>
                                        <option value="pendiente" <?= $estado_filtro == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="procesando" <?= $estado_filtro == 'procesando' ? 'selected' : '' ?>>En preparación</option>
                                        <option value="listo" <?= $estado_filtro == 'listo' ? 'selected' : '' ?>>Listo</option>
                                        <option value="completado" <?= $estado_filtro == 'completado' ? 'selected' : '' ?>>Entregado</option>
                                        <option value="cancelado" <?= $estado_filtro == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                                    <a href="<?= base_url('admin/pedidos') ?>" class="btn btn-outline-secondary">Limpiar</a>
                                </div>
                                <div class="col-md-3 d-flex align-items-end justify-content-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="autoRefresh" checked>
                                        <label class="form-check-label" for="autoRefresh">Auto-actualizar</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Lista de Pedidos -->
                <div class="col-12">
                    <?php if (!empty($pedidos)): ?>
                        <div class="row">
                            <?php foreach ($pedidos as $pedido): ?>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-3">
                                    <div class="card pedido-card h-100 <?= 
                                        $pedido['estado'] == 'pendiente' ? 'border-warning' : 
                                        ($pedido['estado'] == 'procesando' ? 'border-info' : 
                                        ($pedido['estado'] == 'listo' ? 'border-success' : 
                                        ($pedido['estado'] == 'completado' ? 'border-secondary' : 'border-danger')))
                                    ?>">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><?= esc($pedido['numero_pedido']) ?></h6>
                                            <span class="badge <?= 
                                                $pedido['estado'] == 'pendiente' ? 'bg-warning' : 
                                                ($pedido['estado'] == 'procesando' ? 'bg-info' : 
                                                ($pedido['estado'] == 'listo' ? 'bg-success' : 
                                                ($pedido['estado'] == 'completado' ? 'bg-secondary' : 'bg-danger')))
                                            ?>">
                                                <?= ucfirst($pedido['estado']) ?>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <small class="text-muted">Hora</small>
                                                    <div><strong><?= date('H:i', strtotime($pedido['fecha_pedido'])) ?></strong></div>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Total</small>
                                                    <div><strong>$<?= number_format($pedido['total'], 0) ?></strong></div>
                                                </div>
                                            </div>
                                            
                                            <?php if ($pedido['cliente_nombre']): ?>
                                                <div class="mb-3">
                                                    <small class="text-muted">Cliente</small>
                                                    <div><?= esc($pedido['cliente_nombre']) ?></div>
                                                    <?php if ($pedido['cliente_telefono']): ?>
                                                        <small class="text-muted"><?= esc($pedido['cliente_telefono']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-outline-primary btn-sm" onclick="verPedido(<?= $pedido['id'] ?>)">
                                                    Ver Detalles
                                                </button>
                                                
                                                <?php if ($pedido['estado'] != 'completado' && $pedido['estado'] != 'cancelado'): ?>
                                                    <div class="btn-group" role="group">
                                                        <?php if ($pedido['estado'] == 'pendiente'): ?>
                                                            <button class="btn btn-info btn-sm" onclick="cambiarEstado(<?= $pedido['id'] ?>, 'procesando')">
                                                                Preparar
                                                            </button>
                                                        <?php elseif ($pedido['estado'] == 'procesando'): ?>
                                                            <button class="btn btn-success btn-sm" onclick="cambiarEstado(<?= $pedido['id'] ?>, 'listo')">
                                                                Listo
                                                            </button>
                                                        <?php elseif ($pedido['estado'] == 'listo'): ?>
                                                            <button class="btn btn-secondary btn-sm" onclick="cambiarEstado(<?= $pedido['id'] ?>, 'completado')">
                                                                Entregar
                                                            </button>
                                                        <?php endif; ?>
                                                        
                                                        <button class="btn btn-danger btn-sm" onclick="cambiarEstado(<?= $pedido['id'] ?>, 'cancelado')">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted small">
                                            <?= date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h5>No hay pedidos</h5>
                                <p class="text-muted">No se encontraron pedidos para los filtros seleccionados</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<script>
let autoRefreshInterval;

// Auto-refresh
document.getElementById('autoRefresh').addEventListener('change', function() {
    if (this.checked) {
        autoRefreshInterval = setInterval(() => {
            location.reload();
        }, 30000); // 30 segundos
    } else {
        clearInterval(autoRefreshInterval);
    }
});

// Iniciar auto-refresh por defecto
if (document.getElementById('autoRefresh').checked) {
    autoRefreshInterval = setInterval(() => {
        location.reload();
    }, 30000);
}

function verPedido(id) {
    fetch('<?= base_url('admin/pedidos/ver') ?>/' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const pedido = data.pedido;
                const items = data.items;
                
                let itemsHtml = '';
                items.forEach(item => {
                    itemsHtml += `
                        <tr>
                            <td>${item.producto_nombre}</td>
                            <td class="text-center">${item.cantidad}</td>
                            <td class="text-end">$${parseFloat(item.precio_unitario).toLocaleString()}</td>
                            <td class="text-end"><strong>$${parseFloat(item.subtotal).toLocaleString()}</strong></td>
                        </tr>
                    `;
                });
                
                const modalContent = `
                    <div class="modal fade" id="verPedidoModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pedido ${pedido.numero_pedido}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Cliente:</strong> ${pedido.cliente_nombre || 'No especificado'}<br>
                                            <strong>Teléfono:</strong> ${pedido.cliente_telefono || 'No especificado'}<br>
                                            <strong>Email:</strong> ${pedido.cliente_email || 'No especificado'}
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Fecha:</strong> ${new Date(pedido.fecha_pedido).toLocaleString()}<br>
                                            <strong>Estado:</strong> <span class="badge bg-info">${pedido.estado}</span><br>
                                            <strong>Total:</strong> <span class="h5 text-primary">$${parseFloat(pedido.total).toLocaleString()}</span>
                                        </div>
                                    </div>
                                    
                                    <h6>Productos:</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-end">Precio Unit.</th>
                                                    <th class="text-end">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${itemsHtml}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                document.body.insertAdjacentHTML('beforeend', modalContent);
                const modal = new bootstrap.Modal(document.getElementById('verPedidoModal'));
                modal.show();
                document.getElementById('verPedidoModal').addEventListener('hidden.bs.modal', function() {
                    this.remove();
                });
            }
        });
}

function cambiarEstado(id, nuevoEstado) {
    const confirmMsg = nuevoEstado === 'cancelado' ? 
        '¿Está seguro de cancelar este pedido?' : 
        `¿Cambiar estado a "${nuevoEstado}"?`;
        
    if (confirm(confirmMsg)) {
        fetch('<?= base_url('admin/pedidos/cambiar-estado') ?>/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'estado=' + nuevoEstado
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al cambiar el estado del pedido');
            }
        });
    }
}
</script>

<?= $this->include('Admin/templates/footer') ?>