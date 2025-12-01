<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/restaurante/(:num)', 'Restaurantes::ver/$1');
$routes->get('/restaurantes', 'Restaurantes::index');
$routes->get('/restaurantes/confirmar-pedido', 'Restaurantes::confirmarPedido');

// Rutas del Carrito
$routes->post('carrito/agregar', 'Carrito::agregar');
$routes->post('carrito/actualizar', 'Carrito::actualizar');
$routes->post('carrito/eliminar', 'Carrito::eliminar');
$routes->get('carrito/obtener', 'Carrito::obtener');
$routes->post('carrito/limpiar', 'Carrito::limpiar');
$routes->post('carrito/confirmar-limpieza', 'Carrito::confirmarLimpieza');

// Rutas de Pedidos
$routes->post('pedidos/crear', 'Pedidos::crear');

// Rutas de Notificaciones
$routes->get('notificaciones/stream', 'Notificaciones::stream');
$routes->get('notificaciones/check', 'Notificaciones::checkNuevosPedidos');
$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->get('/registro', 'Registro::index');
$routes->post('/registro/solicitar', 'Registro::solicitar');
$routes->get('/password/forgot', 'Password::forgot');
$routes->post('/password/send-reset', 'Password::sendReset');
$routes->get('/password/reset/(:any)', 'Password::reset/$1');
$routes->post('/password/update', 'Password::updatePassword');
$routes->get('uploads/(:any)', function($filename) {
    $filepath = FCPATH . 'uploads/' . $filename;
    if (file_exists($filepath)) {
        $mime = mime_content_type($filepath);
        header('Content-Type: ' . $mime);
        readfile($filepath);
        exit;
    }
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
});

// Rutas del Admin
$routes->get('admin', 'Admin::index');
$routes->get('admin/menu', 'Admin::menu');
$routes->get('admin/productos/crear', 'Admin::crearProducto');
$routes->post('admin/productos/store', 'Admin::storeProducto');
$routes->get('admin/productos/editar/(:num)', 'Admin::editarProducto/$1');
$routes->post('admin/productos/update/(:num)', 'Admin::updateProducto/$1');
$routes->post('admin/productos/toggle/(:num)', 'Admin::toggleProducto/$1');
$routes->post('admin/productos/toggle-destacado/(:num)', 'Admin::toggleDestacado/$1');
$routes->post('admin/productos/eliminar/(:num)', 'Admin::eliminarProducto/$1');
$routes->get('admin/productos/ver/(:num)', 'Admin::verProducto/$1');
$routes->get('admin/pedidos', 'Admin::pedidos');
$routes->get('admin/pedidos/ver/(:num)', 'Admin::verPedido/$1');
$routes->post('admin/pedidos/cambiar-estado/(:num)', 'Admin::cambiarEstadoPedido/$1');
$routes->get('admin/reportes', 'Reportes::index');
$routes->get('admin/reportes/exportar-excel', 'Reportes::exportarExcel');
$routes->get('admin/plan', 'Admin::plan');
$routes->get('admin/configuracion', 'Admin::configuracion');
$routes->post('admin/cambiar-password', 'Admin::cambiarPassword');
$routes->post('admin/actualizar-perfil', 'Admin::actualizarPerfil');
$routes->post('admin/agregar-usuario', 'Admin::agregarUsuario');
$routes->post('admin/actualizar-usuario', 'Admin::actualizarUsuario');
$routes->post('admin/actualizar-notificaciones', 'Admin::actualizarNotificaciones');
$routes->get('admin/categorias/crear', 'Admin::crearCategoria');
$routes->post('admin/categorias/store', 'Admin::storeCategoria');
$routes->post('admin/toggle-empresa', 'Admin::toggleEmpresa');

// Rutas del Super Admin
$routes->get('/superadmin', 'Superadmin::index');
$routes->post('/superadmin/toggle-empresa', 'Superadmin::toggleEmpresa');
$routes->get('/superadmin/impersonar/(:num)', 'Superadmin::impersonar/$1');

// Rutas de Empresas
$routes->get('/superadmin/empresas', 'Empresas::index');
$routes->get('/superadmin/empresas/crear', 'Empresas::crear');
$routes->post('/superadmin/empresas/store', 'Empresas::store');
$routes->get('/superadmin/empresas/editar/(:num)', 'Empresas::editar/$1');
$routes->post('/superadmin/empresas/actualizar/(:num)', 'Empresas::actualizar/$1');
$routes->get('/superadmin/empresas/inactivas', 'Empresas::inactivas');
$routes->get('/superadmin/empresas/trial', 'Empresas::trial');
$routes->get('/superadmin/empresas/solicitudes', 'Empresas::solicitudes');
$routes->get('/superadmin/empresas/aprobar-solicitud/(:num)', 'Empresas::aprobarSolicitud/$1');
$routes->post('/superadmin/empresas/rechazar-solicitud/(:num)', 'Empresas::rechazarSolicitud/$1');
$routes->get('/superadmin/empresas/impersonar/(:num)', 'Empresas::impersonar/$1');
$routes->post('/superadmin/empresas/cambiar-estado/(:num)', 'Empresas::cambiarEstado/$1');
$routes->post('/superadmin/empresas/cambiar-plan/(:num)', 'Empresas::cambiarPlan/$1');

// Rutas de Ventas
$routes->get('/superadmin/ventas', 'Ventas::index');
$routes->get('/superadmin/ventas/empresas', 'Ventas::empresas');
$routes->get('/superadmin/ventas/productos', 'Ventas::productos');
$routes->get('/superadmin/ventas/pedidos', 'Ventas::pedidos');
$routes->get('/superadmin/ventas/exportar', 'Ventas::exportar');

// Rutas de Analytics
$routes->get('/superadmin/analytics', 'Analytics::index');
$routes->get('/superadmin/analytics/empresas', 'Analytics::empresas');
$routes->get('/superadmin/analytics/dispositivos', 'Analytics::dispositivos');
$routes->get('/superadmin/analytics/origenes', 'Analytics::origenes');

// Rutas de Contabilidad
$routes->get('/superadmin/contabilidad', 'Contabilidad::index');
$routes->get('/superadmin/contabilidad/facturas', 'Contabilidad::facturas');
$routes->get('/superadmin/contabilidad/pagos', 'Contabilidad::pagos');
$routes->get('/superadmin/contabilidad/morosos', 'Contabilidad::morosos');
$routes->get('/superadmin/contabilidad/planes', 'Contabilidad::planes');
$routes->match(['get', 'post'], '/superadmin/contabilidad/crear-plan', 'Contabilidad::crearPlan');
$routes->get('/superadmin/contabilidad/exportar', 'Contabilidad::exportarReporte');

// Rutas de Marketing
$routes->get('/superadmin/marketing', 'Marketing::index');
$routes->get('/superadmin/marketing/campanas', 'Marketing::campanas');
$routes->match(['get', 'post'], '/superadmin/marketing/crear-campana', 'Marketing::crearCampana');
$routes->get('/superadmin/marketing/referidos', 'Marketing::referidos');
$routes->match(['get', 'post'], '/superadmin/marketing/crear-referido', 'Marketing::crearReferido');
$routes->get('/superadmin/marketing/emails', 'Marketing::emails');
$routes->match(['get', 'post'], '/superadmin/marketing/crear-email', 'Marketing::crearEmail');

// Rutas de Publicidad
$routes->get('/superadmin/publicidad', 'Publicidad::index');
$routes->get('/superadmin/publicidad/promociones', 'Publicidad::promociones');
$routes->match(['get', 'post'], '/superadmin/publicidad/crear-promocion', 'Publicidad::crearPromocion');
$routes->get('/superadmin/publicidad/banners', 'Publicidad::banners');
$routes->match(['get', 'post'], '/superadmin/publicidad/crear-banner', 'Publicidad::crearBanner');
$routes->get('/superadmin/publicidad/material', 'Publicidad::material');
$routes->match(['get', 'post'], '/superadmin/publicidad/crear-material', 'Publicidad::crearMaterial');
$routes->get('/superadmin/publicidad/destacados', 'Publicidad::destacados');
$routes->post('/superadmin/publicidad/toggle-destacado/(:num)', 'Publicidad::toggleDestacado/$1');

// Ruta para restaurantes (debe ir al final)
$routes->get('(:any)', 'Restaurantes::verPorNombre/$1');
