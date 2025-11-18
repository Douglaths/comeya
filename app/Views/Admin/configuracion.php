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
                    <h4>Mi Cuenta y Configuración ⚙️</h4>
                </div>
                
                <!-- Información Personal -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Información Personal</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/actualizar-perfil') ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" 
                                           value="<?= esc($usuario['nombre'] ?? 'Admin Galvis') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= esc($usuario['email'] ?? 'admin@galvis.com') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nombre_empresa" class="form-label">Nombre del Restaurante</label>
                                    <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" 
                                           value="<?= esc($empresa['nombre'] ?? 'Galvis Café') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono" 
                                           value="<?= esc($empresa['telefono'] ?? '') ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <textarea class="form-control" id="direccion" name="direccion" rows="2"><?= esc($empresa['direccion'] ?? '') ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Actualizar Información</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Cambiar Contraseña -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Cambiar Contraseña</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/cambiar-password') ?>" method="POST">
                                <div class="mb-3">
                                    <label for="password_actual" class="form-label">Contraseña Actual</label>
                                    <input type="password" class="form-control" id="password_actual" name="password_actual" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_nuevo" class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="password_nuevo" name="password_nuevo" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmar" class="form-label">Confirmar Nueva Contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmar" name="password_confirmar" required>
                                </div>
                                
                                <button type="submit" class="btn btn-warning">Cambiar Contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Configuración de Notificaciones -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Notificaciones</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/actualizar-notificaciones') ?>" method="POST">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="email_pedidos" name="email_pedidos" 
                                               <?= isset($notificaciones['email_pedidos']) && $notificaciones['email_pedidos'] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="email_pedidos">
                                            <strong>Email por nuevos pedidos</strong><br>
                                            <small class="text-muted">Recibir email cuando llegue un nuevo pedido</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="whatsapp_pedidos" name="whatsapp_pedidos"
                                               <?= isset($notificaciones['whatsapp_pedidos']) && $notificaciones['whatsapp_pedidos'] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="whatsapp_pedidos">
                                            <strong>WhatsApp por nuevos pedidos</strong><br>
                                            <small class="text-muted">Recibir mensaje de WhatsApp por pedidos</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="email_reportes" name="email_reportes"
                                               <?= isset($notificaciones['email_reportes']) && $notificaciones['email_reportes'] ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="email_reportes">
                                            <strong>Reportes semanales</strong><br>
                                            <small class="text-muted">Recibir resumen semanal de ventas</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-info">Guardar Notificaciones</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Usuarios del Restaurante -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Usuarios del Restaurante</h6>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">
                                Agregar Usuario
                            </button>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($usuarios)): ?>
                                <div class="list-group">
                                    <?php foreach ($usuarios as $user): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1"><?= esc($user['nombre']) ?></h6>
                                                <small class="text-muted"><?= esc($user['email']) ?></small><br>
                                                <span class="badge <?= $user['rol'] == 'admin_empresa' ? 'bg-primary' : 'bg-secondary' ?>">
                                                    <?= ucfirst(str_replace('_', ' ', $user['rol'])) ?>
                                                </span>
                                            </div>
                                            <span class="badge <?= $user['activo'] ? 'bg-success' : 'bg-danger' ?>">
                                                <?= $user['activo'] ? 'Activo' : 'Inactivo' ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted text-center">No hay usuarios adicionales</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Información del Sistema -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Información del Sistema</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Versión:</strong><br>
                                    <span class="text-muted">Comeya v2.1.0</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Última actualización:</strong><br>
                                    <span class="text-muted"><?= date('d/m/Y') ?></span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Soporte:</strong><br>
                                    <span class="text-muted">soporte@comeya.com</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Estado del servicio:</strong><br>
                                    <span class="badge bg-success">Operativo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Usuario -->
    <div class="modal fade" id="agregarUsuarioModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/agregar-usuario') ?>" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nuevo_nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nuevo_nombre" name="nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nuevo_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="nuevo_email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nuevo_password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="nuevo_password" name="password" required>
                        </div>
                        
                        <div class="alert alert-info">
                            <small><i class="fas fa-info-circle me-2"></i>El nuevo usuario tendrá permisos de administrador del restaurante</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?= $this->include('Admin/templates/footer') ?>