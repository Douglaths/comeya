<!-- Contenido Principal con Sidebar -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <!-- Sidebar de Filtros -->
      <div class="col-lg-4">
        <div class="bg-white p-5 rounded-3 shadow-sm sticky-top" style="top: 20px; border: 1px solid #f0f0f0;">
          <!-- Búsqueda -->
          <div class="mb-5">
            <h4 class="fw-bold mb-4" style="color: #ff6b35; font-size: 1.5rem;">Buscar</h4>
            <div class="input-group" style="height: 50px;">
              <span class="input-group-text bg-white border-end-0" style="color: #ff6b35;"><i class="bi bi-search"></i></span>
              <input type="text" class="form-control border-start-0" placeholder="Buscar restaurantes..." style="font-size: 18px;">
            </div>
          </div>
          
          <!-- Promociones -->
          <div class="mb-5">
            <h4 class="fw-bold mb-4" style="color: #ff6b35; font-size: 1.5rem;">Promociones</h4>
            <div class="d-grid gap-4">
              <label class="btn btn-outline-secondary text-start p-4" style="border-radius: 15px; font-size: 16px;">
                <input type="radio" name="promo" class="form-check-input me-3" style="accent-color: #ff6b35;">
                <span class="badge me-2" style="background-color: #ff6b35;">2x1</span>Ofertas 2x1
              </label>
              <label class="btn btn-outline-secondary text-start p-4" style="border-radius: 15px; font-size: 16px;">
                <input type="radio" name="promo" class="form-check-input me-3" style="accent-color: #ff6b35;">
                <span class="badge bg-success me-2">GRATIS</span>Envío Gratis
              </label>
              <label class="btn btn-outline-secondary text-start p-4" style="border-radius: 15px; font-size: 16px;">
                <input type="radio" name="promo" class="form-check-input me-3" style="accent-color: #ff6b35;">
                <span class="badge me-2" style="background-color: #ff6b35;">%</span>Descuentos
              </label>
            </div>
          </div>
          
          <!-- Ciudades -->
          <div class="mb-5">
            <h4 class="fw-bold mb-4" style="color: #ff6b35; font-size: 1.5rem;">Ciudades</h4>
            <div class="d-grid gap-3">
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="ciudad" class="form-check-input me-3" style="accent-color: #ff6b35;">Madrid
              </label>
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="ciudad" class="form-check-input me-3" style="accent-color: #ff6b35;">Sevilla
              </label>
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="ciudad" class="form-check-input me-3" style="accent-color: #ff6b35;">Barcelona
              </label>
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="ciudad" class="form-check-input me-3" style="accent-color: #ff6b35;">Valencia
              </label>
            </div>
          </div>
          
          <!-- Tipos de Comida -->
          <div class="mb-4">
            <h4 class="fw-bold mb-4" style="color: #ff6b35; font-size: 1.5rem;">Tipo de Comida</h4>
            <div class="d-grid gap-3">
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="comida" class="form-check-input me-3" style="accent-color: #ff6b35;">Parrilla
              </label>
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="comida" class="form-check-input me-3" style="accent-color: #ff6b35;">Italiana
              </label>
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="comida" class="form-check-input me-3" style="accent-color: #ff6b35;">Japonesa
              </label>
              <label class="btn btn-outline-light text-start p-4" style="border-radius: 15px; border-color: #e0e0e0; color: #333; font-size: 16px;">
                <input type="radio" name="comida" class="form-check-input me-3" style="accent-color: #ff6b35;">Mexicana
              </label>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Contenido Principal -->
      <div class="col-lg-8">
        <h2 class="mb-4 fw-bold">Restaurantes Disponibles</h2>
        <p class="text-muted mb-4">4 restaurantes</p>