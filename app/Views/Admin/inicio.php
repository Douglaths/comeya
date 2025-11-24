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
                    <h4>Hola, <?= session()->get('empresa_nombre') ?? 'Restaurante' ?> 👋</h4>
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
                                    <small><?= $estadisticas['producto_top_cantidad'] ?? 12 ?> vendidos este mes</small>
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
                                                        <button type="button" class="btn btn-sm btn-primary" 
                                                                onclick="verDetallesPedido(<?= $pedido['id'] ?>)">
                                                            Ver Detalles
                                                        </button>
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

    <!-- Modal para detalles del pedido -->
    <div class="modal fade" id="modalDetallesPedido" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contenidoDetallesPedido">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function verDetallesPedido(pedidoId) {
        const modal = new bootstrap.Modal(document.getElementById('modalDetallesPedido'));
        const contenido = document.getElementById('contenidoDetallesPedido');
        
        // Mostrar loading
        contenido.innerHTML = `
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
        `;
        
        modal.show();
        
        // Cargar detalles del pedido
        fetch(`<?= base_url('admin/pedidos/ver/') ?>${pedidoId}`)
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
                                <td>${item.cantidad}</td>
                                <td>$${parseInt(item.precio_unitario).toLocaleString()}</td>
                                <td>$${parseInt(item.subtotal).toLocaleString()}</td>
                            </tr>
                        `;
                    });
                    
                    const fechaPedido = new Date(pedido.fecha_pedido);
                    const fechaProcesando = pedido.fecha_procesando ? new Date(pedido.fecha_procesando) : null;
                    const fechaEnviado = pedido.fecha_enviado ? new Date(pedido.fecha_enviado) : null;
                    const fechaCompletado = pedido.fecha_completado ? new Date(pedido.fecha_completado) : null;
                    
                    contenido.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Información del Cliente</h6>
                                <p><strong>Nombre:</strong> ${pedido.nombre_cliente}</p>
                                <p><strong>Teléfono:</strong> ${pedido.telefono_cliente}</p>
                                <p><strong>Dirección:</strong> ${pedido.direccion_cliente || 'No especificada'}</p>
                                <p><strong>Medio de Pago:</strong> ${pedido.medio_pago === 'efectivo' ? 'Efectivo' : 'Transferencia'}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Información del Pedido</h6>
                                <p><strong>Número:</strong> ${pedido.numero_pedido}</p>
                                <p><strong>Estado:</strong> <span class="badge ${
                                    pedido.estado === 'pendiente' ? 'bg-warning' :
                                    pedido.estado === 'procesando' ? 'bg-info' :
                                    pedido.estado === 'enviado' ? 'bg-primary' :
                                    pedido.estado === 'completado' ? 'bg-success' : 'bg-danger'
                                }">${pedido.estado.charAt(0).toUpperCase() + pedido.estado.slice(1)}</span></p>
                                <p><strong>Total:</strong> $${parseInt(pedido.total).toLocaleString()}</p>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6>Timeline del Pedido</h6>
                        <div class="timeline mb-3">
                            <div class="timeline-item ${pedido.estado === 'pendiente' ? 'active' : 'completed'}">
                                <strong>Pedido Recibido:</strong> ${fechaPedido.toLocaleString()}
                            </div>
                            ${fechaProcesando ? `
                                <div class="timeline-item ${pedido.estado === 'procesando' ? 'active' : 'completed'}">
                                    <strong>En Preparación:</strong> ${fechaProcesando.toLocaleString()}
                                </div>
                            ` : ''}
                            ${fechaEnviado ? `
                                <div class="timeline-item ${pedido.estado === 'enviado' ? 'active' : 'completed'}">
                                    <strong>Enviado:</strong> ${fechaEnviado.toLocaleString()}
                                </div>
                            ` : ''}
                            ${fechaCompletado ? `
                                <div class="timeline-item completed">
                                    <strong>Completado:</strong> ${fechaCompletado.toLocaleString()}
                                </div>
                            ` : ''}
                        </div>
                        
                        <hr>
                        
                        <h6>Productos del Pedido</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unit.</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${itemsHtml}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total:</th>
                                        <th>$${parseInt(pedido.total).toLocaleString()}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    `;
                } else {
                    contenido.innerHTML = '<div class="alert alert-danger">Error al cargar los detalles del pedido</div>';
                }
            })
            .catch(error => {
                contenido.innerHTML = '<div class="alert alert-danger">Error al cargar los detalles del pedido</div>';
            });
    }
    </script>

    <style>
    .timeline-item {
        padding: 8px 0;
        border-left: 3px solid #dee2e6;
        padding-left: 15px;
        margin-bottom: 10px;
    }
    .timeline-item.active {
        border-left-color: #0d6efd;
        background-color: #f8f9fa;
    }
    .timeline-item.completed {
        border-left-color: #198754;
    }
    </style>

<?= $this->include('Admin/templates/footer') ?>