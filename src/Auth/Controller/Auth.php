<?php

namespace Hacknet\Auth\Controller;

use Hacknet\Base\BaseController;

class Auth extends BaseController{

    public function login(){
        $this->render('login');
    }

    public function register(){
        $this->render('register');
    }

}