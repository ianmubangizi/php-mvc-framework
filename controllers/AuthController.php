<?php

namespace framework\controllers;

class AuthController {
    
    public function login(){
        return $this->render('auth/login');
    }
    
    public function register(){
        return $this->render('auth/register');
    }
}