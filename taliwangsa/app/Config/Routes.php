<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/marketplace', 'Marketplace::index');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::registerProcess');

$routes->get('/orders', 'Client::orders');
$routes->get('/orders/(:num)', 'Client::orderDetail/$1');

$routes->get('/freelancer/dashboard', 'Freelancer::index');
$routes->get('/freelancer/orders', 'Freelancer::orders');
$routes->get('/freelancer/services', 'Freelancer::services');
$routes->get('/freelancer/services/create', 'Freelancer::createService');
$routes->post('/freelancer/services/store', 'Freelancer::storeService');
$routes->get('/freelancer/wallet', 'Freelancer::wallet');
$routes->get('/freelancer/profile', 'Freelancer::profile');
$routes->post('/freelancer/profile/update', 'Freelancer::updateProfile');
$routes->get('/freelancer/chart-data/(:num)', 'Freelancer::chartData/$1');

$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {

    $routes->get('/dashboard', 'Client::index', [
        'filter' => 'role:client'
    ]);

    $routes->get('/freelancer/dashboard', 'Freelancer::index', [
        'filter' => 'role:freelancer'
    ]);

    $routes->get('/admin/dashboard', 'Admin::index', [
        'filter' => 'role:admin'
    ]);

});