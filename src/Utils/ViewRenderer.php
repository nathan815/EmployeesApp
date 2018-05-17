<?php
namespace App\Utils;

class ViewRenderer {
    const DEFAULT_BASE_TEMPLATE = 'template/base';
    private $baseTemplate;
    private $params = [];

    public function __construct() {
        $this->setBaseTemplate(self::DEFAULT_BASE_TEMPLATE);
    }

    public function assign($key, $value) {
        $this->params[$key] = $value;
    }
    public function massAssign($params) {
        $this->params = array_merge($this->params, $params);
    }

    public function setBaseTemplate($view) {
        if($view) {
            $view = $this->getViewPath($view);
        }
        $this->baseTemplate = $view;
    }

    public function render($view, $params = []) {
        if($params) {
            $this->massAssign($params);
        }
        $view = $this->getViewPath($view);
        $this->validateViewExists($view);
        ob_start();
        if($this->baseTemplate) {
            $this->assign('content_view', $view);
            $this->includeView($this->baseTemplate, $this->params);
        }
        else {
            $this->includeView($view, $this->params);
        }
        ob_end_flush();
    }

    public static function includeView($view, $params = null) {
        if($params) {
            extract($params); // turn view parameters into in-scope variables
        }
        include $view;
    }

    public static function getViewPath($view) {
        $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
        return VIEW_PATH . $view . '.php';
    }

    private function validateViewExists($view) {
        if(!file_exists($view)) {
            throw new \InvalidArgumentException('View not found: ' . $view);
        }
    }
}