<?php

spl_autoload_register(function($class) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classPath = str_replace('App', '', $classPath);
    $classPath = trim($classPath, DIRECTORY_SEPARATOR);
    $file = SRC_PATH . $classPath . '.php';
    if(file_exists($file)) {
        require $file;
    }
});