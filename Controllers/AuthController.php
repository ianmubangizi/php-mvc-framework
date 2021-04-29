<?php

namespace Mubangizi\Controllers;

use Mubangizi\Models\User;
use Mubangizi\Models\Auth;
use Mubangizi\Core\Request;
use Mubangizi\Core\Response;
use Mubangizi\Core\Controller;
use Mubangizi\Core\Application;
use Mubangizi\Core\Widget\Alert;

class AuthController extends Controller
{

  public function login(Request $request, Response $response)
  {
    $this->set_layout('auth');
    $auth = new Auth();
    if ($request->is('post')) {
      $auth->data($request->body());
      if ($auth->is_valid()) {
        $auth->login();
      }
    }
    return $this->render('auth/login', [
      'model' => $auth
    ]);
  }

  public function register(Request $request, Response $response)
  {
    $this->set_layout('auth');
    $user = new User();
    if ($request->is('post')) {
      $user->data($request->body());
      if ($user->is_valid() && $user->save()) {
        Application::$app->alert("Welcome $user, you have created your new account", Alert::SUCCESS);
        return $response->redirect('/');
      }
    }

    return $this->render('auth/register', [
      'model' => $user,
    ]);
  }
}
