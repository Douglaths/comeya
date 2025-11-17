<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Pedido - La Parrilla Dorada</title>
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

        /* Vista 1: Carrito */
        .cart-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .cart-items {
            padding: 20px;
            flex: 1;
        }

        .cart-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .cart-item-price {
            color: var(--primary-red);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .cart-item-total {
            color: var(--text-dark);
            font-size: 1.1rem;
            font-weight: 700;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: var(--light-gray);
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            font-weight: 600;
            font-size: 1rem;
        }

        .delete-btn {
            background: none;
            border: none;
            color: var(--primary-red);
            cursor: pointer;
            padding: 5px;
        }

        .cart-footer {
            position: sticky;
            bottom: 0;
            background: white;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .cart-subtotal {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #666;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .cart-total-label {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .cart-total-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-orange);
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
        }

        .btn-confirm:hover {
            background-color: #f4511e;
        }

        /* Vista 2: Confirmar Pedido */
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
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Vista 3: Confirmación */
        .success-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            text-align: center;
            min-height: 80vh;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .success-icon i {
            font-size: 2.5rem;
            color: #4caf50;
        }

        .success-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .success-message {
            color: #666;
            margin-bottom: 30px;
        }

        .order-code-box {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            width: 100%;
            max-width: 400px;
        }

        .order-code-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .order-code {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-orange);
            letter-spacing: 1px;
        }

        .order-details {
            width: 100%;
            max-width: 400px;
            margin-bottom: 30px;
        }

        .order-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-detail-row:last-child {
            border-bottom: none;
        }

        .order-note {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 30px;
            max-width: 400px;
        }

        .btn-secondary {
            background: white;
            color: var(--primary-orange);
            border: 2px solid var(--primary-orange);
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-link {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 1rem;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <!-- Vista 1: Carrito -->
    <div id="cartView" class="view-container">
        <div class="cart-header">
            <h2 class="cart-title">Tu Pedido</h2>
            <button class="close-btn" onclick="closeCart()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="cart-items">
            <div class="cart-item">
                <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=100&h=100&fit=crop" alt="Provoleta" class="cart-item-image">
                <div class="cart-item-details">
                    <div class="cart-item-name">Provoleta Argentina</div>
                    <div class="cart-item-price">€8.50</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity(0)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="quantity-input" value="1" readonly id="quantity-0">
                        <button class="quantity-btn" onclick="increaseQuantity(0)">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="delete-btn" onclick="removeItem(0)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="cart-item-total" id="total-0">€8.50</div>
            </div>

            <div class="cart-item">
                <img src="https://images.unsplash.com/photo-1599974229858-c3bb1fc350e6?w=100&h=100&fit=crop" alt="Empanadas" class="cart-item-image">
                <div class="cart-item-details">
                    <div class="cart-item-name">Empanadas Criollas</div>
                    <div class="cart-item-price">€9.90</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity(1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="quantity-input" value="1" readonly id="quantity-1">
                        <button class="quantity-btn" onclick="increaseQuantity(1)">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="delete-btn" onclick="removeItem(1)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="cart-item-total" id="total-1">€9.90</div>
            </div>
        </div>

        <div class="cart-footer">
            <div class="cart-subtotal">
                <span>Subtotal</span>
                <span id="subtotal">€18.40</span>
            </div>
            <div class="cart-total">
                <span class="cart-total-label">Total</span>
                <span class="cart-total-price" id="total">€18.40</span>
            </div>
            <button class="btn-confirm" onclick="goToConfirm()">Confirmar Pedido</button>
        </div>
    </div>

    <!-- Vista 2: Confirmar Pedido -->
    <div id="confirmView" class="view-container hidden">
        <div class="confirm-header">
            <a href="#" class="back-link" onclick="goToCart(); return false;">
                <i class="fas fa-arrow-left"></i>
                Volver al menú
            </a>
            <h2 class="confirm-title">Confirmar Pedido</h2>
        </div>

        <div class="confirm-content">
            <div class="summary-box">
                <h3 class="summary-title">Resumen del pedido</h3>
                <div class="summary-item">
                    <span class="summary-item-name">
                        <span>Provoleta Argentina</span>
                        <span>x1</span>
                    </span>
                    <span>€8.50</span>
                </div>
                <div class="summary-item">
                    <span class="summary-item-name">
                        <span>Empanadas Criollas</span>
                        <span>x1</span>
                    </span>
                    <span>€9.90</span>
                </div>
                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-price">€18.40</span>
                </div>
            </div>

            <div class="summary-box">
                <h3 class="summary-title">Información del pedido</h3>
                <div class="form-group">
                    <label class="form-label">Nombre (opcional)</label>
                    <input type="text" class="form-control" placeholder="Tu nombre" id="customerName">
                </div>
                <div class="form-group">
                    <label class="form-label">Mesa (opcional)</label>
                    <input type="text" class="form-control" placeholder="Número de mesa" id="tableNumber">
                </div>
                <div class="form-group">
                    <label class="form-label">Notas especiales (opcional)</label>
                    <textarea class="form-control" placeholder="Alergias, preferencias, etc." id="specialNotes"></textarea>
                </div>
            </div>

            <button class="btn-confirm" onclick="confirmOrder()">Confirmar Pedido</button>
        </div>
    </div>

    <!-- Vista 3: Pedido Confirmado -->
    <div id="successView" class="view-container hidden">
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="success-title">¡Pedido Confirmado!</h2>
            <p class="success-message">Tu pedido ha sido recibido correctamente</p>

            <div class="order-code-box">
                <div class="order-code-label">Código de pedido</div>
                <div class="order-code" id="orderCode">ORD-674105</div>
            </div>

            <div class="order-details">
                <div class="order-detail-row">
                    <span>Restaurante</span>
                    <span style="font-weight: 600;">La Parrilla Dorada</span>
                </div>
                <div class="order-detail-row">
                    <span>Total</span>
                    <span style="font-weight: 700;">€18.40</span>
                </div>
            </div>

            <p class="order-note">Guarda tu código de pedido. El personal del restaurante lo usará para identificar tu orden.</p>

            <button class="btn-confirm" onclick="newOrder()">Hacer otro pedido</button>
            <button class="btn-link" onclick="goHome()">Volver al inicio</button>
        </div>
    </div>

    <script>
        const prices = [8.50, 9.90];
        let quantities = [1, 1];

        function updateTotals() {
            let subtotal = 0;
            quantities.forEach((qty, index) => {
                const itemTotal = prices[index] * qty;
                subtotal += itemTotal;
                const totalElement = document.getElementById(`total-${index}`);
                if (totalElement) {
                    totalElement.textContent = `€${itemTotal.toFixed(2)}`;
                }
            });
            
            document.getElementById('subtotal').textContent = `€${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `€${subtotal.toFixed(2)}`;
        }

        function increaseQuantity(index) {
            quantities[index]++;
            document.getElementById(`quantity-${index}`).value = quantities[index];
            updateTotals();
        }

        function decreaseQuantity(index) {
            if (quantities[index] > 1) {
                quantities[index]--;
                document.getElementById(`quantity-${index}`).value = quantities[index];
                updateTotals();
            }
        }

        function removeItem(index) {
            if (confirm('¿Deseas eliminar este producto del carrito?')) {
                quantities[index] = 0;
                const items = document.querySelectorAll('.cart-item');
                if (items[index]) {
                    items[index].remove();
                }
                updateTotals();
            }
        }

        function goToConfirm() {
            window.location.href = '/comeya/public/confirmar-pedido';
        }

        function goToCart() {
            document.getElementById('confirmView').classList.add('hidden');
            document.getElementById('cartView').classList.remove('hidden');
        }

        function confirmOrder() {
            const orderCode = 'ORD-' + Math.floor(Math.random() * 900000 + 100000);
            document.getElementById('orderCode').textContent = orderCode;
            
            document.getElementById('confirmView').classList.add('hidden');
            document.getElementById('successView').classList.remove('hidden');
        }

        function newOrder() {
            document.getElementById('successView').classList.add('hidden');
            document.getElementById('cartView').classList.remove('hidden');
        }

        function goHome() {
            alert('Volviendo al menú principal...');
        }

        function closeCart() {
            alert('Cerrando carrito...');
        }
    </script>
</body>
</html>