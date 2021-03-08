<?php  

namespace framework\core;

class Router {
  
  public Request $request;
  protected array $routes = [];
  
  public function __construct(Request $request){
    $this->request = $request;
  }
  
  public function get($path, $callback){
    $this->routes['get'][$path] = $callback;
  }
  
  public function resolve(){
   $path = $this->request->getPath();
   $method = $this->request->getMethod();
   
   var_dump($path, $method);
   
   
   $callback = $this->routes[$method][$path] ?? false;
   var_dump($callback);
   if ($callback === false){
     echo "Not Found";
     exit;
   }
   
   return call_user_func($callback);
   
  } 
}

?>