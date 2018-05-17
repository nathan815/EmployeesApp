<?php
use App\Routing\Router;
use App\Routing\Route;
use App\Routing\InvalidRouteException;
use App\Controllers\Controller;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('SRC_PATH', BASE_PATH . 'src' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);

session_start();

require_once BASE_PATH . 'src/autoload.php';
require_once BASE_PATH . 'src/helpers.php';

define('APP_NAME', 'Employee App');
define('ENVIRONMENT', env('environment'));

$router = new Router();
$router->addRoute('GET', new Route('/', 'EmployeeController', 'index'));

$router->addRoute('GET', new Route('/employees/{id}/edit', 'EmployeeController', 'edit'));

$router->addRoute('POST', new Route('/employees/{id}/edit', 'EmployeeController', 'editSave'));
$router->addRoute('POST', new Route('/employees/{id}/delete', 'EmployeeController', 'delete'));

$router->addRoute('GET', new Route('/employees/new', 'EmployeeController', 'addForm'));
$router->addRoute('POST', new Route('/employees/new', 'EmployeeController', 'add'));

try {
    $router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch(InvalidRouteException $e) {
    if(ENVIRONMENT == 'local') {
        throw $e;
    }
    // Invalid route, output a 404 error
    $controller = new Controller();
    $controller->outputError(404);
} catch (Exception $e) {
    // Log exception and re-throw
    error_log($e->getMessage());
    throw $e;
}