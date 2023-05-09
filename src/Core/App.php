<?php

namespace Hacknet\Core;

use FastRoute;

class App{
    private $autoloader;
    private $request;
    private $router;

    public function __construct(){
        $this->autoloader = new Autoloader();
        $this->request = new Request();
        $this->router = new Router();
    }

    public function run(){
        spl_autoload_register([$this->autoloader, 'autoloadControllers']);

        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
            // Default route
            $r->addRoute('GET', '/', ['controller' => 'Home', 'action' => 'index']);
            // Dynamic route
            $r->addRoute('GET', '/{controller}[/{action}]', 'dynamic_route');
        });

        $uri = $this->request->getUri();
        $httpMethod = $this->request->getHttpMethod();

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        $this->router->handleRoute($routeInfo);
    }
}