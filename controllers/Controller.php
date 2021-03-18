<?php 

namespace framework\controllers;

abstract class Controller {
    
    protected View $view;
    
    public function __construct(View $view = new View){
       $this->view = $view;
    }
   
    public function render($view, $params = []){
       return $this->view->render($view, $params);
    }
}
