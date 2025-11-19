<?= $this->include('templates/header') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h2 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Confirmar Pedido</h2>
                </div>
                <div class="card-body">
                    <div id="pedidoContainer">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                            <p class="mt-3 text-muted">Cargando información del pedido...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carritoData = localStorage.getItem('carrito');
    const container = document.getElementById('pedidoContainer');
    
    if (!carritoData) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                <h4 class="mt-3">No hay información del pedido</h4>
                <p class="text-muted">Regresa al restaurante para agregar productos</p>
                <a href="<?= base_url('/') ?>" class="btn btn-primary">Volver al inicio</a>
            </div>
        `;
        return;
    }
    
    const carrito = JSON.parse(carritoData);
    const restauranteUrl = carrito.restauranteUrl || carrito.restauranteId;
    const pedido = {
        items: carrito.items,
        restaurante: {
            id: carrito.restauranteId,
            nombre: carrito.restauranteNombre
        },
        total: carrito.items.reduce((total, item) => total + (item.precio * item.cantidad), 0)
    };
    
    container.innerHTML = `
        <div class="mb-4">
            <h4 class="text-primary"><i class="fas fa-store me-2"></i>${pedido.restaurante.nombre}</h4>
            <hr>
        </div>
        
        <div class="mb-4">
            <h5 class="mb-3">Productos seleccionados:</h5>
            <div class="list-group">
                ${pedido.items.map(item => `
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="${item.imagen}" alt="${item.nombre}" 
                                 class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1">${item.nombre}</h6>
                                <small class="text-muted">Cantidad: ${item.cantidad}</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold">$${(item.precio * item.cantidad).toFixed(2)}</div>
                            <small class="text-muted">$${item.precio.toFixed(2)} c/u</small>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
        
        <div class="mb-4">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <strong>Subtotal:</strong>
                        </div>
                        <div class="col-6 text-end">
                            <strong>$${pedido.total.toFixed(2)}</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            Envío:
                        </div>
                        <div class="col-6 text-end">
                            $3.00
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Total:</h5>
                        </div>
                        <div class="col-6 text-end">
                            <h5 class="mb-0 text-primary">$${(pedido.total + 3).toFixed(2)}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <form id="pedidoForm">
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección de entrega *</label>
                <textarea class="form-control" id="direccion" name="direccion" rows="2" 
                          placeholder="Ingresa tu dirección completa" required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono *</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" 
                           placeholder="Ej: +1234567890" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre completo *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           placeholder="Tu nombre completo" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="notas" class="form-label">Notas adicionales</label>
                <textarea class="form-control" id="notas" name="notas" rows="2" 
                          placeholder="Instrucciones especiales para tu pedido (opcional)"></textarea>
            </div>
            
            <div class="mb-4">
                <h6>Método de pago:</h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodoPago" id="efectivo" value="efectivo" checked>
                    <label class="form-check-label" for="efectivo">
                        <i class="fas fa-money-bill-wave me-2"></i>Efectivo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="metodoPago" id="tarjeta" value="tarjeta">
                    <label class="form-check-label" for="tarjeta">
                        <i class="fas fa-credit-card me-2"></i>Tarjeta de crédito/débito
                    </label>
                </div>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-check me-2"></i>Confirmar Pedido - $${(pedido.total + 3).toFixed(2)}
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                    <i class="fas fa-arrow-left me-2"></i>Volver al menú
                </button>
            </div>
        </form>
    `;
    
    // Manejar envío del formulario
    document.getElementById('pedidoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const pedidoCompleto = {
            ...pedido,
            direccion: formData.get('direccion'),
            telefono: formData.get('telefono'),
            nombre: formData.get('nombre'),
            notas: formData.get('notas'),
            metodoPago: formData.get('metodoPago'),
            envio: 3.00,
            totalFinal: pedido.total + 3
        };
        
        // Enviar pedido al servidor
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
        submitBtn.disabled = true;
        
        fetch('<?= base_url('pedidos/crear') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(pedidoCompleto)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Limpiar carrito
                localStorage.removeItem('carrito');
                
                // Mostrar confirmación con número de pedido
                container.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h3 class="mt-3 text-success">¡Pedido confirmado!</h3>
                        <div class="alert alert-info mt-3">
                            <h5 class="mb-0">Número de pedido: <strong>#${data.numeroPedido}</strong></h5>
                            <small>Guarda este número para hacer seguimiento</small>
                        </div>
                        <p class="text-muted">Tu pedido ha sido enviado al restaurante</p>
                        <p class="text-muted">Tiempo estimado de entrega: 30-45 minutos</p>
                        <div class="mt-4">
                            <a href="${restauranteUrl}" class="btn btn-primary me-2">Volver al restaurante</a>
                            <button class="btn btn-outline-primary" onclick="window.print()">Imprimir recibo</button>
                        </div>
                    </div>
                `;
            } else {
                alert('Error al procesar el pedido: ' + data.message);
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar el pedido');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
});
</script>

<style>
.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-bottom: 1px solid #eee;
    border-radius: 12px 12px 0 0 !important;
}

.list-group-item {
    border: 1px solid #f0f0f0;
    margin-bottom: 8px;
    border-radius: 8px;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #ddd;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}
</style>

<?= $this->include('templates/footer') ?>