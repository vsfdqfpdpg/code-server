<?php
spl_autoload_register(function ($class) {
    $file = "./src/" . str_replace("\\", DIRECTORY_SEPARATOR, strtolower($class)) . ".php";

    if (file_exists($file)) {
        require_once($file);
    } else if (file_exists($file = "./src/" . strtolower($class) . '.php')) {
        require_once($file);
    }
});
