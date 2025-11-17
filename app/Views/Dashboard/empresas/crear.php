<?= $this->include('Dashboard/templates/header') ?>
<body class="">
    <?= $this->include('Dashboard/templates/navbar') ?>

    <div class="content-page">
        <main class="main-content">
            <div class="conatiner-fluid content-inner mt-5 py-0">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                        <h4>Crear Nueva Empresa</h4>
                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= base_url('superadmin/empresas/store') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Datos de la Empresa</h5>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Nombre de la Empresa *</label>
                                                <input type="text" name="nombre" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Email *</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Teléfono</label>
                                                <input type="text" name="telefono" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Dirección</label>
                                                <textarea name="direccion" class="form-control" rows="3"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Ciudad *</label>
                                                <input type="text" name="ciudad" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Plan *</label>
                                                <select name="plan" class="form-select" required>
                                                    <option value="">Seleccionar plan</option>
                                                    <option value="basico">Básico (25 productos)</option>
                                                    <option value="premium">Premium (100 productos)</option>
                                                    <option value="enterprise">Enterprise (500 productos)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h5 class="mb-3">Usuario Administrador</h5>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Nombre del Admin *</label>
                                                <input type="text" name="admin_nombre" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Email del Admin *</label>
                                                <input type="email" name="admin_email" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Contraseña *</label>
                                                <input type="password" name="admin_password" class="form-control" required minlength="6">
                                                <small class="form-text text-muted">Mínimo 6 caracteres</small>
                                            </div>

                                            <div class="alert alert-info">
                                                <h6>Información del Plan</h6>
                                                <ul class="mb-0">
                                                    <li><strong>Básico:</strong> 25 productos, funciones básicas</li>
                                                    <li><strong>Premium:</strong> 100 productos, reportes avanzados</li>
                                                    <li><strong>Enterprise:</strong> 500 productos, todas las funciones</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Crear Empresa
                                            </button>
                                            <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary ms-2">Cancelar</a>
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