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
    }

    public function index()
    {
        try {
            // Obtener pedidos recientes del restaurante (empresa_id = 1 como ejemplo)
            $pedidoModel = new \App\Models\PedidoModel();
            $data['pedidos'] = $pedidoModel->where('empresa_id', 1)->orderBy('fecha_pedido', 'DESC')->limit(10)->findAll();
            
            // Estadísticas específicas del restaurante
            $data['estadisticas'] = [
                'pedidos_hoy' => $pedidoModel->where('empresa_id', 1)->where('DATE(fecha_pedido)', date('Y-m-d'))->countAllResults(),
                'ventas_hoy' => $this->ventaModel->where('empresa_id', 1)->where('DATE(fecha_venta)', date('Y-m-d'))->selectSum('total')->get()->getRow()->total ?? 0,
                'producto_top' => 'Capuchino',
                'producto_top_cantidad' => 12
            ];
        } catch (\Exception $e) {
            $data = [
                'pedidos' => [],
                'estadisticas' => [
                    'pedidos_hoy' => 8,
                    'ventas_hoy' => 156000,
                    'producto_top' => 'Capuchino',
                    'producto_top_cantidad' => 12
                ]
            ];
        }

        return view('Admin/inicio', $data);
    }

    public function menu()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        $productoModel = new \App\Models\ProductoModel();
        
        $data = [
            'categorias' => $categoriaModel->where('empresa_id', 1)->orderBy('orden', 'ASC')->findAll(),
            'productos' => $productoModel->where('empresa_id', 1)->findAll()
        ];
        
        return view('Admin/menu', $data);
    }

    public function crearProducto()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        $data['categorias'] = $categoriaModel->where('empresa_id', 1)->where('activo', 1)->findAll();
        
        return view('Admin/crear_producto', $data);
    }

    public function storeProducto()
    {
        $productoModel = new \App\Models\ProductoModel();
        
        $data = [
            'empresa_id' => 1,
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

    public function crearCategoria()
    {
        return view('Admin/crear_categoria');
    }

    public function storeCategoria()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        
        $data = [
            'empresa_id' => 1,
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'orden' => $categoriaModel->where('empresa_id', 1)->countAllResults() + 1,
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
        
        $data = [
            'producto' => $productoModel->find($id),
            'categorias' => $categoriaModel->where('empresa_id', 1)->where('activo', 1)->findAll()
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
        
        $query = $pedidoModel->where('empresa_id', 1);
        
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
        $productoModel = new \App\Models\ProductoModel();
        
        $pedido = $pedidoModel->find($id);
        
        if (!$pedido) {
            return $this->response->setJSON(['success' => false]);
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
        
        $result = $pedidoModel->update($id, ['estado' => $nuevoEstado]);
        
        return $this->response->setJSON(['success' => $result]);
    }

    public function plan()
    {
        $empresaModel = new \App\Models\EmpresaModel();
        $facturaModel = new \App\Models\FacturaModel();
        $pagoModel = new \App\Models\PagoModel();
        $planModel = new \App\Models\PlanModel();
        
        // Obtener información de la empresa (ID 1 como ejemplo)
        $empresa = $empresaModel->find(1);
        
        // Obtener facturas de la empresa
        $facturas = $facturaModel->where('empresa_id', 1)
                                 ->orderBy('fecha_emision', 'DESC')
                                 ->limit(10)
                                 ->findAll();
        
        // Obtener pagos realizados
        $pagos = $pagoModel->select('pagos.*, facturas.numero as factura_numero')
                          ->join('facturas', 'facturas.id = pagos.factura_id')
                          ->where('facturas.empresa_id', 1)
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
        
        // Usuario actual (simulado como ID 1)
        $usuario = $usuarioModel->find(1);
        $empresa = $empresaModel->find(1);
        
        // Usuarios de la empresa
        $usuarios = $usuarioModel->where('empresa_id', 1)->findAll();
        
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
        $usuarioModel = new \App\Models\UsuarioModel();
        
        $passwordActual = $this->request->getPost('password_actual');
        $passwordNuevo = $this->request->getPost('password_nuevo');
        $passwordConfirmar = $this->request->getPost('password_confirmar');
        
        if ($passwordNuevo !== $passwordConfirmar) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }
        
        // Actualizar contraseña (en producción verificar la actual)
        $data = ['password' => password_hash($passwordNuevo, PASSWORD_DEFAULT)];
        
        if ($usuarioModel->update(1, $data)) {
            return redirect()->back()->with('success', 'Contraseña actualizada exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la contraseña');
        }
    }
    
    public function actualizarPerfil()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $empresaModel = new \App\Models\EmpresaModel();
        
        $dataUsuario = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email')
        ];
        
        $dataEmpresa = [
            'nombre' => $this->request->getPost('nombre_empresa'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion')
        ];
        
        $usuarioActualizado = $usuarioModel->update(1, $dataUsuario);
        $empresaActualizada = $empresaModel->update(1, $dataEmpresa);
        
        if ($usuarioActualizado && $empresaActualizada) {
            return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el perfil');
        }
    }
    
    public function agregarUsuario()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        
        $data = [
            'empresa_id' => 1,
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
            
            $result = $db->table('empresas')
                         ->where('id', 1)
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
}