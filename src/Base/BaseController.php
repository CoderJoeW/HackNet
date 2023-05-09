<?php
namespace Hacknet\Base;

use Hacknet\Core\Config;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController{

    public Config $config;

    public bool $cliOnly = false;
    public bool $authRequired = false;

    public function runAction($action){
        $this->beforeAction();
        
        if(method_exists($this, $action)){
            $this->$action();
        }else{
            http_response_code(404);
            echo "Action not found.";
        }
        
        $this->afterAction();
    }

    protected function beforeAction(){
        $this->config = new Config(__DIR__ . '/../../config.json');

        if($this->cliOnly){
            $this->handleCliOnly();
        }

        if($this->authRequired){
            $this->handleAuthRequired();
        }
    }

    protected function afterAction(){}

    private function handleCliOnly() {
        if ($this->cliOnly && php_sapi_name() !== 'cli') {
            http_response_code(403);
            echo "Forbidden.";
            exit();
        }
    }

    private function handleAuthRequired() {
        if ($this->authRequired && !isset($_SESSION['LoggedIn'])) {
            header('Location: /auth/login');
            exit();
        }
    }
    
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
