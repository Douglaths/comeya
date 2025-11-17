<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/restaurantes', 'Restaurantes::index');
$routes->get('/confirmar-pedido', 'Restaurantes::confirmarPedido');
$routes->get('/login', 'Login::index');

// Rutas del Super Admin
$routes->get('/superadmin', 'Superadmin::index');
$routes->post('/superadmin/toggle-empresa', 'Superadmin::toggleEmpresa');
$routes->get('/superadmin/impersonar/(:num)', 'Superadmin::impersonar/$1');

// Rutas de Empresas
$routes->get('/superadmin/empresas', 'Empresas::index');
$routes->get('/superadmin/empresas/crear', 'Empresas::crear');
$routes->post('/superadmin/empresas/store', 'Empresas::store');
$routes->get('/superadmin/empresas/inactivas', 'Empresas::inactivas');
$routes->get('/superadmin/empresas/trial', 'Empresas::trial');
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
