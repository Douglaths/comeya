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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#configurarEmpresaModal">
                        <i class="fas fa-building"></i> Configurar Empresa
                    </button>
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
                                    <label for="nombre_usuario" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" 
                                           value="<?= esc($usuario['nombre'] ?? '') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email_usuario" class="form-label">Email Personal</label>
                                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" 
                                           value="<?= esc($usuario['email'] ?? '') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="telefono_usuario" class="form-label">Teléfono Personal</label>
                                    <input type="tel" class="form-control" id="telefono_usuario" name="telefono_usuario" 
                                           value="<?= esc($usuario['telefono'] ?? '') ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="direccion_usuario" class="form-label">Dirección Personal</label>
                                    <textarea class="form-control" id="direccion_usuario" name="direccion_usuario" rows="2"><?= esc($usuario['direccion'] ?? '') ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Actualizar Información Personal</button>
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
                                        <div class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <img src="<?= !empty($user['foto_perfil']) ? base_url('uploads/' . $user['foto_perfil']) : base_url('public/assets/images/avatars/01.png') ?>" 
                                                     alt="<?= esc($user['nombre']) ?>" 
                                                     class="rounded-circle me-3" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1"><?= esc($user['nombre']) ?></h6>
                                                    <small class="text-muted"><?= esc($user['email']) ?></small><br>
                                                    <span class="badge <?= $user['rol'] == 'administrador' ? 'bg-primary' : 'bg-secondary' ?>">
                                                        <?= ucfirst($user['rol']) ?>
                                                    </span>
                                                </div>
                                                <div class="text-end">
                                                    <button class="btn btn-outline-primary me-2" 
                                                            onclick="editarUsuario(<?= $user['id'] ?>, '<?= esc($user['nombre']) ?>', '<?= esc($user['email']) ?>', '<?= $user['foto_perfil'] ?? '' ?>')">
                                                        ✏️ Editar
                                                    </button>
                                                    <span class="badge <?= $user['activo'] ? 'bg-success' : 'bg-danger' ?>">
                                                        <?= $user['activo'] ? 'Activo' : 'Inactivo' ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted text-center">No hay usuarios registrados</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Información del Sistema -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Información del Sistema</h6>
                            <?php if (!$usuario['id']): ?>
                            <form action="<?= base_url('admin/sincronizar-usuarios') ?>" method="POST" style="display: inline;">
                                <button type="submit" class="btn btn-sm btn-warning" title="Sincronizar datos de usuario">
                                    <i class="fas fa-sync"></i> Sincronizar Usuario
                                </button>
                            </form>
                            <?php endif; ?>
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
                            <?php if (!$usuario['id']): ?>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Nota:</strong> Tu perfil de usuario no está completamente sincronizado. 
                                        Usa el botón "Sincronizar Usuario" para completar la configuración.
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
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

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/actualizar-usuario') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit_user_id" name="user_id">
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img id="preview_foto" src="<?= base_url('assets/images/avatars/01.png') ?>" 
                                 alt="Foto de perfil" class="rounded-circle mb-2" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <label for="foto_perfil" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-camera"></i> Cambiar Foto
                                </label>
                                <input type="file" id="foto_perfil" name="foto_perfil" class="d-none" accept="image/*">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit_nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" readonly>
                            <small class="text-muted">El email no se puede modificar</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Nueva Contraseña (opcional)</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                            <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Configurar Empresa -->
    <div class="modal fade" id="configurarEmpresaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configuración de la Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/actualizar-empresa') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Información Básica</h6>
                                
                                <div class="mb-3">
                                    <label for="empresa_nombre" class="form-label">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" id="empresa_nombre" name="nombre" 
                                           value="<?= esc($empresa['nombre'] ?? '') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_email" class="form-label">Email de la Empresa</label>
                                    <input type="email" class="form-control" id="empresa_email" name="email" 
                                           value="<?= esc($empresa['email'] ?? '') ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_telefono" class="form-label">Teléfono de la Empresa</label>
                                    <input type="tel" class="form-control" id="empresa_telefono" name="telefono" 
                                           value="<?= esc($empresa['telefono'] ?? '') ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_direccion" class="form-label">Dirección de la Empresa</label>
                                    <textarea class="form-control" id="empresa_direccion" name="direccion" rows="2"><?= esc($empresa['direccion'] ?? '') ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="empresa_descripcion" name="descripcion" rows="3"><?= esc($empresa['descripcion'] ?? '') ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="empresa_ciudad" name="ciudad" 
                                           value="<?= esc($empresa['ciudad'] ?? '') ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_categoria" class="form-label">Categoría de Comida</label>
                                    <input type="text" class="form-control" id="empresa_categoria" name="categoria_comida" 
                                           value="<?= esc($empresa['categoria_comida'] ?? '') ?>" 
                                           placeholder="Ej: Italiana, Mexicana, Asiática">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="empresa_costo_envio" class="form-label">Costo de Envío/Domicilio</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="empresa_costo_envio" name="costo_envio" 
                                               value="<?= esc($empresa['costo_envio'] ?? '3.00') ?>" 
                                               step="0.01" min="0" placeholder="3.00">
                                    </div>
                                    <small class="text-muted">Valor que se cobrará por envío a domicilio</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="mb-3">Imágenes</h6>
                                
                                <!-- Logo -->
                                <div class="mb-4">
                                    <label class="form-label">Logo de la Empresa</label>
                                    <div class="text-center mb-2">
                                        <img id="preview_logo" src="<?= !empty($empresa['logo']) ? base_url('uploads/' . $empresa['logo']) : 'https://via.placeholder.com/100x100?text=Logo' ?>" 
                                             alt="Logo" class="border rounded" 
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                    <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                    <small class="text-muted">Usado para favicon y marca. Recomendado: 100x100px</small>
                                </div>
                                
                                <!-- Foto de Presentación -->
                                <div class="mb-3">
                                    <label class="form-label">Foto de Presentación</label>
                                    <div class="text-center mb-2">
                                        <img id="preview_foto_presentacion" src="<?= !empty($empresa['foto_presentacion']) ? base_url('uploads/' . $empresa['foto_presentacion']) : 'https://via.placeholder.com/300x200?text=Foto+Presentaci%C3%B3n' ?>" 
                                             alt="Foto Presentación" class="border rounded" 
                                             style="width: 300px; height: 200px; object-fit: cover;">
                                    </div>
                                    <input type="file" class="form-control" id="foto_presentacion" name="foto_presentacion" accept="image/*">
                                    <small class="text-muted">Mostrada en el menú de restaurantes. Recomendado: 800x600px</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Empresa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function editarUsuario(id, nombre, email, foto) {
        document.getElementById('edit_user_id').value = id;
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_password').value = '';
        
        // Cargar foto actual
        const previewImg = document.getElementById('preview_foto');
        if (foto && foto.trim() !== '') {
            previewImg.src = '<?= base_url('uploads/') ?>' + foto;
        } else {
            previewImg.src = '<?= base_url('assets/images/avatars/01.png') ?>';
        }
        
        new bootstrap.Modal(document.getElementById('editarUsuarioModal')).show();
    }
    
    // Preview de foto
    document.getElementById('foto_perfil').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_foto').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Preview de logo
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_logo').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Preview de foto de presentación
    document.getElementById('foto_presentacion').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview_foto_presentacion').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>

<?= $this->include('Admin/templates/footer') ?>