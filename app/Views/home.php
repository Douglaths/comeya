<?= $this->include('templates/header') ?>

  <!-- Carrusel de Promociones -->
  <div id="promoCarouselSmall" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" style="height: 120px;">
    <div class="carousel-inner h-100">
      <div class="carousel-item active h-100">
        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?w=1200&h=120&fit=crop" class="d-block w-100 h-100" style="object-fit: cover;" alt="Promoción Pizza">
      </div>
      <div class="carousel-item h-100">
        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=1200&h=120&fit=crop" class="d-block w-100 h-100" style="object-fit: cover;" alt="Promoción Tacos">
      </div>
      <div class="carousel-item h-100">
        <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=1200&h=120&fit=crop" class="d-block w-100 h-100" style="object-fit: cover;" alt="Promoción Sushi">
      </div>
    </div>
  </div>

  <!-- Filtros y Búsqueda -->
  <section class="py-4 bg-light">
    <div class="container">
      <div class="row g-3 align-items-center">
        <div class="col-md-6">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" placeholder="Buscar restaurantes...">
          </div>
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option>Todas las ciudades</option>
            <option>Madrid</option>
            <option>Sevilla</option>
            <option>Barcelona</option>
            <option>Valencia</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option>Todos los tipos</option>
            <option>Parrilla</option>
            <option>Italiana</option>
            <option>Japonesa</option>
            <option>Mexicana</option>
          </select>
        </div>
      </div>
    </div>
  </section>

  <!-- Restaurantes Disponibles -->
  <section class="py-5">
    <div class="container">
      <h2 class="mb-4">Restaurantes Disponibles</h2>
      <p class="text-muted mb-4">4 restaurantes</p>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

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
  </section>

<?= $this->include('templates/footer') ?>