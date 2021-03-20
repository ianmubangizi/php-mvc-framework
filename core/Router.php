<?php  

namespace framework\core;

class Router {
  
  public Request $request;
  public Response $response;
  protected array $routes = [];
  
  public function __construct(Request $request, Response $response){
    $this->request = $request;
    $this->response = $response;
  }
  
  private function set_route($method, $path, $callback){
    $this->routes[$method][$path] = $callback;
  }
  
  public function get($path, $callback){
    $this->set_route('get', $path, $callback);
  }
  
  public function post($path, $callback){
    $this->set_route('post', $path, $callback);
  }
  
  public function resolve(){
   $path = $this->request->get_path();
   $method = $this->request->get_method();
   
   $callback = $this->routes[$method][$path] ?? '404';
   
   if (is_string($callback)) {
     switch ($callback) {
         case '404':
             $this->response->set_status_code(404);
             break;
         default:
             break;
     }
     return (new View)->render($callback);
   }
   
   if(is_array($callback)){
       $callback[0] = new $callback[0]();
   }
   
   return call_user_func($callback, $this);
  } 
}

?>
