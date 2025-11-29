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
                        <h4>Solicitudes de Registro</h4>
                        <a href="<?= base_url('superadmin/empresas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver a Empresas
                        </a>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="col-12">
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="col-12">
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        </div>
                    <?php endif; ?>

                    <!-- Tabla de solicitudes -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Lista de Solicitudes (<?= count($solicitudes) ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Restaurante</th>
                                                <th>Contacto</th>
                                                <th>Ubicación</th>
                                                <th>Estado</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($solicitudes)): ?>
                                                <?php foreach ($solicitudes as $solicitud): ?>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <strong><?= esc($solicitud['nombre_empresa']) ?></strong><br>
                                                                <small class="text-muted"><?= esc($solicitud['email']) ?></small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <strong><?= esc($solicitud['nombre_contacto']) ?></strong><br>
                                                                <?php if ($solicitud['telefono']): ?>
                                                                    <small class="text-muted"><?= esc($solicitud['telefono']) ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                        <td><?= esc($solicitud['direccion']) ?: 'No especificada' ?></td>
                                                        <td>
                                                            <span class="badge bg-<?= 
                                                                $solicitud['estado'] == 'pendiente' ? 'warning' : 
                                                                ($solicitud['estado'] == 'aprobada' ? 'success' : 'danger') 
                                                            ?>">
                                                                <?= ucfirst($solicitud['estado']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= date('d/m/Y H:i', strtotime($solicitud['fecha_solicitud'])) ?></td>
                                                        <td>
                                                            <?php if ($solicitud['estado'] == 'pendiente'): ?>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-sm btn-info" 
                                                                            onclick="verDetalles(<?= $solicitud['id'] ?>)">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-success" 
                                                                            onclick="aprobar(<?= $solicitud['id'] ?>)">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                                            onclick="rechazar(<?= $solicitud['id'] ?>)">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            <?php else: ?>
                                                                <button type="button" class="btn btn-sm btn-info" 
                                                                        onclick="verDetalles(<?= $solicitud['id'] ?>)">
                                                                    <i class="fas fa-eye"></i> Ver
                                                                </button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No hay solicitudes registradas</td>
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

    <!-- Modal para ver detalles -->
    <div class="modal fade" id="modalDetalles" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles de la Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contenidoDetalles">
                    <!-- Contenido cargado dinámicamente -->
                </div>
            </div>
        </div>
    </div>

    <script>
        const solicitudes = <?= json_encode($solicitudes) ?>;

        function verDetalles(id) {
            const solicitud = solicitudes.find(s => s.id == id);
            if (!solicitud) return;

            const contenido = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Información del Restaurante</h6>
                        <p><strong>Nombre:</strong> ${solicitud.nombre_empresa}</p>
                        <p><strong>Email:</strong> ${solicitud.email}</p>
                        <p><strong>Teléfono:</strong> ${solicitud.telefono || 'No especificado'}</p>
                        <p><strong>Dirección:</strong> ${solicitud.direccion || 'No especificada'}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Información del Contacto</h6>
                        <p><strong>Nombre:</strong> ${solicitud.nombre_contacto}</p>
                        <p><strong>Estado:</strong> <span class="badge bg-${
                            solicitud.estado === 'pendiente' ? 'warning' : 
                            (solicitud.estado === 'aprobada' ? 'success' : 'danger')
                        }">${solicitud.estado.charAt(0).toUpperCase() + solicitud.estado.slice(1)}</span></p>
                        <p><strong>Fecha:</strong> ${new Date(solicitud.fecha_solicitud).toLocaleString()}</p>
                        ${solicitud.fecha_respuesta ? `<p><strong>Fecha Respuesta:</strong> ${new Date(solicitud.fecha_respuesta).toLocaleString()}</p>` : ''}
                    </div>
                </div>
                ${solicitud.mensaje ? `
                    <hr>
                    <h6>Mensaje</h6>
                    <p>${solicitud.mensaje}</p>
                ` : ''}
                ${solicitud.notas_admin ? `
                    <hr>
                    <h6>Notas del Administrador</h6>
                    <p>${solicitud.notas_admin}</p>
                ` : ''}
            `;

            document.getElementById('contenidoDetalles').innerHTML = contenido;
            new bootstrap.Modal(document.getElementById('modalDetalles')).show();
        }

        function aprobar(id) {
            if (confirm('¿Está seguro de aprobar esta solicitud? Se creará automáticamente la empresa.')) {
                window.location.href = `<?= base_url('superadmin/empresas/aprobar-solicitud/') ?>${id}`;
            }
        }

        function rechazar(id) {
            const notas = prompt('Motivo del rechazo (opcional):');
            if (notas !== null) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?= base_url('superadmin/empresas/rechazar-solicitud/') ?>${id}`;
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'notas';
                input.value = notas;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

<?= $this->include('Dashboard/templates/footer') ?>