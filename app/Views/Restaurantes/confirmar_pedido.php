<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-orange: #ff5722;
            --primary-red: #d32323;
            --text-dark: #1a1a1a;
            --light-gray: #f5f5f5;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #f8f9fa;
        }

        .view-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
        }

        .confirm-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-red);
            text-decoration: none;
            font-size: 0.95rem;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .back-link:hover {
            color: #b91e1e;
        }

        .confirm-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .confirm-content {
            padding: 20px;
        }

        .summary-box {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .summary-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #666;
        }

        .summary-item-name {
            display: flex;
            gap: 8px;
            flex: 1;
        }

        .summary-item-quantity {
            color: #999;
            min-width: 30px;
        }

        .summary-item-price {
            font-weight: 600;
            color: var(--text-dark);
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
            font-weight: 700;
        }

        .summary-total-label {
            color: var(--text-dark);
            font-size: 1.1rem;
        }

        .summary-total-price {
            color: var(--primary-orange);
            font-size: 1.2rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: block;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-orange);
        }

        .form-control::placeholder {
            color: #999;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .btn-confirm {
            width: 100%;
            background-color: var(--primary-orange);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }

        .btn-confirm:hover {
            background-color: #f4511e;
        }

        .btn-confirm:active {
            transform: scale(0.98);
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .summary-box {
            animation: fadeIn 0.3s ease-out;
        }

        .summary-box:nth-child(2) {
            animation-delay: 0.1s;
        }

        /* Animación del check como SweetAlert */
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes drawCheck {
            0% {
                stroke-dashoffset: 100;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }

        .success-icon {
            animation: checkmark 0.6s ease-in-out;
            position: relative;
        }

        .checkmark-svg {
            width: 40px;
            height: 40px;
        }

        .checkmark-path {
            stroke: white;
            stroke-width: 3;
            fill: none;
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: drawCheck 0.8s ease-in-out 0.3s forwards;
        }
    </style>
</head>
<body>
    <div class="view-container">
        <div class="confirm-header">
            <a class="back-link" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
                Volver al menú
            </a>
            <h2 class="confirm-title">Confirmar Pedido</h2>
        </div>

        <div class="confirm-content" id="pedidoContainer">
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="mt-3 text-muted">Cargando información del pedido...</p>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            const carritoData = localStorage.getItem('carrito');
            if (carritoData) {
                const carrito = JSON.parse(carritoData);
                window.location.replace(carrito.restauranteUrl || '<?= base_url('/') ?>');
            } else {
                window.location.replace('<?= base_url('/') ?>');
            }
        }

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
            
            // Obtener costo de envío y mostrar formulario
            obtenerCostoEnvio(pedido.restaurante.id)
                .then(costoEnvio => {
                    mostrarFormularioPedido(pedido, costoEnvio);
                });
        });
        
        function mostrarFormularioPedido(pedido, costoEnvio) {
            const container = document.getElementById('pedidoContainer');
            
            container.innerHTML = `
                <!-- Resumen del Pedido -->
                <div class="summary-box">
                    <h3 class="summary-title">Resumen del pedido</h3>
                    ${pedido.items.map(item => `
                        <div class="summary-item">
                            <span class="summary-item-name">
                                <span>${item.nombre}</span>
                                <span class="summary-item-quantity">x${item.cantidad}</span>
                            </span>
                            <span class="summary-item-price">$${(item.precio * item.cantidad).toFixed(2)}</span>
                        </div>
                    `).join('')}
                    <div class="summary-item">
                        <span class="summary-item-name">Costo de envío</span>
                        <span class="summary-item-price">$${costoEnvio.toFixed(2)}</span>
                    </div>
                    <div class="summary-total">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-price">$${(pedido.total + costoEnvio).toFixed(2)}</span>
                    </div>
                </div>

                <!-- Información del Pedido -->
                <form id="orderForm">
                    <div class="summary-box">
                        <h3 class="summary-title">Información del pedido</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Nombre completo *</label>
                            <input type="text" class="form-control" placeholder="Tu nombre completo" id="customerName" name="nombre_cliente" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" placeholder="Ej: +1234567890" id="customerPhone" name="telefono_cliente" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Dirección de entrega *</label>
                            <textarea class="form-control" placeholder="Ingresa tu dirección completa" id="customerAddress" name="direccion_entrega" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Medio de pago *</label>
                            <select class="form-control" id="medioPago" name="medio_pago" required onchange="toggleTransferenciaMessage()">
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                            <div id="transferenciaMessage" style="display: none; color: #dc3545; font-size: 0.9rem; margin-top: 8px;">
                                <i class="fas fa-info-circle"></i> Debemos confirmar la transferencia para poder proceder con la preparación de tu pedido
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Notas especiales (opcional)</label>
                            <textarea class="form-control" placeholder="Alergias, preferencias, etc." id="specialNotes" name="notas_especiales"></textarea>
                        </div>
                        
                        <input type="hidden" name="empresa_id" value="${pedido.restaurante.id}">
                        <input type="hidden" name="total" value="${pedido.total + costoEnvio}">
                        <input type="hidden" name="costo_envio" value="${costoEnvio}">
                    </div>

                    <button type="button" class="btn-confirm" onclick="confirmOrder(${costoEnvio})">Confirmar Pedido - $${(pedido.total + costoEnvio).toFixed(2)}</button>
                </form>
            `;
        }

        function confirmOrder(costoEnvio = 3.00) {
            const customerName = document.getElementById('customerName').value;
            const customerPhone = document.getElementById('customerPhone').value;
            const customerAddress = document.getElementById('customerAddress').value;
            const specialNotes = document.getElementById('specialNotes').value;
            const medioPago = document.getElementById('medioPago').value;

            if (!customerName || !customerPhone || !customerAddress) {
                alert('Por favor completa todos los campos obligatorios');
                return;
            }

            const carritoData = localStorage.getItem('carrito');
            const carrito = JSON.parse(carritoData);
            const pedido = {
                items: carrito.items,
                restaurante: {
                    id: carrito.restauranteId,
                    nombre: carrito.restauranteNombre
                },
                total: carrito.items.reduce((total, item) => total + (item.precio * item.cantidad), 0),
                nombre: customerName,
                telefono: customerPhone,
                direccion: customerAddress,
                notas: specialNotes,
                metodoPago: medioPago,
                envio: costoEnvio,
                totalFinal: carrito.items.reduce((total, item) => total + (item.precio * item.cantidad), 0) + costoEnvio
            };

            // Enviar pedido al servidor
            const submitBtn = document.querySelector('.btn-confirm');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
            submitBtn.disabled = true;
            
            fetch('<?= base_url('pedidos/crear') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(pedido)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Guardar URL del restaurante antes de limpiar
                    window.restauranteUrl = carrito.restauranteUrl || carrito.restauranteId;
                    
                    // Limpiar carrito
                    localStorage.removeItem('carrito');
                    
                    // Cambiar el contenido a la vista de comprobante
                    document.querySelector('.confirm-title').textContent = '¡Pedido Confirmado!';
                    document.querySelector('.back-link').style.display = 'none';
                    
                    document.querySelector('#pedidoContainer').innerHTML = `
                        <div style="text-align: center; padding: 20px 0;">
                            <div class="success-icon" style="width: 80px; height: 80px; background-color: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                <svg class="checkmark-svg" viewBox="0 0 52 52">
                                    <path class="checkmark-path" d="M14,27 L22,35 L38,19" />
                                </svg>
                            </div>
                            <p style="color: #666; margin-bottom: 30px;">Tu pedido ha sido recibido correctamente</p>
                        </div>

                        <div style="background: #e7f3ff; border: 2px solid #007bff; border-radius: 8px; padding: 20px; text-align: center; margin: 20px 0;">
                            <div style="color: #666; font-size: 0.9rem; margin-bottom: 8px;">Número de pedido</div>
                            <div style="font-size: 2rem; font-weight: 700; color: #007bff; font-family: monospace;">#${data.numeroPedido}</div>
                        </div>

                        <div class="summary-box">
                            <h3 class="summary-title">Detalles del pedido</h3>
                            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e9ecef;">
                                <span>Restaurante</span>
                                <span style="font-weight: 600;">${pedido.restaurante.nombre}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e9ecef;">
                                <span>Subtotal</span>
                                <span style="font-weight: 600;">$${pedido.total.toFixed(2)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e9ecef;">
                                <span>Costo de envío</span>
                                <span style="font-weight: 600;">$${pedido.envio.toFixed(2)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e9ecef;">
                                <span>Total</span>
                                <span style="font-weight: 700;">$${pedido.totalFinal.toFixed(2)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                                <span>Fecha</span>
                                <span>${new Date().toLocaleDateString('es-ES')}</span>
                            </div>
                        </div>

                        <p style="color: #666; font-size: 0.9rem; text-align: center; margin: 20px 0;">Guarda tu número de pedido. El personal del restaurante lo usará para identificar tu orden.</p>

                        <button class="btn-confirm" onclick="volverRestaurante()">Hacer otro pedido</button>
                        <div style="text-align: center; margin-top: 15px;">
                            <a href="javascript:volverRestaurante()" style="color: #666; text-decoration: none;">Volver al restaurante</a>
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
        }

        function toggleTransferenciaMessage() {
            const medioPago = document.getElementById('medioPago').value;
            const message = document.getElementById('transferenciaMessage');
            
            if (medioPago === 'transferencia') {
                message.style.display = 'block';
            } else {
                message.style.display = 'none';
            }
        }

        async function obtenerCostoEnvio(empresaId) {
            try {
                const response = await fetch('<?= base_url('carrito/costo-envio') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ empresaId: empresaId })
                });
                const data = await response.json();
                return data.costo_envio || 3.00;
            } catch (error) {
                return 3.00;
            }
        }
        
        function volverRestaurante() {
            // Usar la URL guardada en la variable global
            if (window.restauranteUrl) {
                window.location.href = window.restauranteUrl;
            } else {
                window.location.href = '<?= base_url('/') ?>';
            }
        }
    </script>
</body>
</html>