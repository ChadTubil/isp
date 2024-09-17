<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->get('logout', 'Home::logout');
$routes->get('dashboard', 'DashboardController::index');
// USERS
$routes->get('users', 'UsersController::index');
$routes->add('users/delete/(:segment)', 'UsersController::userdelete/$1');
$routes->get('users/add', 'UsersController::useradd');
$routes->post('users/add', 'UsersController::useradd');
$routes->get('users/edit/(:segment)', 'UsersController::useredit/$1');
$routes->post('users/edit/(:segment)', 'UsersController::useredit/$1');