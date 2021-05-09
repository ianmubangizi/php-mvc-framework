<?php


namespace Mubangizi\Middlewares;

use Mubangizi\Core\Middleware\Middleware;
use Mubangizi\Core\Model\Auth;

class AuthMiddleware extends Middleware
{
    public function execute()
    {
        if (!Auth::is_guest()) {
        }
        return $this->response->redirect('/');
    }
}
