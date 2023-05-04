<?php
require_once 'vendor/autoload.php';

// Autoload controllers
spl_autoload_register(function ($class) {
    $prefix = 'src/';
    $base_dir = __DIR__ . '/' . $prefix;
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/{controller}/{action}', 'dynamic_route');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo "Not found.";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "Method not allowed.";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        if ($handler === 'dynamic_route') {
            $controller = ucfirst(strtolower($vars['controller']));
            $action = strtolower($vars['action']);

            $controllerClass = "Hacknet\\{$controller}\\Controller\\{$controller}";
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();
                if (method_exists($controllerInstance, $action)) {
                    $controllerInstance->$action();
                } else {
                    http_response_code(404);
                    echo "Action not found.";
                }
            } else {
                http_response_code(404);
                echo "Controller not found.";
            }
        }
        break;
}