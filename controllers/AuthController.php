<?php

namespace Mubangizi\controllers;

use Mubangizi\Core\Controller;

class AuthController extends Controller {
    
    public function login(){
       $this->set_layout('auth');
        return $this->render('auth/login');
    }
    
    public function register(){
      $this->set_layout('auth');
        return $this->render('auth/register');
    }
}