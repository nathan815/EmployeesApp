<?php

function value_or_default($value, $default) {
    return isset($value) ? $value : $default;
}

function include_view($path, $params = null) {
    if ($params) {
        extract($params);
    }
    include VIEW_PATH  . $path . '.php';
}

function env($key) {
    if(!isset($_ENV['envConfig'])) {
        $_ENV['envConfig'] = parse_ini_file(BASE_PATH . 'env.ini');
    }
    return $_ENV['envConfig'][$key];
}