<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Admin Routes
 * --------------------------------------------------------------------
 */
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('dashboard/analytics', 'DashboardController::analytics');
});
