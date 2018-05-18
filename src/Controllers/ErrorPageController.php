<?php
namespace App\Controllers;

class ErrorPageController extends Controller {

    public function unhandledException(\Exception $e) {
        $this->view->assign('name', get_class($e));
        $this->view->assign('exception_message', $e->getMessage());
        $this->view->assign('line', $e->getLine());
        $this->view->assign('file', $e->getFile());
        $this->view->assign('stackTrace', $e->getTraceAsString());
        $this->view->render('error/unhandled_exception');
    }

}