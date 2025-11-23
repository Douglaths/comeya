
<?= $this->include('Restaurantes/templates/header') ?>

    <div class="container">
        <?php if (isset($destacados) && !empty($destacados)): ?>
        <div class="destacados-title">
            <i class="fas fa-star star-icon"></i>
            Destacados
        </div>
        <div class="destacados-container position-relative">
            <div class="destacados-scroll" id="destacadosScroll">
                <?php foreach ($destacados as $destacado): ?>
                    <div class="destacado-item">
                        <div class="card card-destacado">
                            <span class="badge-destacado">Destacado</span>
                            <img src="<?= $destacado['imagen'] ? base_url('uploads/' . $destacado['imagen']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&h=300&fit=crop' ?>" alt="<?= esc($destacado['nombre']) ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?= esc($destacado['nombre']) ?></h3>
                                <p class="card-text"><?= esc($destacado['descripcion']) ?></p>
                                <div class="price">$<?= number_format($destacado['precio'], 2) ?></div>
                                <button class="btn-agregar" 
                                        data-id="<?= $destacado['id'] ?>"
                                        data-nombre="<?= esc($destacado['nombre']) ?>"
                                        data-precio="<?= $destacado['precio'] ?>"
                                        data-imagen="<?= $destacado['imagen'] ? base_url('uploads/' . $destacado['imagen']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100&h=100&fit=crop' ?>"
                                        data-restaurante-id="<?= isset($empresa) ? $empresa['id'] : $nombreRestaurante ?>"
                                        data-restaurante-nombre="<?= isset($empresa) ? esc($empresa['nombre']) : ucfirst(str_replace('-', ' ', $nombreRestaurante)) ?>">
                                    <i class="fas fa-plus"></i> Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="destacados-prev" onclick="scrollDestacados('prev')">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="destacados-next" onclick="scrollDestacados('next')">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <?php endif; ?>

        <ul class="nav nav-tabs">
            <?php $first = true; foreach ($productosPorCategoria as $categoria => $items): ?>
            <li class="nav-item">
                <a class="nav-link <?= $first ? 'active' : '' ?>" data-bs-toggle="tab" href="#<?= strtolower(str_replace([' ', 'á', 'é', 'í', 'ó', 'ú', 'ñ'], ['-', 'a', 'e', 'i', 'o', 'u', 'n'], $categoria)) ?>"><?= esc($categoria) ?></a>
            </li>
            <?php $first = false; endforeach; ?>
        </ul>

        <div class="tab-content">
            <?php $first = true; foreach ($productosPorCategoria as $categoria => $items): ?>
            <div class="tab-pane fade <?= $first ? 'show active' : '' ?>" id="<?= strtolower(str_replace([' ', 'á', 'é', 'í', 'ó', 'ú', 'ñ'], ['-', 'a', 'e', 'i', 'o', 'u', 'n'], $categoria)) ?>">
                <div class="section-title"><?= esc($categoria) ?></div>
                
                <?php foreach ($items as $producto): ?>
                <div class="menu-item">
                    <img src="<?= $producto['imagen'] ? base_url('uploads/' . $producto['imagen']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100&h=100&fit=crop' ?>" alt="<?= esc($producto['nombre']) ?>">
                    <div class="menu-item-content">
                        <div class="menu-item-title"><?= esc($producto['nombre']) ?></div>
                        <div class="menu-item-description"><?= esc($producto['descripcion']) ?></div>
                        <button class="btn-agregar" 
                                data-id="<?= $producto['id'] ?>"
                                data-nombre="<?= esc($producto['nombre']) ?>"
                                data-precio="<?= $producto['precio'] ?>"
                                data-imagen="<?= $producto['imagen'] ? base_url('uploads/' . $producto['imagen']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100&h=100&fit=crop' ?>"
                                data-restaurante-id="<?= isset($empresa) ? $empresa['id'] : $nombreRestaurante ?>"
                                data-restaurante-nombre="<?= isset($empresa) ? esc($empresa['nombre']) : ucfirst(str_replace('-', ' ', $nombreRestaurante)) ?>">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">$<?= number_format($producto['precio'], 0, ',', '.') ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php $first = false; endforeach; ?>
        </div>
    </div>

    <!-- Botón flotante del carrito -->
    <div class="cart-float-btn" onclick="openCart()">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count" id="cartCount">0</span>
    </div>

    <!-- Overlay del carrito -->
    <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
    
    <!-- Carrito deslizante -->
    <div id="cartModal">
        <div class="view-container">
            <div class="cart-header">
                <h2 class="cart-title">Tu Pedido</h2>
                <button class="close-btn" onclick="closeCart()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="cart-items" id="cartItemsContainer">
                <div id="emptyCartMessage" class="text-center py-5">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p class="text-muted">Tu carrito está vacío</p>
                    <p class="text-muted small">Agrega productos del menú</p>
                </div>
            </div>

            <div class="cart-footer" id="cartFooter" style="display: none;">
                <div class="cart-subtotal">
                    <span>Subtotal</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div class="cart-total">
                    <span class="cart-total-label">Total</span>
                    <span class="cart-total-price" id="total">$0.00</span>
                </div>
                <button class="btn-confirm" onclick="goToConfirm()">Confirmar Pedido</button>
            </div>
        </div>
    </div>



<?= $this->include('templates/footer') ?>