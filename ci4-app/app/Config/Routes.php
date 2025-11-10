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
    
    // 予約者管理
    $routes->resource('reserver', ['controller' => 'Reserver\ReserverController']);
    
    // 会員管理
    $routes->resource('member', ['controller' => 'Member\MemberController']);
    
    // オプション管理
    $routes->resource('option', ['controller' => 'Option\OptionController']);
    $routes->get('option/(:segment)/stock', 'Option\OptionController::stock/$1');
    
    // レンタカー管理
    $routes->resource('car-rental', ['controller' => 'CarRental\CarRentalController']);
    $routes->get('car-rental/stock', 'CarRental\CarRentalController::stock');
    
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
    
    // 予約フロー
    $routes->get('reservation/step1', 'Reservation\ReservationController::step1');
    $routes->post('reservation/step1', 'Reservation\ReservationController::step1');
    $routes->get('reservation/step2', 'Reservation\ReservationController::step2');
    $routes->post('reservation/step2', 'Reservation\ReservationController::step2');
    $routes->get('reservation/confirm', 'Reservation\ReservationController::confirm');
    $routes->post('reservation/complete', 'Reservation\ReservationController::complete');
    $routes->get('reservation/thanks', 'Reservation\ReservationController::thanks');
    
    // テンプレート閲覧
    $routes->get('templates', 'Template\TemplateViewController::index');
    $routes->get('templates/(:segment)', 'Template\TemplateViewController::show/$1');
    $routes->get('search', 'Template\TemplateSearchController::index');
});

// フロント認証（セッションフィルター適用除外）
$routes->group('auth', ['namespace' => 'App\Controllers\Front\Auth'], static function ($routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('login', 'LoginController::login');
    $routes->get('logout', 'LoginController::logout');
    $routes->get('register', 'RegisterController::index');
    $routes->post('register', 'RegisterController::register');
    $routes->get('register/complete', 'RegisterController::complete');
});

