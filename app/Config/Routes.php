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
