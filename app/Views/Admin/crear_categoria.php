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
                    <h4>Nueva Categoría</h4>
                    <a href="<?= base_url('admin/menu') ?>" class="btn btn-secondary">Volver al Menú</a>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('admin/categorias/store') ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre de la Categoría</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    <div class="form-text">Ej: Bebidas Calientes, Postres, Desayunos</div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="<?= base_url('admin/menu') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Crear Categoría</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>Ejemplos de Categorías</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">☕ <strong>Bebidas Calientes</strong><br><small class="text-muted">Café, té, chocolate caliente</small></li>
                                <li class="mb-2">🥤 <strong>Bebidas Frías</strong><br><small class="text-muted">Jugos, sodas, malteadas</small></li>
                                <li class="mb-2">🍰 <strong>Postres</strong><br><small class="text-muted">Tortas, helados, galletas</small></li>
                                <li class="mb-2">🍳 <strong>Desayunos</strong><br><small class="text-muted">Huevos, tostadas, cereales</small></li>
                                <li class="mb-2">🥪 <strong>Almuerzos</strong><br><small class="text-muted">Sándwiches, ensaladas, platos fuertes</small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->include('Admin/templates/footer') ?>