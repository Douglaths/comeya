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
                        <h2>Crear Código de Referido</h2>
                        <a href="<?= base_url('public/superadmin/marketing/referidos') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Código *</label>
                                                <input type="text" class="form-control" name="codigo" required 
                                                       placeholder="Ej: PARTNER2024" style="text-transform: uppercase;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Descuento (%) *</label>
                                                <input type="number" class="form-control" name="descuento_porcentaje" required 
                                                       min="1" max="100" placeholder="20">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" 
                                               placeholder="Código para partners estratégicos">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Límite de Usos</label>
                                                <input type="number" class="form-control" name="limite_usos" 
                                                       placeholder="Dejar vacío para ilimitado">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Fecha de Expiración</label>
                                                <input type="date" class="form-control" name="fecha_expiracion">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="<?= base_url('public/superadmin/marketing/referidos') ?>" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Crear Código
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?= $this->include('dashboard/templates/footer') ?>