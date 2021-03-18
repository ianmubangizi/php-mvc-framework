<?php 

namespace framework\controllers;

use framework\core\View;

abstract class Controller {
    
    protected View $view;
    
    public function __construct(View $view = new View){
       $this->view = $view;
    }
   
    public function render($view, $params = []){
       return $this->view->render($view, $params);
    }
}
