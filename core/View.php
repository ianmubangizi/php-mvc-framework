<?php

namespace framework\core;

class View {
    
    protected $layout;
    
    public function ($layout = 'main'){
        $this->layout = $layout;
    }
    
    public function render($view, $params = []){
      $layout = $this->get_layout();
      $content = $this->get_view_content($view, $params);
      return str_replace('{{content}}', $content, $layout);
    }
  
    protected function get_layout(){
      ob_start();
      include_once(Application::$ROOT_DIR . "/views/layouts/{$this->layout}.php");
      return ob_get_clean();
    }
  
  
    protected function get_view_content($view, $params = []){
      foreach($params as $key => $value){
        $$key = $value;
      }
      ob_start();
      include_once(Application::$ROOT_DIR . "/views/$view.php");
      return ob_get_clean();
    }

}