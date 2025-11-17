<?= $this->include('Dashboard/templates/header') ?>
<body class="">
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>

    <?= $this->include('Dashboard/templates/navbar') ?>

    <div class="content-page">
        <main class="main-content">
            <div class="conatiner-fluid content-inner mt-5 py-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                        <h2>Crear Nuevo Plan</h2>
                        <a href="<?= base_url('public/superadmin/contabilidad/planes') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre del Plan *</label>
                                        <input type="text" class="form-control" name="nombre" required 
                                               placeholder="Ej: Plan Básico, Plan Pro, etc.">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Precio Mensual (€) *</label>
                                                <input type="number" step="0.01" class="form-control" name="precio" required 
                                                       placeholder="0.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Límite de Productos *</label>
                                                <input type="number" class="form-control" name="limite_productos" required 
                                                       placeholder="Ej: 100 (-1 para ilimitados)">
                                                <small class="form-text text-muted">Usa -1 para productos ilimitados</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Características del Plan</label>
                                        <textarea class="form-control" name="caracteristicas" rows="6" 
                                                  placeholder="Una característica por línea:&#10;Gestión de inventario&#10;Reportes básicos&#10;Soporte por email&#10;etc."></textarea>
                                        <small class="form-text text-muted">Escribe una característica por línea</small>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="<?= base_url('public/superadmin/contabilidad/planes') ?>" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Crear Plan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Preview del plan -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">
                                <h5 class="mb-0" id="preview-nombre">Nombre del Plan</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <h2 class="text-primary">€<span id="preview-precio">0.00</span></h2>
                                    <small class="text-muted">por mes</small>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Productos:</span>
                                        <strong id="preview-productos">0</strong>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6>Características:</h6>
                                    <div class="text-start" id="preview-caracteristicas">
                                        <small class="text-muted">Las características aparecerán aquí...</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
// Preview en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const nombreInput = document.querySelector('input[name="nombre"]');
    const precioInput = document.querySelector('input[name="precio"]');
    const productosInput = document.querySelector('input[name="limite_productos"]');
    const caracteristicasInput = document.querySelector('textarea[name="caracteristicas"]');

    nombreInput.addEventListener('input', function() {
        document.getElementById('preview-nombre').textContent = this.value || 'Nombre del Plan';
    });

    precioInput.addEventListener('input', function() {
        document.getElementById('preview-precio').textContent = this.value || '0.00';
    });

    productosInput.addEventListener('input', function() {
        const valor = this.value;
        document.getElementById('preview-productos').textContent = valor == -1 ? 'Ilimitados' : (valor || '0');
    });

    caracteristicasInput.addEventListener('input', function() {
        const caracteristicas = this.value.split('\n').filter(c => c.trim());
        const container = document.getElementById('preview-caracteristicas');
        
        if (caracteristicas.length === 0) {
            container.innerHTML = '<small class="text-muted">Las características aparecerán aquí...</small>';
        } else {
            container.innerHTML = caracteristicas.map(c => 
                `<div class="mb-1"><i class="fas fa-check text-success"></i> <small>${c.trim()}</small></div>`
            ).join('');
        }
    });
});
</script>

<?= $this->include('dashboard/templates/footer') ?>