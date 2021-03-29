<?php

namespace Mubangizi\Core;

class View {
    
    public $layout;
    public $views;
    protected $partials = [
      '{{footer}}' => 'layouts/partials/footer',
      '{{navigation}}' => 'layouts/partials/navbar'
      ];
      
    protected $extras = [
      '{{meta_tags}}' => [],
      '{{stylesheet}}' => [],
      '{{javascript}}' => []
    ];
    
    public function __construct($layout = 'main'){
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
      
      foreach($params as $key => $value){
        $$key = $value;
      }
      
      $layout = str_replace('{{view_layout}}', $this->get_layout($this->layout), $this->get_layout('base'));
      $this->set_html('{{content}}', $this->get_view($view));
      
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
  
    protected function load($file){
      ob_start();
      include_once($file);
      return ob_get_clean();
    }
  
    protected function get_layout($layout){
      return $this->load("{$this->views}/layouts/{$layout}.php");
    }
    
    protected function get_view($view){
      return $this->load("{$this->views}/$view.php");
    }

}