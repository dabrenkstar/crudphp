<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('empleados', ['controller' => 'Empleado', 'action' => 'index']);
$router->add('empleados/create', ['controller' => 'Empleado', 'action' => 'create']);
$router->add('empleados/store', ['controller' => 'Empleado', 'action' => 'store']);
$router->add('empleados/{id:\d+}/edit', ['controller' => 'Empleado', 'action' => 'edit']);
$router->add('empleados/{id:\d+}/update', ['controller' => 'Empleado', 'action' => 'update']);
$router->add('empleados/{id:\d+}/delete', ['controller' => 'Empleado', 'action' => 'delete']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
