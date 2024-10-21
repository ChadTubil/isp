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
$routes->get('users/access/(:segment)', 'UsersController::useraccess/$1');
$routes->add('users/link/(:segment)/(:segment)', 'UsersController::userlink/$1/$2');
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
// PLANS
$routes->get('plans', 'PlansController::index');
$routes->get('plans/add', 'PlansController::planadd');
$routes->post('plans/add', 'PlansController::planadd');
$routes->add('plans/delete/(:segment)', 'PlansController::plandelete/$1');
$routes->get('plans/edit/(:segment)', 'PlansController::planedit/$1');
$routes->post('plans/edit/(:segment)', 'PlansController::planedit/$1');
$routes->get('plans/view/(:segment)', 'PlansController::planview/$1');
$routes->get('plans/inclusions/(:segment)', 'PlansController::planinclusion/$1');
$routes->add('plans/inclusions-add/(:segment)/(:segment)', 'PlansController::planinclusionadd/$1/$2');
$routes->add('plans/inclusions-delete/(:segment)/(:segment)', 'PlansController::planinclusiondelete/$1/$2');
// INCLUSIONS
$routes->get('inclusions', 'InclusionsController::index');
$routes->get('inclusions/add', 'InclusionsController::inclusionadd');
$routes->post('inclusions/add', 'InclusionsController::inclusionadd');
$routes->add('inclusions/delete/(:segment)', 'InclusionsController::inclusiondelete/$1');
$routes->get('inclusions/edit/(:segment)', 'InclusionsController::inclusionedit/$1');
$routes->post('inclusions/edit/(:segment)', 'InclusionsController::inclusionedit/$1');
// CLIENTS
$routes->get('register-client', 'ClientsController::index');
$routes->post('register-client', 'ClientsController::index');
$routes->get('clients', 'ClientsController::clients');
$routes->post('clients', 'ClientsController::clients');
$routes->add('clients/delete/(:segment)', 'ClientsController::clientdelete/$1');
$routes->get('clients/edit/(:segment)', 'ClientsController::clientedit/$1');
$routes->post('clients/edit/(:segment)', 'ClientsController::clientedit/$1');
$routes->get('clients/process/(:segment)', 'ClientsController::clientprocess/$1');
$routes->get('clients/process-1/(:segment)/(:segment)', 'ClientsController::clientprocess1/$1/$2');
$routes->add('clients/process-2/(:segment)/(:segment)', 'ClientsController::clientprocess2/$1/$2');
$routes->get('clients-bill-process/(:segment)', 'ClientsController::clientsbill/$1');
$routes->add('clients-bill-process-2/(:segment)', 'ClientsController::clientsbill2/$1');
// BILLS
$routes->get('bills', 'BillsController::index');
$routes->get('bills/view/(:segment)', 'BillsController::view/$1');
$routes->get('bills/print/(:segment)', 'BillsController::print/$1');