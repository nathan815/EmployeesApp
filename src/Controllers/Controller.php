<?php
namespace App\Controllers;

use App\Database\DatabaseConnection;
use App\Utils\ViewRenderer;
use App\Utils\RequestData;

class Controller {

    protected $database;
    protected $view;
    protected $request;

    public function __construct()
    {
        $this->database = DatabaseConnection::getInstance();
        $this->view = new ViewRenderer();
        $this->request = new RequestData();
    }

    public function outputError($errorCode) {
        http_response_code($errorCode);
        switch($errorCode) {
            case 404:
                $this->view->render('error/404');
                break;
            default:
                echo $errorCode . ' Error';
        }
        exit;
    }

    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    protected function outputJson($data) {
        echo json_encode($data);
        exit;
    }
}