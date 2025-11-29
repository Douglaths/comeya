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
                    <h4>Mi Menú / Productos</h4>
                    <div>
                        <div class="btn-group me-2" role="group">
                            <button type="button" class="btn btn-outline-secondary active" id="viewCards">
                                <i class="fas fa-th"></i> Cards
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="viewTable">
                                <i class="fas fa-list"></i> Tabla
                            </button>
                        </div>
                        <a href="<?= base_url('admin/categorias/crear') ?>" class="btn btn-secondary me-2">Nueva Categoría</a>
                        <a href="<?= base_url('admin/productos/crear') ?>" class="btn btn-primary">Nuevo Producto</a>
                    </div>
                </div>
                
                <!-- Vista de Tabla -->
                <div id="tableView" class="col-12" style="display: none;">
                    <?php if (isset($productos) && !empty($productos)): ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Producto</th>
                                                <th>Categoría</th>
                                                <th>Descripción</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                                <th>Destacado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($productos as $producto): ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?= $producto['imagen'] ? base_url('uploads/' . $producto['imagen']) : 'https://via.placeholder.com/50x50?text=Sin+Imagen' ?>" 
                                                             alt="<?= esc($producto['nombre']) ?>" 
                                                             class="rounded" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    </td>
                                                    <td><strong><?= esc($producto['nombre']) ?></strong></td>
                                                    <td><?= esc($producto['categoria_nombre'] ?? 'Sin categoría') ?></td>
                                                    <td><?= esc($producto['descripcion']) ?></td>
                                                    <td><strong>$<?= number_format($producto['precio'], 0) ?></strong></td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   <?= $producto['activo'] ? 'checked' : '' ?>
                                                                   onchange="toggleProducto(<?= $producto['id'] ?>)">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   <?= isset($producto['destacado']) && $producto['destacado'] ? 'checked' : '' ?>
                                                                   onchange="toggleDestacado(<?= $producto['id'] ?>)">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-sm btn-outline-info" 
                                                                    onclick="verProducto(<?= $producto['id'] ?>)">Ver</button>
                                                            <a href="<?= base_url('admin/productos/editar/' . $producto['id']) ?>" 
                                                               class="btn btn-sm btn-outline-primary">Editar</a>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                    onclick="eliminarProducto(<?= $producto['id'] ?>)">Eliminar</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>No tienes productos creados</h5>
                                <p class="text-muted">Crea tu primer producto para empezar</p>
                                <a href="<?= base_url('admin/productos/crear') ?>" class="btn btn-primary">Crear Primer Producto</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Vista de Cards -->
                <div id="cardsView" class="col-12">
                    <?php if (isset($categorias) && !empty($categorias)): ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"><?= esc($categoria['nombre']) ?></h5>
                                    <span class="badge <?= $categoria['activo'] ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $categoria['activo'] ? 'Activa' : 'Inactiva' ?>
                                    </span>
                                </div>
                                
                                <div class="row">
                                    <?php 
                                    $productosCategoria = array_filter($productos, function($producto) use ($categoria) {
                                        return $producto['categoria_id'] == $categoria['id'];
                                    });
                                    ?>
                                    
                                    <?php if (!empty($productosCategoria)): ?>
                                        <?php foreach ($productosCategoria as $producto): ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                                                <div class="card h-100">
                                                    <img src="<?= $producto['imagen'] ? base_url('uploads/' . $producto['imagen']) : 'https://via.placeholder.com/200x200?text=Sin+Imagen' ?>" 
                                                         class="card-img-top" 
                                                         alt="<?= esc($producto['nombre']) ?>"
                                                         style="height: 200px; object-fit: cover;">
                                                    <div class="card-body d-flex flex-column">
                                                        <h6 class="card-title"><?= esc($producto['nombre']) ?></h6>
                                                        <p class="card-text text-muted small flex-grow-1"><?= esc($producto['descripcion']) ?></p>
                                                        <h5 class="text-primary mb-3">$<?= number_format($producto['precio'], 0) ?></h5>
                                                        
                                                        <div class="btn-group mb-2" role="group">
                                                            <button type="button" class="btn btn-sm btn-outline-info" 
                                                                    onclick="verProducto(<?= $producto['id'] ?>)">Ver</button>
                                                            <a href="<?= base_url('admin/productos/editar/' . $producto['id']) ?>" 
                                                               class="btn btn-sm btn-outline-primary">Editar</a>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                    onclick="eliminarProducto(<?= $producto['id'] ?>)">Eliminar</button>
                                                        </div>
                                                        
                                                        <div class="form-check form-switch mb-2">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   <?= $producto['activo'] ? 'checked' : '' ?>
                                                                   onchange="toggleProducto(<?= $producto['id'] ?>)">
                                                            <label class="form-check-label">
                                                                <?= $producto['activo'] ? 'Activo' : 'Inactivo' ?>
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   <?= isset($producto['destacado']) && $producto['destacado'] ? 'checked' : '' ?>
                                                                   onchange="toggleDestacado(<?= $producto['id'] ?>)">
                                                            <label class="form-check-label">
                                                                <?= isset($producto['destacado']) && $producto['destacado'] ? 'Destacado' : 'Normal' ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <p class="text-muted text-center">No hay productos en esta categoría</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<script>
// Cambiar vista
document.getElementById('viewCards').addEventListener('click', function() {
    document.getElementById('cardsView').style.display = 'block';
    document.getElementById('tableView').style.display = 'none';
    this.classList.add('active');
    document.getElementById('viewTable').classList.remove('active');
});

document.getElementById('viewTable').addEventListener('click', function() {
    document.getElementById('tableView').style.display = 'block';
    document.getElementById('cardsView').style.display = 'none';
    this.classList.add('active');
    document.getElementById('viewCards').classList.remove('active');
});

function toggleProducto(productoId) {
    fetch('<?= base_url('admin/productos/toggle') ?>/' + productoId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error al cambiar el estado del producto');
            location.reload();
        }
    });
}

function toggleDestacado(productoId) {
    fetch('<?= base_url('admin/productos/toggle-destacado') ?>/' + productoId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error al cambiar el estado destacado');
            location.reload();
        }
    });
}

function verProducto(id) {
    // Crear modal para ver producto
    fetch('<?= base_url('admin/productos/ver') ?>/' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const producto = data.producto;
                const modalContent = `
                    <div class="modal fade" id="verProductoModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">${producto.nombre}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="${producto.imagen ? '<?= base_url('uploads/') ?>' + producto.imagen : 'https://via.placeholder.com/300x300?text=Sin+Imagen'}" 
                                                 class="img-fluid rounded" alt="${producto.nombre}">
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-primary">$${parseFloat(producto.precio).toLocaleString()}</h4>
                                            <p class="text-muted">${producto.descripcion || 'Sin descripción'}</p>
                                            <p><strong>Estado:</strong> <span class="badge ${producto.activo ? 'bg-success' : 'bg-danger'}">${producto.activo ? 'Activo' : 'Inactivo'}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalContent);
                const modal = new bootstrap.Modal(document.getElementById('verProductoModal'));
                modal.show();
                document.getElementById('verProductoModal').addEventListener('hidden.bs.modal', function() {
                    this.remove();
                });
            }
        });
}

function eliminarProducto(id) {
    if (confirm('¿Está seguro de eliminar este producto?')) {
        fetch('<?= base_url('admin/productos/eliminar') ?>/' + id, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al eliminar el producto');
            }
        });
    }
}
</script>

<?= $this->include('Admin/templates/footer') ?>