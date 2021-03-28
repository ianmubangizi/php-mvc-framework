<?php

namespace framework\controllers;

use framework\core\Controller;

class AuthController extends Controller {
    
    public function login(){
        return $this->render('auth/login');
    }
    
    public function register(){
        return $this->render('auth/register');
    }
}