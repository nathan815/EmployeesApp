<?php
namespace App\Utils;

class ViewRenderer {
    const DEFAULT_BASE_TEMPLATE = 'template/base';
    private $baseTemplate;
    private $params;

    public function __construct() {
        $this->setBaseTemplate(self::DEFAULT_BASE_TEMPLATE);
    }

    public function assign($key, $value) {
        $this->params[$key] = $value;
    }

    public function setBaseTemplate($view) {
        if($view) {
            $view = $this->getViewPath($view);
        }
        $this->baseTemplate = $view;
    }

    public function render($view) {
        $view = $this->getViewPath($view);
        $this->validateViewExists($view);
        ob_start();
        if($this->baseTemplate) {
            $this->assign('view_path', $view);
            $this->includeView($this->baseTemplate);
        }
        else {
            $this->includeView($view);
        }
        ob_end_flush();
    }

    private function includeView($view) {
        if($this->params) {
            extract($this->params); // turn view parameters into in-scope variables
        }
        include $view;
    }

    private function validateViewExists($view) {
        if(!file_exists($view)) {
            throw new \InvalidArgumentException('View not found: ' . $view);
        }
    }

    private function getViewPath($view) {
        $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
        return VIEW_PATH . $view . '.php';
    }
}