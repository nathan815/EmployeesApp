<?php
use App\Routing\Router;
use App\Routing\Route;
use App\Routing\InvalidRouteException;
use App\Controllers\ErrorPageController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('SRC_PATH', BASE_PATH . 'src' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', BASE_PATH . 'views' . DIRECTORY_SEPARATOR);

session_start();

require_once SRC_PATH . 'autoload.php';
require_once SRC_PATH . 'helpers.php';

define('APP_NAME', 'Employee App');
define('ENVIRONMENT', env('environment'));

$routes = include SRC_PATH . 'routes.php';
$router = new Router();
foreach($routes as $route) {
    $router->addRoute($route[0], new Route($route[1], $route[2], $route[3]));
}

function display_exception($e) {
    $controller = new ErrorPageController();
    $controller->unhandledException($e);
}

try {

    $router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

} catch(InvalidRouteException $e) {
    if(ENVIRONMENT == 'local') {
        display_exception($e);
    }
    else {
        // Invalid route, output a 404 error
        $controller = new ErrorPageController();
        $controller->outputError(404);
    }
} catch (Exception $e) {
    // Log exception and display on page
    error_log($e->getMessage());
    display_exception($e);
}