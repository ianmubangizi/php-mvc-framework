<?php 

namespace framework\controllers;

abstract class Controller {
    
    protected View $view;
    
    public function __construct(View $view = null){
       $this->view = $view ?? new View;
    }
   
    public function render($view, $params = []){
       return $this->view->render($view, $params);
    }
}
