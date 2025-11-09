<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Admin Routes（管理画面）
 * --------------------------------------------------------------------
 */
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin-auth'], static function ($routes) {
    // ダッシュボード
    $routes->get('', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('dashboard/analytics', 'DashboardController::analytics');
    
    // テンプレート管理
    $routes->resource('templates', ['controller' => 'Template\TemplateController']);
    $routes->get('templates/(:num)/preview', 'Template\TemplateController::preview/$1');
    $routes->post('templates/(:num)/duplicate', 'Template\TemplateController::duplicate/$1');
    
    // カテゴリ管理
    $routes->resource('categories', ['controller' => 'Template\CategoryController']);
    
    // バージョン管理
    $routes->get('templates/(:num)/versions', 'Template\VersionController::index/$1');
    $routes->post('templates/(:num)/versions/(:num)/restore', 'Template\VersionController::restore/$1/$2');
});

// 管理画面ログイン（認証フィルター適用除外）
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login', 'Auth\LoginController::login');
    $routes->get('logout', 'Auth\LogoutController::index');
});

/*
 * --------------------------------------------------------------------
 * Front Routes（フロント画面）
 * --------------------------------------------------------------------
 */
$routes->group('/', ['namespace' => 'App\Controllers\Front'], static function ($routes) {
    // ホーム
    $routes->get('', 'Home::index');
    
    // テンプレート閲覧
    $routes->get('templates', 'Template\TemplateViewController::index');
    $routes->get('templates/(:segment)', 'Template\TemplateViewController::show/$1');
    $routes->get('search', 'Template\TemplateSearchController::index');
    
    // 認証
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login', 'Auth\LoginController::login');
    $routes->get('register', 'Auth\RegisterController::index');
    $routes->post('register', 'Auth\RegisterController::register');
    $routes->get('logout', 'Auth\LogoutController::index');
});

