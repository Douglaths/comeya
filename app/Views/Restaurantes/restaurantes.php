
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row g-3">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#entrantes">Entrantes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#carnes">Carnes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#acompañamientos">Acompañamientos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#postres">Postres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#bebidas">Bebidas</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="entrantes">
                <div class="section-title">Para empezar tu experiencia</div>
                
                <div class="menu-item">
                    <div style="position: relative;">
                        <span class="badge-popular">Popular</span>
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=100&h=100&fit=crop" alt="Provoleta Argentina">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-title">Provoleta Argentina</div>
                        <div class="menu-item-description">Queso provolone fundido a la parrilla con orégano y aceite de oliva</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€8.50</div>
                </div>

                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1599974229858-c3bb1fc350e6?w=100&h=100&fit=crop" alt="Empanadas Criollas">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Empanadas Criollas</div>
                        <div class="menu-item-description">Trío de empanadas artesanales: carne, pollo y verduras</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€9.90</div>
                </div>
            </div>

            <div class="tab-pane fade" id="carnes">
                <div class="section-title">Lo mejor de nuestra parrilla</div>
                
                <div class="menu-item">
                    <div style="position: relative;">
                        <span class="badge-popular">Popular</span>
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?w=100&h=100&fit=crop" alt="Bife de Chorizo">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-title">Bife de Chorizo Premium</div>
                        <div class="menu-item-description">Corte argentino 350g, madurado 21 días. El rey de la parrilla</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€24.90</div>
                </div>

                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1558030006-450675393462?w=100&h=100&fit=crop" alt="Entraña">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Entraña a la Parrilla</div>
                        <div class="menu-item-description">Corte jugoso y sabroso, ideal para compartir. 400g</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€22.50</div>
                </div>

                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=100&h=100&fit=crop" alt="Asado de Tira">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Asado de Tira</div>
                        <div class="menu-item-description">Costillas de res con hueso, cocción lenta a la parrilla</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€19.90</div>
                </div>
            </div>

            <div class="tab-pane fade" id="acompañamientos">
                <div class="section-title">Complementa tu plato</div>
                
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1518013431117-eb1465fa5752?w=100&h=100&fit=crop" alt="Papas Fritas">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Papas Fritas Caseras</div>
                        <div class="menu-item-description">Papas cortadas a mano, fritas en aceite de girasol</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€4.50</div>
                </div>

                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=100&h=100&fit=crop" alt="Ensalada Mixta">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Ensalada Mixta</div>
                        <div class="menu-item-description">Lechuga, tomate, cebolla y aceitunas con vinagreta</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€6.90</div>
                </div>
            </div>

            <div class="tab-pane fade" id="postres">
                <div class="section-title">Para terminar con dulzura</div>
                
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?w=100&h=100&fit=crop" alt="Flan Casero">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Flan Casero</div>
                        <div class="menu-item-description">Flan tradicional con dulce de leche y crema chantilly</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€5.50</div>
                </div>

                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=100&h=100&fit=crop" alt="Tiramisú">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Tiramisú</div>
                        <div class="menu-item-description">Postre italiano con café, mascarpone y cacao</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€6.90</div>
                </div>
            </div>

            <div class="tab-pane fade" id="bebidas">
                <div class="section-title">Bebidas seleccionadas</div>
                
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1437418747212-8d9709afab22?w=100&h=100&fit=crop" alt="Vino Tinto">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Vino Tinto Reserva</div>
                        <div class="menu-item-description">Malbec argentino, ideal para acompañar carnes</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€18.90</div>
                </div>

                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1544145945-f90425340c7e?w=100&h=100&fit=crop" alt="Cerveza Artesanal">
                    <div class="menu-item-content">
                        <div class="menu-item-title">Cerveza Artesanal</div>
                        <div class="menu-item-description">Cerveza rubia artesanal, refrescante y ligera</div>
                        <button class="btn-agregar">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                    <div class="menu-item-price">€4.50</div>
                </div>
            </div>
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
        <?= $this->include('Restaurantes/templates/carrito') ?>
    </div>

    <script>
        let cartItems = [];
        let cartCount = 0;

        function addToCart(name, price, image) {
            cartItems.push({name, price, image});
            cartCount++;
            document.getElementById('cartCount').textContent = cartCount;
        }

        function openCart() {
            document.getElementById('cartModal').classList.add('show');
            document.getElementById('cartOverlay').classList.add('show');
        }

        function closeCart() {
            document.getElementById('cartModal').classList.remove('show');
            document.getElementById('cartOverlay').classList.remove('show');
        }

        // Agregar event listeners a todos los botones "Agregar"
        document.addEventListener('DOMContentLoaded', function() {
            const addButtons = document.querySelectorAll('.btn-agregar');
            addButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    const menuItem = this.closest('.menu-item');
                    const name = menuItem.querySelector('.menu-item-title').textContent;
                    const price = menuItem.querySelector('.menu-item-price').textContent;
                    const image = menuItem.querySelector('img').src;
                    
                    addToCart(name, price, image);
                    
                    // Mostrar feedback visual
                    this.innerHTML = '<i class="fas fa-check"></i> Agregado';
                    this.style.backgroundColor = '#28a745';
                    
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-plus"></i> Agregar';
                        this.style.backgroundColor = '';
                    }, 1500);
                });
            });
        });
    </script>

<?= $this->include('templates/footer') ?>