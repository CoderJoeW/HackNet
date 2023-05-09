<?php

namespace Hacknet\Core;

use FastRoute;

class Router{
    private $defaultRoute = ['controller' => 'Home', 'action' => 'index'];

    public function handleRoute($routeInfo){
        match($routeInfo[0]) {
            FastRoute\Dispatcher::NOT_FOUND => $this->handleNotFound(),
            FastRoute\Dispatcher::METHOD_NOT_ALLOWED => $this->handleMethodNotAllowed(),
            FastRoute\Dispatcher::FOUND => $this->handleFound($routeInfo[1], $routeInfo[2]),
            default => $this->handleDefault(),
        };
    }

    private function handleNotFound(){
        $this->redirectToDefault();
    }

    private function handleMethodNotAllowed(){
        $this->redirectToDefault();
    }

    private function handleFound($handler, $vars){
        if ($handler === 'dynamic_route') {
            $controller = ucfirst(strtolower($vars['controller'] ?? $this->defaultRoute['controller']));
            $action = strtolower($vars['action'] ?? $this->defaultRoute['action']);

            $controllerClass = "Hacknet\\{$controller}\\Controller\\{$controller}";
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();
                if (method_exists($controllerInstance, $action)) {
                    $controllerInstance->runAction($action);
                    return;
                }
            }
        }
        $this->redirectToDefault();
    }

    private function handleDefault(){
        http_response_code(404);
        echo "Not found.";
    }

    private function redirectToDefault(){
        $controller = $this->defaultRoute['controller'];
        $action = $this->defaultRoute['action'];
        $controllerClass = "Hacknet\\{$controller}\\Controller\\{$controller}";
        if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->runAction($action);
                return;
            }
        }
        $this->handleDefault();
    }
}