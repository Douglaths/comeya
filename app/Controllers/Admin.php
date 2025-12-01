<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\VentaModel;
use App\Models\VisitaModel;

class Admin extends BaseController
{
    protected $empresaModel;
    protected $ventaModel;
    protected $visitaModel;

    public function __construct()
    {
        $this->empresaModel = new EmpresaModel();
        $this->ventaModel = new VentaModel();
        $this->visitaModel = new VisitaModel();
        
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            redirect()->to(base_url('login'))->send();
            exit;
        }
    }
    
    private function getEmpresaId()
    {
        return session()->get('empresa_id') ?? 1;
    }

    public function index()
    {
        try {
            $empresaId = $this->getEmpresaId();
            $pedidoModel = new \App\Models\PedidoModel();
            $pedidoItemModel = new \App\Models\PedidoItemModel();
            $productoModel = new \App\Models\ProductoModel();
            
            // Obtener pedidos recientes del restaurante
            $data['pedidos'] = $pedidoModel->where('empresa_id', $empresaId)->orderBy('fecha_pedido', 'DESC')->limit(10)->findAll();
            
            // Estadísticas del día
            $pedidosHoy = $pedidoModel->where('empresa_id', $empresaId)->where('DATE(fecha_pedido)', date('Y-m-d'))->countAllResults();
            
            // Ventas del día (suma de totales de pedidos)
            $ventasHoyResult = $pedidoModel->where('empresa_id', $empresaId)
                                          ->where('DATE(fecha_pedido)', date('Y-m-d'))
                                          ->selectSum('total')
                                          ->get()
                                          ->getRow();
            $ventasHoy = $ventasHoyResult ? $ventasHoyResult->total : 0;
            
            // Producto más vendido del último mes
            $productoTopResult = $pedidoItemModel
                ->select('productos.nombre, SUM(pedido_items.cantidad) as total_vendido')
                ->join('pedidos', 'pedidos.id = pedido_items.pedido_id')
                ->join('productos', 'productos.id = pedido_items.producto_id')
                ->where('pedidos.empresa_id', $empresaId)
                ->where('pedidos.fecha_pedido >=', date('Y-m-d', strtotime('-1 month')))
                ->groupBy('pedido_items.producto_id')
                ->orderBy('total_vendido', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();
            
            $data['estadisticas'] = [
                'pedidos_hoy' => $pedidosHoy,
                'ventas_hoy' => $ventasHoy ?? 0,
                'producto_top' => $productoTopResult ? $productoTopResult['nombre'] : 'Sin ventas',
                'producto_top_cantidad' => $productoTopResult ? $productoTopResult['total_vendido'] : 0
            ];
        } catch (\Exception $e) {
            $data = [
                'pedidos' => [],
                'estadisticas' => [
                    'pedidos_hoy' => 0,
                    'ventas_hoy' => 0,
                    'producto_top' => 'Sin datos',
                    'producto_top_cantidad' => 0
                ]
            ];
        }

        return view('Admin/inicio', $data);
    }

    public function menu()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        $productoModel = new \App\Models\ProductoModel();
        $empresaId = $this->getEmpresaId();
        
        $data = [
            'categorias' => $categoriaModel->where('empresa_id', $empresaId)->orderBy('orden', 'ASC')->findAll(),
            'productos' => $productoModel->where('empresa_id', $empresaId)->findAll()
        ];
        
        return view('Admin/menu', $data);
    }

    public function crearProducto()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        $empresaId = $this->getEmpresaId();
        $data['categorias'] = $categoriaModel->where('empresa_id', $empresaId)->where('activo', 1)->findAll();
        
        return view('Admin/crear_producto', $data);
    }

    public function storeProducto()
    {
        $productoModel = new \App\Models\ProductoModel();
        $empresaId = $this->getEmpresaId();
        
        $data = [
            'empresa_id' => $empresaId,
            'categoria_id' => $this->request->getPost('categoria_id'),
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio'),
            'activo' => 1
        ];
        
        // Manejar subida de imagen
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }
        
        if ($productoModel->save($data)) {
            return redirect()->to(base_url('admin/menu'))->with('success', 'Producto creado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al crear el producto');
        }
    }

    public function toggleProducto($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($id);
        
        if ($producto) {
            $nuevoEstado = $producto['activo'] ? 0 : 1;
            $result = $productoModel->update($id, ['activo' => $nuevoEstado]);
            return $this->response->setJSON(['success' => $result]);
        }
        
        return $this->response->setJSON(['success' => false]);
    }

    public function toggleDestacado($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($id);
        
        if ($producto) {
            $nuevoEstado = isset($producto['destacado']) && $producto['destacado'] ? 0 : 1;
            $result = $productoModel->update($id, ['destacado' => $nuevoEstado]);
            return $this->response->setJSON(['success' => $result]);
        }
        
        return $this->response->setJSON(['success' => false]);
    }

    public function crearCategoria()
    {
        return view('Admin/crear_categoria');
    }

    public function storeCategoria()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        $empresaId = $this->getEmpresaId();
        
        $data = [
            'empresa_id' => $empresaId,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'orden' => $categoriaModel->where('empresa_id', $empresaId)->countAllResults() + 1,
            'activo' => 1
        ];
        
        if ($categoriaModel->save($data)) {
            return redirect()->to(base_url('admin/menu'))->with('success', 'Categoría creada exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al crear la categoría');
        }
    }

    public function editarProducto($id)
    {
        $productoModel = new \App\Models\ProductoModel();
        $categoriaModel = new \App\Models\CategoriaModel();
        
        $empresaId = $this->getEmpresaId();
        $data = [
            'producto' => $productoModel->find($id),
            'categorias' => $categoriaModel->where('empresa_id', $empresaId)->where('activo', 1)->findAll()
        ];
        
        if (!$data['producto']) {
            return redirect()->to(base_url('admin/menu'))->with('error', 'Producto no encontrado');
        }
        
        return view('Admin/editar_producto', $data);
    }

    public function updateProducto($id)
    {
        $productoModel = new \App\Models\ProductoModel();
        
        $data = [
            'categoria_id' => $this->request->getPost('categoria_id'),
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precio' => $this->request->getPost('precio')
        ];
        
        // Manejar subida de imagen
        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }
        
        if ($productoModel->update($id, $data)) {
            return redirect()->to(base_url('admin/menu'))->with('success', 'Producto actualizado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el producto');
        }
    }

    public function verProducto($id)
    {
        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($id);
        
        if ($producto) {
            return $this->response->setJSON(['success' => true, 'producto' => $producto]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function pedidos()
    {
        $pedidoModel = new \App\Models\PedidoModel();
        
        // Filtros
        $fecha = $this->request->getGet('fecha') ?? date('Y-m-d');
        $estado = $this->request->getGet('estado') ?? '';
        
        $empresaId = $this->getEmpresaId();
        $query = $pedidoModel->where('empresa_id', $empresaId);
        
        if ($fecha) {
            $query->where('DATE(fecha_pedido)', $fecha);
        }
        
        if ($estado) {
            $query->where('estado', $estado);
        }
        
        $data = [
            'pedidos' => $query->orderBy('fecha_pedido', 'DESC')->findAll(),
            'fecha_filtro' => $fecha,
            'estado_filtro' => $estado
        ];
        
        return view('Admin/pedidos', $data);
    }
    
    public function verPedido($id)
    {
        $pedidoModel = new \App\Models\PedidoModel();
        $pedidoItemModel = new \App\Models\PedidoItemModel();
        
        // Verificar que el pedido pertenece a la empresa del usuario
        $empresaId = $this->getEmpresaId();
        $pedido = $pedidoModel->where('id', $id)->where('empresa_id', $empresaId)->first();
        
        if (!$pedido) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pedido no encontrado']);
        }
        
        // Obtener items del pedido con información del producto
        $items = $pedidoItemModel->select('pedido_items.*, productos.nombre as producto_nombre')
                                ->join('productos', 'productos.id = pedido_items.producto_id')
                                ->where('pedido_id', $id)
                                ->findAll();
        
        return $this->response->setJSON([
            'success' => true,
            'pedido' => $pedido,
            'items' => $items
        ]);
    }
    
    public function cambiarEstadoPedido($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }
        
        $pedidoModel = new \App\Models\PedidoModel();
        $nuevoEstado = $this->request->getPost('estado');
        
        $updateData = ['estado' => $nuevoEstado];
        
        // Add timestamp based on status
        if ($nuevoEstado === 'procesando') {
            $updateData['fecha_procesando'] = date('Y-m-d H:i:s');
        } elseif ($nuevoEstado === 'enviado') {
            $updateData['fecha_enviado'] = date('Y-m-d H:i:s');
        } elseif ($nuevoEstado === 'completado') {
            $updateData['fecha_completado'] = date('Y-m-d H:i:s');
        }
        
        $result = $pedidoModel->update($id, $updateData);
        
        return $this->response->setJSON(['success' => $result]);
    }

    public function plan()
    {
        $empresaModel = new \App\Models\EmpresaModel();
        $facturaModel = new \App\Models\FacturaModel();
        $pagoModel = new \App\Models\PagoModel();
        $planModel = new \App\Models\PlanModel();
        
        // Obtener información de la empresa
        $empresaId = $this->getEmpresaId();
        $empresa = $empresaModel->find($empresaId);
        
        // Obtener facturas de la empresa
        $facturas = $facturaModel->where('empresa_id', $empresaId)
                                 ->orderBy('fecha_emision', 'DESC')
                                 ->limit(10)
                                 ->findAll();
        
        // Obtener pagos realizados
        $pagos = $pagoModel->select('pagos.*, facturas.numero as factura_numero')
                          ->join('facturas', 'facturas.id = pagos.factura_id')
                          ->where('facturas.empresa_id', $empresaId)
                          ->orderBy('pagos.fecha_pago', 'DESC')
                          ->limit(10)
                          ->findAll();
        
        // Obtener información del plan actual
        $planActual = null;
        if ($empresa && isset($empresa['plan'])) {
            $planActual = $planModel->where('nombre', ucfirst($empresa['plan']))->first();
        }
        
        // Calcular próximo vencimiento
        $proximoVencimiento = date('Y-m-d', strtotime('+1 month'));
        if ($empresa['fecha_trial_fin']) {
            $proximoVencimiento = $empresa['fecha_trial_fin'];
        }
        
        $data = [
            'empresa' => $empresa,
            'facturas' => $facturas,
            'pagos' => $pagos,
            'plan_actual' => $planActual,
            'proximo_vencimiento' => $proximoVencimiento
        ];
        
        return view('Admin/plan', $data);
    }

    public function configuracion()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $empresaModel = new \App\Models\EmpresaModel();
        
        // Empresa actual
        $empresaId = $this->getEmpresaId();
        $empresa = $empresaModel->find($empresaId);
        
        // DEBUG: Obtener usuario actual por email
        $userEmail = session()->get('user_email');
        $usuarioActual = $usuarioModel->where('email', $userEmail)->first();
        
        // DEBUG: Mostrar datos
        log_message('debug', 'Email en sesion: ' . $userEmail);
        log_message('debug', 'Usuario encontrado: ' . json_encode($usuarioActual));
        
        $usuario = $usuarioActual ?: [
            'nombre' => session()->get('user_name') ?? 'Usuario',
            'email' => $userEmail,
            'telefono' => '',
            'direccion' => ''
        ];
        
        // Usuarios de la empresa
        $usuarios = $usuarioModel->where('empresa_id', $empresaId)->findAll();
        
        // Decodificar notificaciones
        $notificaciones = [];
        if ($empresa && $empresa['configuracion_notificaciones']) {
            $notificaciones = json_decode($empresa['configuracion_notificaciones'], true) ?? [];
        }
        
        $data = [
            'usuario' => $usuario,
            'empresa' => $empresa,
            'usuarios' => $usuarios,
            'notificaciones' => $notificaciones
        ];
        
        return view('Admin/configuracion', $data);
    }
    
    public function cambiarPassword()
    {
        $passwordActual = $this->request->getPost('password_actual');
        $passwordNuevo = $this->request->getPost('password_nuevo');
        $passwordConfirmar = $this->request->getPost('password_confirmar');
        
        if ($passwordNuevo !== $passwordConfirmar) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }
        
        if (strlen($passwordNuevo) < 6) {
            return redirect()->back()->with('error', 'La contraseña debe tener al menos 6 caracteres');
        }
        
        $empresaId = $this->getEmpresaId();
        $db = \Config\Database::connect();
        
        // Obtener empresa actual
        $empresa = $db->table('empresas')->where('id', $empresaId)->get()->getRowArray();
        
        // Verificar contraseña actual
        $passwordActualValid = false;
        if ($empresa['password']) {
            $passwordActualValid = password_verify($passwordActual, $empresa['password']);
        } else {
            $passwordActualValid = ($passwordActual === '12345678');
        }
        
        if (!$passwordActualValid) {
            return redirect()->back()->with('error', 'Contraseña actual incorrecta');
        }
        
        // Actualizar contraseña
        $hashedPassword = password_hash($passwordNuevo, PASSWORD_DEFAULT);
        $result = $db->table('empresas')
                    ->where('id', $empresaId)
                    ->update(['password' => $hashedPassword]);
        
        if ($result) {
            return redirect()->back()->with('success', 'Contraseña actualizada exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la contraseña');
        }
    }
    
    public function actualizarPerfil()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $empresaId = $this->getEmpresaId();
        $userEmail = session()->get('user_email');
        
        // Buscar usuario actual por email
        $usuarioActual = $usuarioModel->where('email', $userEmail)->first();
        
        $dataUsuario = [
            'nombre' => $this->request->getPost('nombre_usuario'),
            'email' => $this->request->getPost('email_usuario'),
            'telefono' => $this->request->getPost('telefono_usuario'),
            'direccion' => $this->request->getPost('direccion_usuario')
        ];
        
        try {
            // DEBUG
            log_message('debug', 'Datos a actualizar: ' . json_encode($dataUsuario));
            log_message('debug', 'Usuario actual: ' . json_encode($usuarioActual));
            
            if ($usuarioActual) {
                log_message('debug', 'Actualizando usuario ID: ' . $usuarioActual['id']);
                $result = $usuarioModel->update($usuarioActual['id'], $dataUsuario);
                log_message('debug', 'Resultado update: ' . ($result ? 'true' : 'false'));
            } else {
                // Crear usuario si no existe
                $dataUsuario['empresa_id'] = $empresaId;
                $dataUsuario['rol'] = 'admin_empresa';
                $dataUsuario['activo'] = 1;
                $dataUsuario['password'] = password_hash('12345678', PASSWORD_DEFAULT);
                log_message('debug', 'Creando nuevo usuario');
                $result = $usuarioModel->insert($dataUsuario);
                log_message('debug', 'Resultado insert: ' . ($result ? 'true' : 'false'));
            }
            
            if ($result) {
                // Actualizar sesión
                session()->set([
                    'user_name' => $dataUsuario['nombre'],
                    'user_email' => $dataUsuario['email']
                ]);
                return redirect()->back()->with('success', 'Perfil personal actualizado exitosamente');
            } else {
                return redirect()->back()->with('error', 'Error al actualizar el perfil personal');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    public function agregarUsuario()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        
        $empresaId = $this->getEmpresaId();
        $data = [
            'empresa_id' => $empresaId,
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'rol' => 'admin_empresa',
            'activo' => 1
        ];
        
        if ($usuarioModel->save($data)) {
            return redirect()->back()->with('success', 'Usuario agregado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al agregar el usuario');
        }
    }
    
    public function actualizarNotificaciones()
    {
        try {
            $db = \Config\Database::connect();
            
            $notificaciones = [
                'email_pedidos' => $this->request->getPost('email_pedidos') ? true : false,
                'whatsapp_pedidos' => $this->request->getPost('whatsapp_pedidos') ? true : false,
                'email_reportes' => $this->request->getPost('email_reportes') ? true : false
            ];
            
            $empresaId = $this->getEmpresaId();
            $result = $db->table('empresas')
                         ->where('id', $empresaId)
                         ->update(['configuracion_notificaciones' => json_encode($notificaciones)]);
            
            return redirect()->to(base_url('admin/configuracion'))->with('success', 'Notificaciones actualizadas exitosamente');
        } catch (\Exception $e) {
            return redirect()->to(base_url('admin/configuracion'))->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function eliminarProducto($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $productoModel = new \App\Models\ProductoModel();
        $result = $productoModel->delete($id);
        
        return $this->response->setJSON(['success' => $result]);
    }

    public function toggleEmpresa()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $json = $this->request->getJSON();
        $empresaId = $json->empresa_id;
        $activo = $json->activo;

        $result = $this->empresaModel->update($empresaId, ['activo' => $activo]);

        return $this->response->setJSON(['success' => $result]);
    }

    public function actualizarUsuario()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $userId = $this->request->getPost('user_id');
        $empresaId = $this->getEmpresaId();
        
        // Verificar que el usuario pertenece a la empresa
        $usuarioActual = $usuarioModel->where('id', $userId)->where('empresa_id', $empresaId)->first();
        if (!$usuarioActual) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        
        $data = [
            'nombre' => $this->request->getPost('nombre')
        ];
        
        // Actualizar contraseña si se proporciona
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        
        // Manejar subida de foto
        $foto = $this->request->getFile('foto_perfil');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $nombreFoto = $foto->getRandomName();
            if ($foto->move(FCPATH . 'uploads', $nombreFoto)) {
                $data['foto_perfil'] = $nombreFoto;
            }
        }
        
        try {
            $db = \Config\Database::connect();
            $result = $db->table('usuarios')->where('id', $userId)->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error en base de datos: ' . $e->getMessage());
        }
        
        if ($result) {
            // Actualizar sesión si es el usuario actual
            if (session()->get('user_email') === $usuarioActual['email']) {
                $usuarioActualizado = $usuarioModel->find($userId);
                session()->set([
                    'user_name' => $usuarioActualizado['nombre'],
                    'user_photo' => $usuarioActualizado['foto_perfil']
                ]);
            }
            
            return redirect()->to(base_url('admin/configuracion'))->with('success', 'Usuario actualizado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el usuario');
        }
    }
    
    public function actualizarEmpresa()
    {
        $empresaModel = new \App\Models\EmpresaModel();
        $empresaId = $this->getEmpresaId();
        
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'descripcion' => $this->request->getPost('descripcion'),
            'ciudad' => $this->request->getPost('ciudad'),
            'categoria_comida' => $this->request->getPost('categoria_comida')
        ];
        
        // Manejar subida de logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $nombreLogo = $logo->getRandomName();
            if ($logo->move(FCPATH . 'uploads', $nombreLogo)) {
                $data['logo'] = $nombreLogo;
            }
        }
        
        // Manejar subida de foto de presentación
        $fotoPresentacion = $this->request->getFile('foto_presentacion');
        if ($fotoPresentacion && $fotoPresentacion->isValid() && !$fotoPresentacion->hasMoved()) {
            $nombreFoto = $fotoPresentacion->getRandomName();
            if ($fotoPresentacion->move(FCPATH . 'uploads', $nombreFoto)) {
                $data['foto_presentacion'] = $nombreFoto;
            }
        }
        
        if ($empresaModel->update($empresaId, $data)) {
            return redirect()->to(base_url('admin/configuracion'))->with('success', 'Empresa actualizada exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la empresa');
        }
    }
}