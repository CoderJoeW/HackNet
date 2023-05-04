<?php
namespace Hacknet\Base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController{
    
    protected function render($view, $data = []){
        $controllerNamespace = get_class($this);

        $viewNamespace = str_replace('Controller', 'View', $controllerNamespace);
        $viewNamespace = substr($viewNamespace, 0, strrpos($viewNamespace, '\\'));
    
        $viewNamespace = str_replace('Hacknet\\', '', $viewNamespace);

        $viewPath = 'src/' . str_replace('\\', '/', $viewNamespace);

        $loader = new FilesystemLoader($viewPath);
    
        $twig = new Environment($loader);
    
        echo $twig->render("{$view}.php", $data);
    }

}
