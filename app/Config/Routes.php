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
// EMPLOYEES
$routes->get('employees', 'EmployeesController::index');
$routes->get('employees/add', 'EmployeesController::employeesadd');
$routes->post('employees/add', 'EmployeesController::employeesadd');
$routes->add('employees/delete/(:segment)', 'EmployeesController::employeedelete/$1');
$routes->get('employees/edit/(:segment)', 'EmployeesController::employeesedit/$1');
$routes->post('employees/edit/(:segment)', 'EmployeesController::employeesedit/$1');
// STATUS
$routes->get('status', 'StatusController::index');
$routes->get('status/add', 'StatusController::statusadd');
$routes->post('status/add', 'StatusController::statusadd');
$routes->add('status/delete/(:segment)', 'StatusController::statusdelete/$1');
$routes->get('status/edit/(:segment)', 'StatusController::statusedit/$1');
$routes->post('status/edit/(:segment)', 'StatusController::statusedit/$1');
// POSITION
$routes->get('position', 'PositionController::index');
$routes->get('position/add', 'PositionController::positionadd');
$routes->post('position/add', 'PositionController::positionadd');
$routes->add('position/delete/(:segment)', 'PositionController::positiondelete/$1');
$routes->get('position/edit/(:segment)', 'PositionController::positionedit/$1');
$routes->post('position/edit/(:segment)', 'PositionController::positionedit/$1');