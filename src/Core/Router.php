<?php

namespace Hacknet\Core;

use FastRoute;

class Router
{
    public function handleRoute($routeInfo)
    {
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
                            $controllerInstance->runAction($action);
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
    }
}