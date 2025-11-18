
<?= $this->include('Restaurantes/templates/header') ?>

    <div class="container">
        <div class="destacados-title">
            <i class="fas fa-star star-icon"></i>
            Destacados
        </div>
        <div id="destacadosCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card card-destacado">
                                <span class="badge-destacado">Destacado</span>
                                <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&h=300&fit=crop" alt="Provoleta Argentina">
                                <div class="card-body">
                                    <h3 class="card-title">Provoleta Argentina</h3>
                                    <p class="card-text">Queso provolone fundido a la parrilla con orégano y aceite de oliva</p>
                                    <div class="price">$8.50</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-destacado">
                                <span class="badge-destacado">Destacado</span>
                                <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=500&h=300&fit=crop" alt="Bife de Chorizo Premium">
                                <div class="card-body">
                                    <h3 class="card-title">Bife de Chorizo Premium</h3>
                                    <p class="card-text">Corte argentino 350g, madurado 21 días. El rey de la parrilla</p>
                                    <div class="price">$24.90</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-destacado">
                                <span class="badge-destacado">Destacado</span>
                                <img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=500&h=300&fit=crop" alt="Ensalada Gourmet">
                                <div class="card-body">
                                    <h3 class="card-title">Ensalada Gourmet</h3>
                                    <p class="card-text">Mix de hojas verdes, queso de cabra, nueces y vinagreta de miel</p>
                                    <div class="price">$12.90</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card card-destacado">
                                <span class="badge-destacado">Destacado</span>
                                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500&h=300&fit=crop" alt="Tacos Especiales">
                                <div class="card-body">
                                    <h3 class="card-title">Tacos Especiales</h3>
                                    <p class="card-text">Trio de tacos con carne asada, pollo y carnitas con guacamole</p>
                                    <div class="price">$16.50</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-destacado">
                                <span class="badge-destacado">Destacado</span>
                                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=500&h=300&fit=crop" alt="Pasta Fresca">
                                <div class="card-body">
                                    <h3 class="card-title">Pasta Fresca</h3>
                                    <p class="card-text">Pasta artesanal con salsa de tomate y albahaca fresca</p>
                                    <div class="price">$14.90</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-destacado">
                                <span class="badge-destacado">Destacado</span>
                                <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&h=300&fit=crop" alt="Burger Gourmet">
                                <div class="card-body">
                                    <h3 class="card-title">Burger Gourmet</h3>
                                    <p class="card-text">Hamburguesa artesanal con carne angus y papas fritas</p>
                                    <div class="price">$18.50</div>
as                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#destacadosCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#destacadosCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>

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