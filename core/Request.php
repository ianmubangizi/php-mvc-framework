<?php  

namespace Mubangizi\Core;

class Request {
  
  public static string $GET = 'get';
  public static string $POST = 'post';

  
  public function path(){
    $path = $_SERVER["REQUEST_URI"] ?? "/";
    $position = strpos($path, "?");
    
    if($position === false) return $path;
    
    return substr($path, 0, $position);
  }
  
  public function method(){
    return strtolower($_SERVER["REQUEST_METHOD"]);
  }
  
  public function is($method){
    return $this->method() === $method;
  } 
  
  public function body(){
      $body = [];
      
      if($this->is(self::$GET)){
          foreach ($_GET as $key => $value) {
             $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
      }
      
      if($this->is(self::$POST)){
          foreach ($_POST as $key => $value) {
             $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
      }
      
      return $body;
  }
}

?>