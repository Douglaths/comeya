class Carrito {
    constructor() {
        this.items = [];
        this.restauranteId = null;
        this.restauranteNombre = '';
        this.init();
    }

    init() {
        this.cargarCarrito();
        this.bindEvents();
        this.actualizarUI();
    }

    bindEvents() {
        // Agregar productos al carrito
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-agregar')) {
                const btn = e.target.closest('.btn-agregar');
                const producto = {
                    id: btn.dataset.id,
                    nombre: btn.dataset.nombre,
                    precio: parseFloat(btn.dataset.precio),
                    imagen: btn.dataset.imagen,
                    restauranteId: btn.dataset.restauranteId || this.getRestauranteId(),
                    restauranteNombre: btn.dataset.restauranteNombre || this.getRestauranteNombre()
                };
                this.agregarProducto(producto);
            }
        });

        // Controles de cantidad en el carrito
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-increase')) {
                const productId = e.target.closest('.cart-item').dataset.productId;
                this.aumentarCantidad(productId);
            }
            if (e.target.closest('.btn-decrease')) {
                const productId = e.target.closest('.cart-item').dataset.productId;
                this.disminuirCantidad(productId);
            }
            if (e.target.closest('.btn-remove')) {
                const productId = e.target.closest('.cart-item').dataset.productId;
                this.eliminarProducto(productId);
            }
        });
    }

    getRestauranteId() {
        // Obtener ID del restaurante desde la URL o datos de la página
        const url = window.location.pathname;
        const match = url.match(/\/([^\/]+)$/);
        return match ? match[1] : 'default';
    }

    getRestauranteUrl() {
        return window.location.pathname;
    }

    getRestauranteNombre() {
        const titleElement = document.querySelector('.restaurant-name');
        return titleElement ? titleElement.textContent.trim() : 'Restaurante';
    }

    cargarCarrito() {
        const carritoGuardado = localStorage.getItem('carrito');
        if (carritoGuardado) {
            const data = JSON.parse(carritoGuardado);
            const restauranteActual = this.getRestauranteId();
            
            // Solo cargar si es del mismo restaurante
            if (data.restauranteId === restauranteActual) {
                this.items = data.items || [];
                this.restauranteId = data.restauranteId;
                this.restauranteNombre = data.restauranteNombre;
                this.restauranteUrl = data.restauranteUrl;
            } else {
                // Limpiar carrito si es de otro restaurante
                this.limpiarCarrito();
            }
        }
    }

    guardarCarrito() {
        const data = {
            restauranteId: this.restauranteId,
            restauranteNombre: this.restauranteNombre,
            restauranteUrl: this.getRestauranteUrl(),
            items: this.items
        };
        localStorage.setItem('carrito', JSON.stringify(data));
    }

    agregarProducto(producto) {
        // Verificar si es del mismo restaurante
        if (this.restauranteId && this.restauranteId !== producto.restauranteId) {
            if (confirm('Tienes productos de otro restaurante en tu carrito. ¿Deseas limpiar el carrito y agregar este producto?')) {
                this.limpiarCarrito();
            } else {
                return;
            }
        }

        // Establecer restaurante si es el primero
        if (!this.restauranteId) {
            this.restauranteId = producto.restauranteId;
            this.restauranteNombre = producto.restauranteNombre;
        }

        const existingItem = this.items.find(item => item.id === producto.id);
        
        if (existingItem) {
            existingItem.cantidad++;
        } else {
            this.items.push({
                ...producto,
                cantidad: 1
            });
        }

        this.guardarCarrito();
        this.actualizarUI();
        this.mostrarNotificacion('Producto agregado al carrito');
    }

    aumentarCantidad(productId) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.cantidad++;
            this.guardarCarrito();
            this.actualizarUI();
        }
    }

    disminuirCantidad(productId) {
        const item = this.items.find(item => item.id === productId);
        if (item && item.cantidad > 1) {
            item.cantidad--;
            this.guardarCarrito();
            this.actualizarUI();
        }
    }

    eliminarProducto(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        
        // Si no quedan items, limpiar restaurante
        if (this.items.length === 0) {
            this.restauranteId = null;
            this.restauranteNombre = '';
        }
        
        this.guardarCarrito();
        this.actualizarUI();
    }

    limpiarCarrito() {
        this.items = [];
        this.restauranteId = null;
        this.restauranteNombre = '';
        localStorage.removeItem('carrito');
        this.actualizarUI();
    }

    calcularTotal() {
        return this.items.reduce((total, item) => total + (item.precio * item.cantidad), 0);
    }

    calcularCantidadTotal() {
        return this.items.reduce((total, item) => total + item.cantidad, 0);
    }

    actualizarUI() {
        this.actualizarContadorCarrito();
        this.actualizarContenidoCarrito();
    }

    actualizarContadorCarrito() {
        const contador = document.getElementById('cartCount');
        if (contador) {
            const total = this.calcularCantidadTotal();
            contador.textContent = total;
            contador.style.display = total > 0 ? 'flex' : 'none';
        }
    }

    actualizarContenidoCarrito() {
        const container = document.getElementById('cartItemsContainer');
        const footer = document.getElementById('cartFooter');
        const emptyMessage = document.getElementById('emptyCartMessage');
        
        if (!container) return;

        if (this.items.length === 0) {
            container.innerHTML = `
                <div id="emptyCartMessage" class="text-center py-5">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p class="text-muted">Tu carrito está vacío</p>
                    <p class="text-muted small">Agrega productos del menú</p>
                </div>
            `;
            if (footer) footer.style.display = 'none';
            return;
        }

        const itemsHTML = this.items.map(item => `
            <div class="cart-item" data-product-id="${item.id}">
                <img src="${item.imagen}" alt="${item.nombre}">
                <div class="cart-item-info">
                    <h4>${item.nombre}</h4>
                    <p class="cart-item-price">$${item.precio.toFixed(2)}</p>
                </div>
                <div class="cart-item-controls">
                    <button class="btn-decrease">-</button>
                    <span class="quantity">${item.cantidad}</span>
                    <button class="btn-increase">+</button>
                    <button class="btn-remove"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `).join('');

        container.innerHTML = itemsHTML;

        // Actualizar totales
        const subtotal = this.calcularTotal();
        document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
        document.getElementById('total').textContent = `$${subtotal.toFixed(2)}`;
        
        if (footer) footer.style.display = 'block';
    }

    mostrarNotificacion(mensaje) {
        // Crear notificación temporal
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.textContent = mensaje;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 3000;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 2000);
    }
}

// Funciones globales para el carrito
function openCart() {
    document.getElementById('cartModal').classList.add('show');
    document.getElementById('cartOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeCart() {
    document.getElementById('cartModal').classList.remove('show');
    document.getElementById('cartOverlay').classList.remove('show');
    document.body.style.overflow = 'auto';
}

function goToConfirm() {
    if (carrito.items.length === 0) {
        alert('Tu carrito está vacío');
        return;
    }
    
    window.location.href = 'restaurantes/confirmar-pedido';
}

// Inicializar carrito cuando se carga la página
let carrito;
document.addEventListener('DOMContentLoaded', () => {
    carrito = new Carrito();
});

// Agregar estilos CSS para las animaciones
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    .cart-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #eee;
        gap: 12px;
    }
    
    .cart-item img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .cart-item-info {
        flex: 1;
    }
    
    .cart-item-info h4 {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 4px 0;
        color: #333;
    }
    
    .cart-item-price {
        color: #d32323;
        font-weight: 600;
        margin: 0;
    }
    
    .cart-item-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-decrease, .btn-increase {
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
    }
    
    .btn-decrease:hover, .btn-increase:hover {
        background: #f8f9fa;
    }
    
    .quantity {
        min-width: 30px;
        text-align: center;
        font-weight: 600;
    }
    
    .btn-remove {
        background: #dc3545;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-remove:hover {
        background: #c82333;
    }
    
    .view-container {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .cart-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .cart-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }
    
    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #666;
    }
    
    .cart-items {
        flex: 1;
        overflow-y: auto;
    }
    
    .cart-footer {
        padding: 20px;
        border-top: 1px solid #eee;
        background: white;
    }
    
    .cart-subtotal, .cart-total {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .cart-total {
        font-weight: 700;
        font-size: 1.2rem;
        padding-top: 10px;
        border-top: 1px solid #eee;
    }
    
    .cart-total-price {
        color: #d32323;
    }
    
    .btn-confirm {
        width: 100%;
        background: #d32323;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        margin-top: 15px;
        cursor: pointer;
    }
    
    .btn-confirm:hover {
        background: #b91e1e;
    }
`;
document.head.appendChild(style);