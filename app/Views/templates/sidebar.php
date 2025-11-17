 <!-- Contenido Principal con Sidebar -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <!-- Sidebar de Filtros -->
        <div class="col-lg-3">
          <div class="bg-white p-4 rounded shadow-sm sticky-top" style="top: 20px;">
            <!-- Búsqueda -->
            <div class="mb-4">
              <h6 class="fw-bold mb-3">Buscar</h6>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Buscar restaurantes...">
              </div>
            </div>
            
            <!-- Promociones -->
            <div class="mb-4">
              <h6 class="fw-bold mb-3 text-danger"><i class="bi bi-fire me-2"></i>Promociones</h6>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="promo2x1">
                <label class="form-check-label" for="promo2x1">
                  <span class="badge bg-danger me-2">2x1</span>Ofertas 2x1
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="promoGratis">
                <label class="form-check-label" for="promoGratis">
                  <span class="badge bg-success me-2">GRATIS</span>Envío Gratis
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="promoDescuento">
                <label class="form-check-label" for="promoDescuento">
                  <span class="badge bg-warning text-dark me-2">%</span>Descuentos
                </label>
              </div>
            </div>
            
            <!-- Ciudades -->
            <div class="mb-4">
              <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt me-2"></i>Ciudades</h6>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="madrid">
                <label class="form-check-label" for="madrid">Madrid</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="sevilla">
                <label class="form-check-label" for="sevilla">Sevilla</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="barcelona">
                <label class="form-check-label" for="barcelona">Barcelona</label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="valencia">
                <label class="form-check-label" for="valencia">Valencia</label>
              </div>
            </div>
            
            <!-- Tipos de Comida -->
            <div class="mb-4">
              <h6 class="fw-bold mb-3"><i class="bi bi-cup-hot me-2"></i>Tipo de Comida</h6>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="parrilla">
                <label class="form-check-label" for="parrilla">
                  <i class="bi bi-fire me-1 text-danger"></i>Parrilla
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="italiana">
                <label class="form-check-label" for="italiana">
                  <i class="bi bi-circle-fill me-1 text-success"></i>Italiana
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="japonesa">
                <label class="form-check-label" for="japonesa">
                  <i class="bi bi-circle-fill me-1 text-info"></i>Japonesa
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="mexicana">
                <label class="form-check-label" for="mexicana">
                  <i class="bi bi-circle-fill me-1 text-warning"></i>Mexicana
                </label>
              </div>
            </div>
            
            <!-- Ofertas Especiales -->
            <div class="mb-4">
              <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-gift me-2"></i>Ofertas Especiales</h6>
              <div class="alert alert-warning p-2 mb-2">
                <small class="fw-bold"><i class="bi bi-lightning-fill me-1"></i>¡Bebida GRATIS!</small>
              </div>
              <div class="alert alert-success p-2 mb-2">
                <small class="fw-bold"><i class="bi bi-truck me-1"></i>Envío sin costo</small>
              </div>
              <div class="alert alert-info p-2 mb-2">
                <small class="fw-bold"><i class="bi bi-percent me-1"></i>Hasta 50% OFF</small>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Contenido Principal -->
        <div class="col-lg-9">
          <h2 class="mb-4 fw-bold">Restaurantes Disponibles</h2>
          <p class="text-muted mb-4">4 restaurantes</p>