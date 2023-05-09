<?php

namespace Hacknet\Core;

class Autoloader
{
    public function autoloadControllers($class)
    {
        $prefix = 'src/';
        $base_dir = __DIR__ . '/../' . $prefix;
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }
        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
}