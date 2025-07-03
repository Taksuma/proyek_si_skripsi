<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ...
// Ganti baris ini
// $routes->get('/', 'Home::index');

// Menjadi seperti ini:
$routes->get('/', 'DashboardController::index');
// ...
