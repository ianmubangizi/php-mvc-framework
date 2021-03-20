<?php  

namespace framework\core;

class Request {
  
  public function get_path(){
    $path = $_SERVER["REQUEST_URI"] ?? "/";
    $position = strpos($path, "?");
    
    if($position === false) return $path;
    
    return substr($path, 0, $position);
  }
  
  public function get_method(){
    return strtolower($_SERVER["REQUEST_METHOD"]);
  }
  
  public function get_body(){
      
  }
}

?>