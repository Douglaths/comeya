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
                        <h2>Crear Campaña de Email</h2>
                        <a href="<?= base_url('public/superadmin/marketing/emails') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Asunto del Email *</label>
                                        <input type="text" class="form-control" name="asunto" required 
                                               placeholder="Ej: Nuevas funcionalidades en Comeya">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Destinatarios *</label>
                                                <select class="form-select" name="destinatarios" required>
                                                    <option value="">Seleccionar destinatarios</option>
                                                    <option value="todos">Todas las empresas</option>
                                                    <option value="activos">Solo empresas activas</option>
                                                    <option value="inactivos">Solo empresas inactivas</option>
                                                    <option value="trial">Solo empresas en trial</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Programar Para</label>
                                                <input type="datetime-local" class="form-control" name="programado_para">
                                                <small class="form-text text-muted">Dejar vacío para enviar inmediatamente</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Contenido del Email *</label>
                                        <textarea class="form-control" name="contenido" rows="10" required 
                                                  placeholder="Escribe aquí el contenido del email..."></textarea>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="<?= base_url('public/superadmin/marketing/emails') ?>" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <div>
                                            <button type="submit" name="accion" value="borrador" class="btn btn-outline-primary">
                                                <i class="fas fa-save"></i> Guardar Borrador
                                            </button>
                                            <button type="submit" name="accion" value="enviar" class="btn btn-primary">
                                                <i class="fas fa-paper-plane"></i> Enviar Ahora
                                            </button>
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

<?= $this->include('dashboard/templates/footer') ?>