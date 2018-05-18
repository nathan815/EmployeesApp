<?php

function value_or_default($value, $default) {
    return isset($value) ? $value : $default;
}

function view_path($view) {
    return \App\Utils\ViewRenderer::getViewPath($view);
}

function include_view_with_params($view, $params) {
    $view = view_path($view);
    \App\Utils\ViewRenderer::includeView($view, $params);
}

function env($key) {
    $envFile = BASE_PATH . 'env.ini';
    if(!file_exists($envFile)) {
        throw new \Exception("env.ini file not found");
    }
    if(!isset($_ENV['envConfig'])) {
        $_ENV['envConfig'] = parse_ini_file($envFile);
    }
    return $_ENV['envConfig'][$key];
}