<?php
namespace App\Routing;

class Route {
    public $pattern;
    public $controller;
    public $method;
    public $params;

    public function __construct($pattern, $controller, $method) {
        $controller = 'App\Controllers\\' . $controller;
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->method = $method;
    }

    public function verifyControllerExists() {
        if(!class_exists($this->controller)) {
            throw new \InvalidArgumentException("Controller $this->controller not found.");
        }
    }

    public function verifyMethodExists() {
        if(!is_callable([$this->controller, $this->method])) {
            throw new \InvalidArgumentException("Method $this->controller@$this->method not found.");
        }
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