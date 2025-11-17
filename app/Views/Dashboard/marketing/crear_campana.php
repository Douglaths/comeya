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
                        <h2>Crear Campaña de Marketing</h2>
                        <a href="<?= base_url('public/superadmin/marketing/campanas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre de la Campaña *</label>
                                        <input type="text" class="form-control" name="nombre" required 
                                               placeholder="Ej: Captación Restaurantes Q1 2024">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Campaña *</label>
                                                <select class="form-select" name="tipo" required>
                                                    <option value="">Seleccionar tipo</option>
                                                    <option value="google_ads">Google Ads</option>
                                                    <option value="meta_ads">Meta Ads (Facebook/Instagram)</option>
                                                    <option value="email">Email Marketing</option>
                                                    <option value="seo">SEO</option>
                                                    <option value="contenido">Marketing de Contenido</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Plataforma</label>
                                                <input type="text" class="form-control" name="plataforma" 
                                                       placeholder="Ej: Google Ads, Facebook, Mailchimp">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Presupuesto (€)</label>
                                                <input type="number" step="0.01" class="form-control" name="presupuesto" 
                                                       placeholder="500.00">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Fecha Inicio *</label>
                                                <input type="date" class="form-control" name="fecha_inicio" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Fecha Fin</label>
                                                <input type="date" class="form-control" name="fecha_fin">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Objetivo de la Campaña</label>
                                        <textarea class="form-control" name="objetivo" rows="3" 
                                                  placeholder="Describe el objetivo principal de esta campaña..."></textarea>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="<?= base_url('public/superadmin/marketing/campanas') ?>" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Crear Campaña
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