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
                                        <option value="enviado" <?= $estado_filtro == 'enviado' ? 'selected' : '' ?>>Enviado</option>
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

                <!-- Pedidos Activos -->
                <div class="col-12">
                    <?php 
                    // Debug: mostrar todos los estados
                    $estadosEncontrados = array_unique(array_column($pedidos, 'estado'));
                    
                    $pedidosActivos = array_filter($pedidos, function($p) { 
                        return in_array($p['estado'], ['pendiente', 'procesando']); 
                    });
                    $pedidosHistorial = array_filter($pedidos, function($p) { 
                        return in_array($p['estado'], ['listo', 'enviado', 'completado', 'cancelado']); 
                    });
                    ?>
                    
                    <?php if (!empty($pedidosActivos)): ?>
                        <h5 class="mb-3"><i class="fas fa-clock text-warning"></i> Pedidos Activos</h5>
                        <div class="row mb-5">
                            <?php foreach ($pedidosActivos as $pedido): ?>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-3">
                                    <div class="card pedido-card h-100" data-pedido-id="<?= $pedido['id'] ?>" <?= 
                                        $pedido['estado'] == 'pendiente' ? 'border-warning' : 
                                        ($pedido['estado'] == 'procesando' ? 'border-info' : 
                                        ($pedido['estado'] == 'enviado' ? 'border-success' : 
                                        ($pedido['estado'] == 'completado' ? 'border-secondary' : 'border-danger')))
                                    ?>">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><?= esc($pedido['numero_pedido']) ?></h6>
                                            <span class="badge <?= 
                                                $pedido['estado'] == 'pendiente' ? 'bg-warning' : 
                                                ($pedido['estado'] == 'procesando' ? 'bg-info' : 
                                                ($pedido['estado'] == 'enviado' ? 'bg-success' : 
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
                                                            <button class="btn btn-success btn-sm" onclick="cambiarEstado(<?= $pedido['id'] ?>, 'enviado')">
                                                                Enviar
                                                            </button>
                                                        <?php elseif ($pedido['estado'] == 'enviado'): ?>
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
                        <div class="card mb-4">
                            <div class="card-body text-center py-4">
                                <i class="fas fa-clock fa-2x text-muted mb-2"></i>
                                <h6>No hay pedidos activos</h6>
                                <p class="text-muted small mb-0">Los nuevos pedidos aparecerán aquí</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Historial de Pedidos -->
                    <?php if (!empty($pedidosHistorial)): ?>
                        <h5 class="mb-3 mt-4"><i class="fas fa-history text-secondary"></i> Historial</h5>
                        <div class="row">
                            <?php foreach ($pedidosHistorial as $pedido): ?>
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-3">
                                    <div class="card pedido-card h-100 <?= 
                                        $pedido['estado'] == 'listo' ? 'border-success' : 
                                        ($pedido['estado'] == 'enviado' ? 'border-success' : 
                                        ($pedido['estado'] == 'completado' ? 'border-secondary' : 'border-danger'))
                                    ?> opacity-75">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0"><?= esc($pedido['numero_pedido']) ?></h6>
                                            <span class="badge <?= 
                                                $pedido['estado'] == 'listo' ? 'bg-success' : 
                                                ($pedido['estado'] == 'enviado' ? 'bg-success' : 
                                                ($pedido['estado'] == 'completado' ? 'bg-secondary' : 'bg-danger'))
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
                                            
                                            <div class="d-grid">
                                                <button class="btn btn-outline-secondary btn-sm" onclick="verPedido(<?= $pedido['id'] ?>)">
                                                    Ver Detalles
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted small">
                                            <?= date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<script>
let autoRefreshInterval;
let ultimoPedidoId = 0;

// Obtener el ID del último pedido al cargar
const pedidos = document.querySelectorAll('.pedido-card');
if (pedidos.length > 0) {
    const ultimoCard = pedidos[0];
    ultimoPedidoId = parseInt(ultimoCard.dataset.pedidoId) || 0;
}

// Función para verificar nuevos pedidos
function checkNuevosPedidos() {
    fetch(`<?= base_url('notificaciones/check') ?>?ultimo_id=${ultimoPedidoId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.count > 0) {
                // Mostrar notificación
                mostrarNotificacion(`${data.count} nuevo(s) pedido(s) recibido(s)`);
                
                // Actualizar último ID
                if (data.pedidos.length > 0) {
                    ultimoPedidoId = Math.max(...data.pedidos.map(p => p.id));
                }
                
                // Recargar página después de 2 segundos
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        })
        .catch(error => console.error('Error checking pedidos:', error));
}

// Función para mostrar notificaciones
function mostrarNotificacion(mensaje) {
    // Crear notificación visual
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        z-index: 9999;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        animation: slideIn 0.3s ease;
    `;
    notification.textContent = mensaje;
    document.body.appendChild(notification);
    
    // Reproducir sonido (opcional)
    try {
        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n1unEiBC13yO/eizEIHWq+8+OWT');
        audio.play();
    } catch(e) {}
    
    setTimeout(() => {
        notification.remove();
    }, 4000);
}

// Auto-refresh
document.getElementById('autoRefresh').addEventListener('change', function() {
    if (this.checked) {
        autoRefreshInterval = setInterval(() => {
            checkNuevosPedidos();
        }, 10000); // 10 segundos
    } else {
        clearInterval(autoRefreshInterval);
    }
});

// Iniciar auto-refresh por defecto
if (document.getElementById('autoRefresh').checked) {
    autoRefreshInterval = setInterval(() => {
        checkNuevosPedidos();
    }, 10000);
}

// CSS para animación
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
`;
document.head.appendChild(style);

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