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
  
  <!-- Contenido Principal -->
  <section class="py-4">
    <div class="container">
      <div class="row">
        <!-- Sidebar de Filtros -->
        <div class="col-lg-3">
          <div class="bg-white p-2 p-lg-4 rounded shadow-sm sticky-top" style="top: 20px;">
            <form method="GET" id="filterForm">
              <!-- Búsqueda -->
              <div class="mb-2 mb-lg-4">
                <h6 class="fw-bold mb-2 mb-lg-3 fs-6 fs-lg-5">Buscar</h6>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                  <input type="text" class="form-control border-start-0" name="search" placeholder="Buscar restaurantes..." value="<?= esc($filters['search'] ?? '') ?>">
                </div>
              </div>
              
              <!-- Promociones -->
              <div class="mb-2 mb-lg-4">
                <h6 class="fw-bold mb-2 mb-lg-3 text-danger fs-6 fs-lg-5"><i class="bi bi-fire me-1 me-lg-2"></i>Promociones</h6>
                <div class="form-check mb-1 mb-lg-2">
                  <input class="form-check-input" type="checkbox" name="oferta_2x1" value="1" id="promo2x1" <?= !empty($filters['oferta_2x1']) ? 'checked' : '' ?>>
                  <label class="form-check-label small d-lg-block" for="promo2x1">
                    <span class="badge bg-danger me-1 me-lg-2" style="font-size: 0.6rem;">2x1</span>Ofertas 2x1
                  </label>
                </div>
                <div class="form-check mb-1 mb-lg-2">
                  <input class="form-check-input" type="checkbox" name="envio_gratis" value="1" id="promoGratis" <?= !empty($filters['envio_gratis']) ? 'checked' : '' ?>>
                  <label class="form-check-label small d-lg-block" for="promoGratis">
                    <span class="badge bg-success me-1 me-lg-2" style="font-size: 0.6rem;">GRATIS</span>Envío Gratis
                  </label>
                </div>
                <div class="form-check mb-1 mb-lg-2">
                  <input class="form-check-input" type="checkbox" name="descuento_activo" value="1" id="promoDescuento" <?= !empty($filters['descuento_activo']) ? 'checked' : '' ?>>
                  <label class="form-check-label small d-lg-block" for="promoDescuento">
                    <span class="badge bg-warning text-dark me-1 me-lg-2" style="font-size: 0.6rem;">%</span>Descuentos
                  </label>
                </div>
              </div>
              
              <!-- Ciudades -->
              <div class="mb-2 mb-lg-4">
                <h6 class="fw-bold mb-2 mb-lg-3 fs-6 fs-lg-5"><i class="bi bi-geo-alt me-1 me-lg-2"></i>Ciudades</h6>
                <?php foreach ($ciudades as $ciudad_item): ?>
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" name="ciudad[]" value="<?= esc($ciudad_item['ciudad']) ?>" id="ciudad_<?= esc($ciudad_item['ciudad']) ?>" <?= (isset($filters['ciudad']) && is_array($filters['ciudad']) && in_array($ciudad_item['ciudad'], $filters['ciudad'])) ? 'checked' : '' ?>>
                    <label class="form-check-label small d-lg-block" for="ciudad_<?= esc($ciudad_item['ciudad']) ?>"><?= esc($ciudad_item['ciudad']) ?></label>
                  </div>
                <?php endforeach; ?>
              </div>
              
              <!-- Tipos de Comida -->
              <?php if (!empty($categorias)): ?>
              <div class="mb-2 mb-lg-4">
                <h6 class="fw-bold mb-2 mb-lg-3 fs-6 fs-lg-5"><i class="bi bi-cup-hot me-1 me-lg-2"></i>Tipo de Comida</h6>
                <?php foreach ($categorias as $categoria_item): ?>
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" name="categoria[]" value="<?= esc($categoria_item['categoria_comida']) ?>" id="cat_<?= esc($categoria_item['categoria_comida']) ?>" <?= (isset($filters['categoria']) && is_array($filters['categoria']) && in_array($categoria_item['categoria_comida'], $filters['categoria'])) ? 'checked' : '' ?>>
                    <label class="form-check-label small d-lg-block" for="cat_<?= esc($categoria_item['categoria_comida']) ?>">
                      <i class="bi bi-circle-fill me-1 text-primary"></i><?= esc($categoria_item['categoria_comida']) ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
              
              <button type="button" id="clearFilters" class="btn btn-outline-secondary btn-sm w-100">Limpiar filtros</button>
            </form>
          </div>
        </div>
        
        <!-- Contenido de Restaurantes -->
        <div class="col-lg-9">
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        <?php if (empty($restaurantes)): ?>
          <div class="col-12">
            <div class="text-center py-5">
              <h5 class="text-muted">No se encontraron restaurantes</h5>
              <p class="text-muted">Intenta con otros filtros de búsqueda</p>
            </div>
          </div>
        <?php else: ?>
          <?php foreach ($restaurantes as $restaurante): ?>
            <div class="col">
              <div class="restaurant-card h-100 position-relative">
                <?php if ($restaurante['destacado']): ?>
                  <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2" style="z-index: 10;">Destacado</span>
                <?php endif; ?>
                <span class="badge badge-type" style="background-color: rgba(255, 255, 255, 0.8); color: #000; border-radius: 50px;">
                  <?= esc($restaurante['categoria_comida'] ?? ucfirst($restaurante['plan'])) ?>
                </span>
                <?php if (isset($restaurante['oferta_2x1']) && $restaurante['oferta_2x1']): ?>
                  <span class="badge bg-danger position-absolute top-0 start-0 m-2" style="z-index: 9;">2x1</span>
                <?php endif; ?>
                <?php if (isset($restaurante['envio_gratis']) && $restaurante['envio_gratis']): ?>
                  <span class="badge bg-success position-absolute" style="top: 40px; left: 8px; z-index: 9; font-size: 0.7rem;">Envío Gratis</span>
                <?php endif; ?>
                <img src="<?= !empty($restaurante['foto_presentacion']) ? base_url('uploads/' . $restaurante['foto_presentacion']) : 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400' ?>" class="restaurant-img w-100" alt="<?= esc($restaurante['nombre']) ?>">
                <div class="p-3">
                  <h5 class="fw-bold"><?= esc($restaurante['nombre']) ?></h5>
                  <p class="small text-muted mb-2"><?= esc($restaurante['descripcion'] ?? 'Deliciosa comida con los mejores ingredientes') ?></p>
                  <div class="mt-auto">
                    <p class="small text-muted mb-3">
                      <i class="bi bi-geo-alt-fill me-1"></i> <?= esc($restaurante['direccion']) ?>
                      <?php if ($restaurante['telefono']): ?>
                        <i class="bi bi-telephone-fill ms-3 me-1"></i> <?= esc($restaurante['telefono']) ?>
                      <?php endif; ?>
                    </p>
                    <a href="<?= base_url('/' . slugify($restaurante['nombre'])) ?>" class="btn btn-menu w-100 text-white">Ver Restaurante</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<?= $this->include('templates/footer') ?>