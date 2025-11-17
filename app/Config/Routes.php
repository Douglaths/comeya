<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/restaurantes', 'Restaurantes::index');

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
