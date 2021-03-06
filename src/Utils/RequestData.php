<?php

namespace App\Utils;

class RequestData {

    public function get($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function post($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function allGetData() {
        return $_GET;
    }

    public function allPostData() {
        return $_POST;
    }

}