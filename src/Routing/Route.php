<?php
namespace App\Routing;

class Route {
    public $pattern;
    public $controller;
    public $method;
    public $params;

    public function __construct($pattern, $controller, $method) {
        $controller = 'App\Controllers\\' . $controller;
        if(!class_exists($controller)) {
            throw new \InvalidArgumentException("Controller $controller not found.");
        }
        if(!is_callable([$controller, $method])) {
            throw new \InvalidArgumentException("Method $controller@$method not found.");
        }
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->method = $method;
    }

    public function matchesUri($uri) {
        $regex = $this->getPatternAsRegex();
        $doesMatch = preg_match($regex, $uri, $matches);
        $this->params = $this->removeIntegerIndexes($matches);
        return $doesMatch;
    }

    /**
     * https://stackoverflow.com/questions/30130913
     * @return string
     */
    private function getPatternAsRegex() {
        $pattern = $this->pattern;
        $pattern = preg_replace('#\(/\)#', '/?', $pattern);
        $pattern = preg_replace(
            '/{([a-zA-Z0-9\_\-]+)}/',    # Replace "{parameter}"
            '(?<$1>[a-zA-Z0-9\_\-]+)', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );
        // Add start and end matching
        $patternAsRegex = "@^" . $pattern . "$@D";
        return $patternAsRegex;
    }

    private function removeIntegerIndexes($arr) {
        return array_intersect_key(
            $arr,
            array_flip(array_filter(array_keys($arr), 'is_string'))
        );
    }

}