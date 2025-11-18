<?= $this->include('Admin/templates/header') ?>

<body class="">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>

    <?= $this->include('Admin/templates/navbar') ?>

    <div class="content-page">
        <div class="container-fluid content-inner mt-5 py-0">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                    <h4>Nuevo Producto</h4>
                    <a href="<?= base_url('admin/menu') ?>" class="btn btn-secondary">Volver al Menú</a>
                </div>
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('admin/productos/store') ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="categoria_id" class="form-label">Categoría</label>
                                    <select class="form-select" id="categoria_id" name="categoria_id" required>
                                        <option value="">Seleccionar categoría</option>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <option value="<?= $categoria['id'] ?>"><?= esc($categoria['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="imagen" class="form-label">Imagen del Producto</label>
                                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="previewImage(this)">
                                    <div class="form-text">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="<?= base_url('admin/menu') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Vista Previa</h6>
                        </div>
                        <div class="card-body">
                            <div class="preview-product">
                                <div class="product-image bg-light rounded mb-3" id="imagePreview" style="height: 150px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <span class="text-muted">Sin imagen</span>
                                </div>
                                <h6 class="product-name">Nombre del producto</h6>
                                <p class="product-description text-muted small">Descripción del producto</p>
                                <h5 class="product-price text-primary">$0</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
// Vista previa en tiempo real
document.getElementById('nombre').addEventListener('input', function() {
    document.querySelector('.product-name').textContent = this.value || 'Nombre del producto';
});

document.getElementById('descripcion').addEventListener('input', function() {
    document.querySelector('.product-description').textContent = this.value || 'Descripción del producto';
});

document.getElementById('precio').addEventListener('input', function() {
    document.querySelector('.product-price').textContent = '$' + (this.value || '0');
});

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.innerHTML = '<span class="text-muted">Sin imagen</span>';
    }
}
</script>

<?= $this->include('Admin/templates/footer') ?>