<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pedido - La Parrilla Dorada</title>
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

        <div class="confirm-content">
            <!-- Resumen del Pedido -->
            <div class="summary-box">
                <h3 class="summary-title">Resumen del pedido</h3>
                
                <div class="summary-item">
                    <span class="summary-item-name">
                        <span>Provoleta Argentina</span>
                        <span class="summary-item-quantity">x1</span>
                    </span>
                    <span class="summary-item-price">€8.50</span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-name">
                        <span>Empanadas Criollas</span>
                        <span class="summary-item-quantity">x1</span>
                    </span>
                    <span class="summary-item-price">€9.90</span>
                </div>

                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-price">€18.40</span>
                </div>
            </div>

            <!-- Información del Pedido -->
            <div class="summary-box">
                <h3 class="summary-title">Información del pedido</h3>
                
                <div class="form-group">
                    <label class="form-label">Nombre (opcional)</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Tu nombre" 
                        id="customerName"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Mesa (opcional)</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Número de mesa" 
                        id="tableNumber"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Notas especiales (opcional)</label>
                    <textarea 
                        class="form-control" 
                        placeholder="Alergias, preferencias, etc." 
                        id="specialNotes"
                    ></textarea>
                </div>
            </div>

            <button class="btn-confirm" onclick="confirmOrder()">Confirmar Pedido</button>
        </div>
    </div>

    <script>
        function goBack() {
            alert('Volviendo al menú...');
            // Aquí puedes redirigir a la vista del menú
            // window.location.href = 'menu.html';
        }

        function confirmOrder() {
            const customerName = document.getElementById('customerName').value;
            const tableNumber = document.getElementById('tableNumber').value;
            const specialNotes = document.getElementById('specialNotes').value;

            // Generar código de pedido
            const orderCode = 'ORD-' + Math.floor(Math.random() * 900000 + 100000);
            const currentDate = new Date().toLocaleDateString('es-ES');

            // Cambiar el contenido a la vista de comprobante
            document.querySelector('.confirm-title').textContent = '¡Pedido Confirmado!';
            document.querySelector('.back-link').style.display = 'none';
            
            document.querySelector('.confirm-content').innerHTML = `
                <div style="text-align: center; padding: 20px 0;">
                    <div class="success-icon" style="width: 80px; height: 80px; background-color: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg class="checkmark-svg" viewBox="0 0 52 52">
                            <path class="checkmark-path" d="M14,27 L22,35 L38,19" />
                        </svg>
                    </div>
                    <p style="color: #666; margin-bottom: 30px;">Tu pedido ha sido recibido correctamente</p>
                </div>

                <div style="background: #e7f3ff; border: 2px solid #007bff; border-radius: 8px; padding: 20px; text-align: center; margin: 20px 0;">
                    <div style="color: #666; font-size: 0.9rem; margin-bottom: 8px;">Código de pedido</div>
                    <div style="font-size: 2rem; font-weight: 700; color: #007bff; font-family: monospace;">${orderCode}</div>
                </div>

                <div class="summary-box">
                    <h3 class="summary-title">Detalles del pedido</h3>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e9ecef;">
                        <span>Restaurante</span>
                        <span style="font-weight: 600;">La Parrilla Dorada</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e9ecef;">
                        <span>Total</span>
                        <span style="font-weight: 700;">€18.40</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                        <span>Fecha</span>
                        <span>${currentDate}</span>
                    </div>
                </div>

                <p style="color: #666; font-size: 0.9rem; text-align: center; margin: 20px 0;">Guarda tu código de pedido. El personal del restaurante lo usará para identificar tu orden.</p>

                <button class="btn-confirm" onclick="newOrder()">Hacer otro pedido</button>
                <div style="text-align: center; margin-top: 15px;">
                    <a href="<?= base_url('/') ?>" style="color: #666; text-decoration: none;">Volver al inicio</a>
                </div>
            `;
        }

        function newOrder() {
            window.location.href = '<?= base_url('/restaurantes') ?>';
        }

        // Autoenfoque en el primer campo (opcional)
        window.addEventListener('load', () => {
            document.getElementById('customerName').focus();
        });
    </script>
</body>
</html>