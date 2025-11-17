<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menús Digitales</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Iconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .hero-header {
      background-color: #ff6b35;
      color: white;
      padding: 3rem 0;
    }
    .btn-primary-custom {
      background-color: #fff;
      color: #ff6b35;
      font-weight: bold;
    }
    .btn-primary-custom:hover {
      background-color: #f0f0f0;
    }
    .restaurant-card {
      border: 1px solid #eee;
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.2s;
    }
    .restaurant-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .restaurant-img {
      height: 180px;
      object-fit: cover;
    }
    .badge-type {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 0.75rem;
      padding: 0.35em 0.65em;
    }
    .btn-menu {
      background-color: #ff3b30;
      border: none;
      font-weight: 600;
    }
    .btn-menu:hover {
      background-color: #e32d27;
    }
  </style>
</head>
<body>

  <!-- Header Hero -->
  <header class="hero-header text-center">
    <div class="container">
      <i class="bi bi-x-lg d-block mx-auto mb-3" style="font-size: 1.5rem;"></i>
      <h1 class="display-5 fw-bold">Menús Digitales para tu Restaurante</h1>
      <p class="lead">Moderniza tu negocio con menús digitales interactivos. Fácil de gestionar, perfecto para tus clientes.</p>
      <a href="#" class="btn btn-primary-custom px-4 py-2 rounded-pill">Comenzar Ahora</a>
    </div>
  </header>

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

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">

        <!-- Restaurante 1 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge bg-dark badge-type">Parrilla</span>
            <img src="https://images.unsplash.com/photo-1517248135467-2c7ed3da9f6b?w=500&h=300&fit=crop" class="restaurant-img w-100" alt="La Parrilla Dorada">
            <div class="p-3">
              <h5 class="fw-bold">La Parrilla Dorada</h5>
              <p class="small text-muted mb-2">Especialistas en carnes a la brasa y parrilla argentina</p>
              <p class="small mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Madrid</p>
              <p class="small mb-3"><i class="bi bi-telephone-fill text-primary"></i> +34 912 345 678</p>
              <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
            </div>
          </div>
        </div>

        <!-- Restaurante 2 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge bg-dark badge-type">Italiana</span>
            <img src="https://images.unsplash.com/photo-1574071318507-94d3e8f2a9b4?w=500&h=300&fit=crop" class="restaurant-img w-100" alt="Pizzería Bella Napoli">
            <div class="p-3">
              <h5 class="fw-bold">Pizzería Bella Napoli</h5>
              <p class="small text-muted mb-2">Pizza artesanal al horno de leña con recetas tradicionales napolitanas</p>
              <p class="small mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Sevilla</p>
              <p class="small mb-3"><i class="bi bi-telephone-fill text-primary"></i> +34 954 567 890</p>
              <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
            </div>
          </div>
        </div>

        <!-- Restaurante 3 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge bg-dark badge-type">Japonesa</span>
            <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=500&h=300&fit=crop" class="restaurant-img w-100" alt="Sushi Sakura">
            <div class="p-3">
              <h5 class="fw-bold">Sushi Sakura</h5>
              <p class="small text-muted mb-2">Auténtica cocina japonesa con los mejores ingredientes frescos</p>
              <p class="small mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Barcelona</p>
              <p class="small mb-3"><i class="bi bi-telephone-fill text-primary"></i> +34 933 456 789</p>
              <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
            </div>
          </div>
        </div>

        <!-- Restaurante 4 -->
        <div class="col">
          <div class="restaurant-card h-100 position-relative">
            <span class="badge bg-dark badge-type">Mexicana</span>
            <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500&h=300&fit=crop" class="restaurant-img w-100" alt="Tacos El Mariachi">
            <div class="p-3">
              <h5 class="fw-bold">Tacos El Mariachi</h5>
              <p class="small text-muted mb-2">Comida mexicana auténtica con sabores tradicionales</p>
              <p class="small mb-1"><i class="bi bi-geo-alt-fill text-danger"></i> Valencia</p>
              <p class="small mb-3"><i class="bi bi-telephone-fill text-primary"></i> +34 963 678 901</p>
              <a href="#" class="btn btn-menu w-100 text-white">Ver Menú Digital</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

<<<<<<< HEAD
  <!-- Bootstrap 5 JS (opcional, para interacciones) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
 

<?= $this->include('templates/footer') ?>
>>>>>>> e177b345ea60a3e9df2f77d31254603608b569d8
