<?php

namespace Mubangizi\Core;

class View {
    
    public $layout;
    public $views;
    protected $partials = [
      '{{footer}}' => 'layouts/partials/footer',
      '{{navigation}}' => 'layouts/partials/navbar'];
      
    protected $extras = [
      '{{meta_tags}}' => [],
      '{{stylesheet}}' => [],
      '{{javascript}}' => []
    ];
    
    public function __construct($layout = 'base'){
        $this->layout = $layout;
        $this->views = Application::$ROOT_DIR . '/views';
    }
    
    public function add_extra(string $tag, string  ...$tags){
      array_merge(
      $this->extras["{{$tag}}"], $tags);
    }
    
    public function set_html($partial, $markup){
      $this->partials[$partial] = $markup;
    }
    
    public function render($view, $params = []){
      $exists = file_exists
      ("{$this->views}/$view.php");
      
      $view = $exists ? $view : 'error';
      
      $layout = $this->get($this->layout);
      $this->set_html('{{content}}', $this->get_view_content($view, $params));
      
      foreach($this->partials as $partial => $value)
      {
        $file = "{$this->views}/$value.php";
        if($partial !== '{{content}}'){
          $value = file_exists($file)
          ? $this->load($file)
          : '';
        } 
        $layout = str_replace($partial, $value, $layout);
      }
      
      foreach($this->extras as $extra => $tags){
        $layout = str_replace($extra, array_reduce($tags, function($tag_string, $tag){
          return $tag_string . PHP_EOL . $tag;
        }, ''), $layout);
      } 
      
      return $layout;
    }
  
    protected function get($layout) {
      return $this->load("{$this->views}/layouts/{$layout}.php");
    }
    
    protected function load($file){
      ob_start();
      include_once($file);
      return ob_get_clean();
    }
  
    protected function get_view_content($view, $params = []){
      foreach($params as $key => $value){
        $$key = $value;
      }
      return $this->load("{$this->views}/$view.php");
    }

}