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
                        <h2>Códigos de Referidos</h2>
                        <div>
                            <a href="<?= base_url('public/superadmin/marketing/crear-referido') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nuevo Código
                            </a>
                            <a href="<?= base_url('public/superadmin/marketing') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Tabla de códigos -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Descuento</th>
                                            <th>Usos</th>
                                            <th>Límite</th>
                                            <th>Expira</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($codigos)): ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No hay códigos registrados</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($codigos as $codigo): ?>
                                                <tr>
                                                    <td>
                                                        <strong class="text-primary"><?= esc($codigo['codigo']) ?></strong>
                                                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('<?= $codigo['codigo'] ?>')" title="Copiar código">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </td>
                                                    <td><?= esc($codigo['descripcion']) ?></td>
                                                    <td>
                                                        <span class="badge bg-success"><?= $codigo['descuento_porcentaje'] ?>%</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info"><?= $codigo['usos_actuales'] ?></span>
                                                    </td>
                                                    <td><?= $codigo['limite_usos'] ? $codigo['limite_usos'] : 'Ilimitado' ?></td>
                                                    <td>
                                                        <?php if ($codigo['fecha_expiracion']): ?>
                                                            <?php
                                                            $expira = new DateTime($codigo['fecha_expiracion']);
                                                            $hoy = new DateTime();
                                                            $vencido = $expira < $hoy;
                                                            ?>
                                                            <span class="<?= $vencido ? 'text-danger' : 'text-muted' ?>">
                                                                <?= date('d/m/Y', strtotime($codigo['fecha_expiracion'])) ?>
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="text-muted">Sin expiración</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge <?= $codigo['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                                                            <?= $codigo['activo'] ? 'Activo' : 'Inactivo' ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <button class="btn btn-outline-primary" title="Ver Estadísticas">
                                                                <i class="fas fa-chart-bar"></i>
                                                            </button>
                                                            <button class="btn btn-outline-<?= $codigo['activo'] ? 'warning' : 'success' ?>" title="<?= $codigo['activo'] ? 'Desactivar' : 'Activar' ?>">
                                                                <i class="fas fa-<?= $codigo['activo'] ? 'pause' : 'play' ?>"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Mostrar notificación de éxito
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    Código copiado: ${text}
                </div>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    });
}
</script>

<?= $this->include('dashboard/templates/footer') ?>