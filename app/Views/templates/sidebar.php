 <!-- Contenido Principal con Sidebar -->
  <section class="py-3 py-lg-5">
    <div class="container">
      <div class="row">
        <!-- Sidebar de Filtros -->
        <div class="col-lg-3">
          <div class="bg-white p-2 p-lg-4 rounded shadow-sm sticky-top" style="top: 20px;">
            <!-- Búsqueda -->
            <div class="mb-2 mb-lg-4">
              <h6 class="fw-bold mb-2 mb-lg-3 fs-6 fs-lg-5">Buscar</h6>
              <div class="input-group input-group-sm d-lg-none">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Buscar...">
              </div>
              <div class="input-group d-none d-lg-flex">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0" placeholder="Buscar restaurantes...">
              </div>
            </div>
            
            <!-- Promociones -->
            <div class="mb-2 mb-lg-4">
              <h6 class="fw-bold mb-2 mb-lg-3 text-danger fs-6 fs-lg-5"><i class="bi bi-fire me-1 me-lg-2"></i>Promociones</h6>
              <div class="form-check mb-1 mb-lg-2">
                <input class="form-check-input" type="checkbox" id="promo2x1">
                <label class="form-check-label small d-lg-block" for="promo2x1">
                  <span class="badge bg-danger me-1 me-lg-2" style="font-size: 0.6rem;">2x1</span><span class="d-none d-lg-inline">Ofertas </span>2x1
                </label>
              </div>
              <div class="form-check mb-1 mb-lg-2">
                <input class="form-check-input" type="checkbox" id="promoGratis">
                <label class="form-check-label small d-lg-block" for="promoGratis">
                  <span class="badge bg-success me-1 me-lg-2" style="font-size: 0.6rem;">GRATIS</span>Envío Gratis
                </label>
              </div>
              <div class="form-check mb-1 mb-lg-2">
                <input class="form-check-input" type="checkbox" id="promoDescuento">
                <label class="form-check-label small d-lg-block" for="promoDescuento">
                  <span class="badge bg-warning text-dark me-1 me-lg-2" style="font-size: 0.6rem;">%</span>Descuentos
                </label>
              </div>
            </div>
            
            <!-- Ciudades -->
            <div class="mb-2 mb-lg-4">
              <h6 class="fw-bold mb-2 mb-lg-3 fs-6 fs-lg-5"><i class="bi bi-geo-alt me-1 me-lg-2"></i>Ciudades</h6>
              <div class="row row-cols-2 row-cols-lg-1 g-1 g-lg-0">
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="madrid">
                    <label class="form-check-label small d-lg-block" for="madrid">Madrid</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="sevilla">
                    <label class="form-check-label small d-lg-block" for="sevilla">Sevilla</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="barcelona">
                    <label class="form-check-label small d-lg-block" for="barcelona">Barcelona</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="valencia">
                    <label class="form-check-label small d-lg-block" for="valencia">Valencia</label>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Tipos de Comida -->
            <div class="mb-2 mb-lg-4">
              <h6 class="fw-bold mb-2 mb-lg-3 fs-6 fs-lg-5"><i class="bi bi-cup-hot me-1 me-lg-2"></i>Tipo de Comida</h6>
              <div class="row row-cols-2 row-cols-lg-1 g-1 g-lg-0">
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="parrilla">
                    <label class="form-check-label small d-lg-block" for="parrilla">
                      <i class="bi bi-fire me-1 text-danger"></i>Parrilla
                    </label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="italiana">
                    <label class="form-check-label small d-lg-block" for="italiana">
                      <i class="bi bi-circle-fill me-1 text-success"></i>Italiana
                    </label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="japonesa">
                    <label class="form-check-label small d-lg-block" for="japonesa">
                      <i class="bi bi-circle-fill me-1 text-info"></i>Japonesa
                    </label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-check mb-1 mb-lg-2">
                    <input class="form-check-input" type="checkbox" id="mexicana">
                    <label class="form-check-label small d-lg-block" for="mexicana">
                      <i class="bi bi-circle-fill me-1 text-warning"></i>Mexicana
                    </label>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Ofertas Especiales -->
            <div class="mb-2 mb-lg-4">
              <h6 class="fw-bold mb-2 mb-lg-3 text-primary fs-6 fs-lg-5"><i class="bi bi-gift me-1 me-lg-2"></i>Ofertas Especiales</h6>
              <div class="d-flex d-lg-block flex-wrap gap-1">
                <div class="alert alert-warning p-1 p-lg-2 mb-1 mb-lg-2 flex-fill">
                  <small class="fw-bold text-center d-block d-lg-inline"><i class="bi bi-lightning-fill me-1"></i><span class="d-none d-lg-inline">¡</span>Bebida GRATIS<span class="d-none d-lg-inline">!</span></small>
                </div>
                <div class="alert alert-success p-1 p-lg-2 mb-1 mb-lg-2 flex-fill">
                  <small class="fw-bold text-center d-block d-lg-inline"><i class="bi bi-truck me-1"></i>Envío <span class="d-none d-lg-inline">sin costo</span><span class="d-lg-none">gratis</span></small>
                </div>
                <div class="alert alert-info p-1 p-lg-2 mb-1 mb-lg-2 flex-fill">
                  <small class="fw-bold text-center d-block d-lg-inline"><i class="bi bi-percent me-1"></i><span class="d-none d-lg-inline">Hasta </span>50% OFF</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Contenido Principal -->
        <div class="col-lg-9">
          <h2 class="mb-4 fw-bold">Restaurantes Disponibles</h2>
          <p class="text-muted mb-4">4 restaurantes</p>