<?php

namespace Mubangizi\Controllers;

use Mubangizi\Models\User;
use Mubangizi\Core\Request;
use Mubangizi\Core\Response;
use Mubangizi\Core\Controller;

class AuthController extends Controller {
    
    public function login(Request $request, Response $response){
        $this->set_layout('auth');
        $auth = new User();
        if($request->is('post')){
          $auth->load_data($request->body());
          $auth->validate();
        }
        return $this->render('auth/login', [
          'model' => $auth
        ]);
    }
    
    public function register(Request $request, Response $response){
      $user = new User();
      if($request->is('post')){
          $user->load_data($request->body());
          $user->validate();
      }
      $this->set_layout('auth');
      return $this->render('auth/register', [
        'model' => $user
      ]);
    }
}