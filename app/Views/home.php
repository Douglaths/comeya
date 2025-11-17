<?= $this->include('templates/header') ?>

  <!-- Carrusel de Promociones -->
  <section class="py-3 bg-light">
    <div class="container">
      <h5 class="mb-3">Promociones Especiales</h5>
      <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row g-3">
              <div class="col-md-4">
                <div class="card border-0 shadow-sm position-relative">
                  <span class="badge bg-danger position-absolute top-0 end-0 m-2 px-3 py-2" style="z-index: 10; font-size: 14px; border-radius: 20px;"><i class="bi bi-percent me-1"></i>2x1</span>
                  <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400&h=200&fit=crop" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Promoción Pizza">
                  <div class="card-body p-2">
                    <small class="text-muted">Pizza 2x1 - Solo hoy</small>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border-0 shadow-sm position-relative">
                  <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 px-3 py-2" style="z-index: 10; font-size: 14px; border-radius: 20px;"><i class="bi bi-percent me-1"></i>15% OFF</span>
                  <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&h=200&fit=crop" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Promoción Tacos">
                  <div class="card-body p-2">
                    <small class="text-muted">Tacos + Bebida - 15% OFF</small>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border-0 shadow-sm position-relative">
                  <span class="badge bg-success position-absolute top-0 end-0 m-2 px-3 py-2" style="z-index: 10; font-size: 14px; border-radius: 20px;"><i class="bi bi-percent me-1"></i>20% OFF</span>
                  <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=400&h=200&fit=crop" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Promoción Sushi">
                  <div class="card-body p-2">
                    <small class="text-muted">Sushi Premium - 20% OFF</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row g-3">
              <div class="col-md-4">
                <div class="card border-0 shadow-sm position-relative">
                  <span class="badge bg-info position-absolute top-0 end-0 m-2 px-3 py-2" style="z-index: 10; font-size: 14px; border-radius: 20px;"><i class="bi bi-percent me-1"></i>25% OFF</span>
                  <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&h=200&fit=crop" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Promoción Pasta">
                  <div class="card-body p-2">
                    <small class="text-muted">Pasta Fresca - 25% OFF</small>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border-0 shadow-sm position-relative">
                  <span class="badge bg-primary position-absolute top-0 end-0 m-2 px-3 py-2" style="z-index: 10; font-size: 14px; border-radius: 20px;"><i class="bi bi-gift me-1"></i>GRATIS</span>
                  <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=200&fit=crop" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Promoción Burger">
                  <div class="card-body p-2">
                    <small class="text-muted">Burger + Papas - Gratis</small>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border-0 shadow-sm position-relative">
                  <span class="badge bg-success position-absolute top-0 end-0 m-2 px-3 py-2" style="z-index: 10; font-size: 14px; border-radius: 20px;"><i class="bi bi-percent me-1"></i>30% OFF</span>
                  <img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=400&h=200&fit=crop" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Promoción Ensalada">
                  <div class="card-body p-2">
                    <small class="text-muted">Ensaladas Saludables - 30% OFF</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <?= $this->include('templates/sidebar') ?>
 

          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">

        <!-- Restaurante 1 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge badge-type" style="background-color: rgba(255, 255, 255, 0.8); color: #000; border-radius: 50px;">Parrilla</span>
            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400" class="restaurant-img w-100" alt="La Parrilla Dorada">
            <div class="p-3">
              <h5 class="fw-bold">La Parrilla Dorada</h5>
              <p class="small text-muted mb-2">Especialistas en carnes a la brasa y parrilla argentina</p>
              <div class="mt-auto">
                <p class="small text-muted mb-3"><i class="bi bi-geo-alt-fill me-1"></i> Madrid <i class="bi bi-telephone-fill ms-3 me-1"></i> +34 912 345 678</p>
                <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Restaurante 2 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge badge-type" style="background-color: rgba(255, 255, 255, 0.8); color: #000; border-radius: 50px;">Italiana</span>
            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400" class="restaurant-img w-100" alt="Pizzería Bella Napoli">
            <div class="p-3">
              <h5 class="fw-bold">Pizzería Bella Napoli</h5>
              <p class="small text-muted mb-2">Pizza artesanal al horno de leña con recetas tradicionales napolitanas</p>
              <div class="mt-auto">
                <p class="small text-muted mb-3"><i class="bi bi-geo-alt-fill me-1"></i> Sevilla <i class="bi bi-telephone-fill ms-3 me-1"></i> +34 954 567 890</p>
                <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Restaurante 3 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge badge-type" style="background-color: rgba(255, 255, 255, 0.8); color: #000; border-radius: 50px;">Japonesa</span>
            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400" class="restaurant-img w-100" alt="Sushi Sakura">
            <div class="p-3">
              <h5 class="fw-bold">Sushi Sakura</h5>
              <p class="small text-muted mb-2">Auténtica cocina japonesa con los mejores ingredientes frescos</p>
              <div class="mt-auto">
                <p class="small text-muted mb-3"><i class="bi bi-geo-alt-fill me-1"></i> Barcelona <i class="bi bi-telephone-fill ms-3 me-1"></i> +34 933 456 789</p>
                <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Restaurante 4 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge badge-type" style="background-color: rgba(255, 255, 255, 0.8); color: #000; border-radius: 50px;">Mexicana</span>
            <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500&h=300&fit=crop" class="restaurant-img w-100" alt="Tacos El Mariachi">
            <div class="p-3">
              <h5 class="fw-bold">Tacos El Mariachi</h5>
              <p class="small text-muted mb-2">Comida mexicana auténtica con sabores tradicionales</p>
              <div class="mt-auto">
                <p class="small text-muted mb-3"><i class="bi bi-geo-alt-fill me-1"></i> Valencia <i class="bi bi-telephone-fill ms-3 me-1"></i> +34 963 678 901</p>
                <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
              </div>
            </div>
          </div>
        </div>

          </div>
        </div>
      </div>
    </div>
  </section>

<?= $this->include('templates/footer') ?>