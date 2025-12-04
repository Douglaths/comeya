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
                        <h4>Gestión de Empresas</h4>
                        <div>
                            <a href="<?= base_url('superadmin/empresas/solicitudes') ?>" class="btn btn-warning me-2 position-relative">
                                <i class="fas fa-clock"></i> Solicitudes
                                <?php if ($solicitudes_pendientes > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $solicitudes_pendientes ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#configPaginaModal">
                                <i class="fas fa-cog"></i> Configurar Página Principal
                            </button>
                            <a href="<?= base_url('superadmin/empresas/crear') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nueva Empresa
                            </a>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Estado</label>
                                        <select name="estado" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="activo" <?= ($filtros['estado'] ?? '') == 'activo' ? 'selected' : '' ?>>Activo</option>
                                            <option value="inactivo" <?= ($filtros['estado'] ?? '') == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                            <option value="suspendido" <?= ($filtros['estado'] ?? '') == 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
                                            <option value="trial" <?= ($filtros['estado'] ?? '') == 'trial' ? 'selected' : '' ?>>Trial</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Plan</label>
                                        <select name="plan" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="basico" <?= ($filtros['plan'] ?? '') == 'basico' ? 'selected' : '' ?>>Básico</option>
                                            <option value="premium" <?= ($filtros['plan'] ?? '') == 'premium' ? 'selected' : '' ?>>Premium</option>
                                            <option value="enterprise" <?= ($filtros['plan'] ?? '') == 'enterprise' ? 'selected' : '' ?>>Enterprise</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Ciudad</label>
                                        <input type="text" name="ciudad" class="form-control" value="<?= $filtros['ciudad'] ?? '' ?>" placeholder="Buscar ciudad">
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">Limpiar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de empresas -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Lista de Empresas (<?= count($empresas) ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Ciudad</th>
                                                <th>Plan</th>
                                                <th>Estado</th>
                                                <th>Fecha Alta</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($empresas)): ?>
                                                <?php foreach ($empresas as $empresa): ?>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <strong><?= esc($empresa['nombre']) ?></strong><br>
                                                                <small class="text-muted"><?= esc($empresa['email']) ?></small>
                                                            </div>
                                                        </td>
                                                        <td><?= esc($empresa['ciudad']) ?></td>
                                                        <td>
                                                            <span class="badge bg-<?= $empresa['plan'] == 'enterprise' ? 'success' : ($empresa['plan'] == 'premium' ? 'warning' : 'secondary') ?>">
                                                                <?= ucfirst($empresa['plan']) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-<?= $empresa['estado'] == 'activo' ? 'success' : ($empresa['estado'] == 'trial' ? 'info' : 'danger') ?>">
                                                                <?= ucfirst($empresa['estado']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= date('d/m/Y', strtotime($empresa['fecha_alta'])) ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="<?= base_url('superadmin/empresas/editar/' . $empresa['id']) ?>" 
                                                                   class="btn btn-sm btn-warning" title="Editar">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="<?= base_url('superadmin/empresas/impersonar/' . $empresa['id']) ?>" 
                                                                   class="btn btn-sm btn-primary" title="Impersonar">
                                                                    <i class="fas fa-sign-in-alt"></i>
                                                                </a>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                        <i class="fas fa-cog"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'activo')">Activar</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'inactivo')">Desactivar</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarEstado(<?= $empresa['id'] ?>, 'suspendido')">Suspender</a></li>
                                                                        <li><hr class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarPlan(<?= $empresa['id'] ?>, 'basico')">Plan Básico</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarPlan(<?= $empresa['id'] ?>, 'premium')">Plan Premium</a></li>
                                                                        <li><a class="dropdown-item" href="#" onclick="cambiarPlan(<?= $empresa['id'] ?>, 'enterprise')">Plan Enterprise</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No hay empresas registradas</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Configuración Página Principal -->
    <div class="modal fade" id="configPaginaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configuración de Página Principal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="configPaginaForm">
                        <!-- Información de Filtros -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Filtros de Búsqueda</h6>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Los filtros de ciudades y categorías se generan automáticamente desde las empresas activas en el sistema.
                            </div>
                        </div>

                        <!-- Promociones Especiales -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Promociones Especiales (Destacados)</h6>
                            <div id="promocionesContainer">
                                <!-- Las promociones se cargarán dinámicamente -->
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="agregarPromocion()">
                                <i class="fas fa-plus"></i> Agregar Promoción
                            </button>
                        </div>

                        <!-- Configuración General -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Configuración General</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Título Principal</label>
                                    <input type="text" class="form-control" id="titulo_principal" placeholder="Encuentra tu restaurante favorito">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subtítulo</label>
                                    <input type="text" class="form-control" id="subtitulo" placeholder="Comida deliciosa a domicilio">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarConfiguracion()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cambiarEstado(empresaId, estado) {
            if (confirm('¿Está seguro de cambiar el estado de esta empresa?')) {
                fetch('<?= base_url('superadmin/empresas/cambiar-estado') ?>/' + empresaId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ estado: estado })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el estado');
                    }
                });
            }
        }

        function cambiarPlan(empresaId, plan) {
            if (confirm('¿Está seguro de cambiar el plan de esta empresa?')) {
                fetch('<?= base_url('superadmin/empresas/cambiar-plan') ?>/' + empresaId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ plan: plan })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el plan');
                    }
                });
            }
        }

        // Configuración de Página Principal
        let promocionesCount = 0;

        function cargarConfiguracion() {
            fetch('<?= base_url('superadmin/configuracion-pagina/obtener') ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const config = data.configuracion;
                        document.getElementById('titulo_principal').value = config.titulo_principal || '';
                        document.getElementById('subtitulo').value = config.subtitulo || '';
                        
                        // Cargar promociones
                        const promociones = config.promociones || [];
                        const container = document.getElementById('promocionesContainer');
                        container.innerHTML = '';
                        promocionesCount = 0;
                        
                        promociones.forEach(promo => {
                            agregarPromocion(promo);
                        });
                    }
                });
        }

        function agregarPromocion(datos = null) {
            const container = document.getElementById('promocionesContainer');
            const id = promocionesCount++;
            
            const promocionHtml = `
                <div class="card mb-3" id="promocion_${id}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Promoción ${id + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger" onclick="eliminarPromocion(${id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Empresa</label>
                                <select class="form-control" name="promocion_empresa_${id}">
                                    <option value="">Seleccionar empresa</option>
                                    <?php foreach ($empresas as $empresa): ?>
                                        <option value="<?= $empresa['id'] ?>"><?= esc($empresa['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Título de la Promoción</label>
                                <input type="text" class="form-control" name="promocion_titulo_${id}" value="${datos?.titulo || ''}" placeholder="Ej: 20% de descuento">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', promocionHtml);
            
            // Si hay datos, seleccionar la empresa
            if (datos && datos.empresa_id) {
                setTimeout(() => {
                    document.querySelector(`[name="promocion_empresa_${id}"]`).value = datos.empresa_id;
                }, 100);
            }
        }

        function eliminarPromocion(id) {
            document.getElementById(`promocion_${id}`).remove();
        }

        function guardarConfiguracion() {
            const formData = {
                titulo_principal: document.getElementById('titulo_principal').value,
                subtitulo: document.getElementById('subtitulo').value,
                promociones: []
            };

            // Recopilar promociones
            document.querySelectorAll('[id^="promocion_"]').forEach(promocionDiv => {
                const id = promocionDiv.id.split('_')[1];
                const empresa_id = document.querySelector(`[name="promocion_empresa_${id}"]`)?.value;
                const titulo = document.querySelector(`[name="promocion_titulo_${id}"]`)?.value;
                const descripcion = document.querySelector(`[name="promocion_descripcion_${id}"]`)?.value;
                
                if (empresa_id && titulo) {
                    formData.promociones.push({
                        empresa_id: empresa_id,
                        titulo: titulo
                    });
                }
            });

            fetch('<?= base_url('superadmin/configuracion-pagina/guardar') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Configuración guardada exitosamente');
                    bootstrap.Modal.getInstance(document.getElementById('configPaginaModal')).hide();
                } else {
                    alert('Error al guardar la configuración');
                }
            });
        }

        // Cargar configuración cuando se abre el modal
        document.getElementById('configPaginaModal').addEventListener('show.bs.modal', cargarConfiguracion);
    </script>

<?= $this->include('Dashboard/templates/footer') ?>