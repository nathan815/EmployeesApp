<?php
namespace App\Routing;

class Router {

    private $routes = [];
    private $allowedMethods = [ 'GET', 'POST', 'PUT', 'DELETE' ];

    public function addRoute($method, Route $route) {
        if(!in_array($method, $this->allowedMethods))
            throw new \InvalidArgumentException('Invalid route method ' . $method);
        $this->routes[$method][] = $route;
    }

    /** @throws InvalidRouteException */
    public function resolve($method, $uri) {
        $route = $this->getRoute($method, $uri);
        if(!$route) {
            throw new InvalidRouteException("Route not found: $method $uri");
        }
        // Instantiate the controller and call the method for this route
        call_user_func_array([ new $route->controller, $route->method ], $route->params);
    }

    private function getRoute($method, $uri) {
        foreach($this->routes[$method] as $route) {
            /** @var $route Route */
            if($route->matchesUri($uri)) {
                return $route;
            }
        }
        return false;
    }

}