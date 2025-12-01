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
                        <h4>Editar Empresa: <?= esc($empresa['nombre']) ?></h4>
                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Información de la Empresa</h5>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('errors')): ?>
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                                <li><?= esc($error) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= base_url('superadmin/empresas/actualizar/' . $empresa['id']) ?>" method="POST">
                                    <div class="row">
                                        <!-- Información Básica -->
                                        <div class="col-md-6">
                                            <h6 class="mb-3 text-primary">Información Básica</h6>
                                            
                                            <div class="mb-3">
                                                <label for="nombre" class="form-label">Nombre de la Empresa *</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                                       value="<?= esc($empresa['nombre']) ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email" class="form-control" id="email" name="email" 
                                                       value="<?= esc($empresa['email']) ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" 
                                                       value="<?= esc($empresa['telefono']) ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <textarea class="form-control" id="direccion" name="direccion" rows="3"><?= esc($empresa['direccion']) ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= esc($empresa['descripcion']) ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="ciudad" class="form-label">Ciudad</label>
                                                <input type="text" class="form-control" id="ciudad" name="ciudad" 
                                                       value="<?= esc($empresa['ciudad']) ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="categoria_comida" class="form-label">Categoría de Comida</label>
                                                <input type="text" class="form-control" id="categoria_comida" name="categoria_comida" 
                                                       value="<?= esc($empresa['categoria_comida']) ?>" 
                                                       placeholder="Ej: Italiana, Mexicana, Asiática">
                                            </div>
                                        </div>

                                        <!-- Configuración del Plan -->
                                        <div class="col-md-6">
                                            <h6 class="mb-3 text-primary">Configuración del Plan</h6>
                                            
                                            <div class="mb-3">
                                                <label for="plan" class="form-label">Plan *</label>
                                                <select class="form-select" id="plan" name="plan" required>
                                                    <option value="basico" <?= $empresa['plan'] == 'basico' ? 'selected' : '' ?>>Básico</option>
                                                    <option value="premium" <?= $empresa['plan'] == 'premium' ? 'selected' : '' ?>>Premium</option>
                                                    <option value="enterprise" <?= $empresa['plan'] == 'enterprise' ? 'selected' : '' ?>>Enterprise</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="estado" class="form-label">Estado *</label>
                                                <select class="form-select" id="estado" name="estado" required>
                                                    <option value="activo" <?= $empresa['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
                                                    <option value="inactivo" <?= $empresa['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                                    <option value="suspendido" <?= $empresa['estado'] == 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
                                                    <option value="trial" <?= $empresa['estado'] == 'trial' ? 'selected' : '' ?>>Trial</option>
                                                </select>
                                                <small class="text-muted"><strong>Solo las empresas con estado "Activo" aparecen en el menú público</strong></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="limite_productos" class="form-label">Límite de Productos</label>
                                                <input type="number" class="form-control" id="limite_productos" name="limite_productos" 
                                                       value="<?= esc($empresa['limite_productos']) ?>" min="1">
                                                <small class="form-text text-muted">Dejar vacío para usar el límite por defecto del plan</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="fecha_trial_fin" class="form-label">Fecha Fin de Trial</label>
                                                <input type="date" class="form-control" id="fecha_trial_fin" name="fecha_trial_fin" 
                                                       value="<?= $empresa['fecha_trial_fin'] ?>">
                                                <small class="form-text text-muted">Solo para empresas en estado Trial</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="codigo_referido" class="form-label">Código de Referido</label>
                                                <input type="text" class="form-control" id="codigo_referido" name="codigo_referido" 
                                                       value="<?= esc($empresa['codigo_referido']) ?>">
                                            </div>

                                            <!-- Características Especiales -->
                                            <h6 class="mb-3 text-primary">Características Especiales</h6>
                                            
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="envio_gratis" name="envio_gratis" 
                                                           <?= $empresa['envio_gratis'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="envio_gratis">
                                                        Envío Gratis
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="descuento_activo" name="descuento_activo" 
                                                           <?= $empresa['descuento_activo'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="descuento_activo">
                                                        Descuento Activo
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="oferta_2x1" name="oferta_2x1" 
                                                           <?= $empresa['oferta_2x1'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="oferta_2x1">
                                                        Oferta 2x1
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="destacado" name="destacado" 
                                                           <?= $empresa['destacado'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="destacado">
                                                        Empresa Destacada
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Actualizar Empresa
                                            </button>
                                            <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary ms-2">
                                                Cancelar
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('Dashboard/templates/footer') ?>