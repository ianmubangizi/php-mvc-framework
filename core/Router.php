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
  
  public function get($path, $callback){
    $this->routes['get'][$path] = $callback;
  }
  
  public function resolve(){
   $path = $this->request->getPath();
   $method = $this->request->getMethod();
   
   $callback = $this->routes[$method][$path] ?? false;
   
   if ($callback === false){
     Application::$app->response->set_status_code(404);
     return $this->render('404');
   }
  
   if (is_string($callback)) {
     return $this->render($callback);
   }
   
   return call_user_func($callback);
  } 
  
  public function render($view){
      $layout = $this->get_layout();
      $content = $this->get_view_content($view);
      return str_replace('{{content}}', $content, $layout);
  }
  
  protected function get_layout(){
      ob_start();
      include_once(Application::$ROOT_DIR . "/views/layouts/main.php");
      return ob_get_clean();
  }
  
  
  protected function get_view_content($view){
      ob_start();
      include_once(Application::$ROOT_DIR . "/views/$view.php");
      return ob_get_clean();
  }
}

?>