<?php  

namespace Mubangizi\Core;

class Application {
  
  public Router $router;
  public Request $request;
  public Response $response;
  public Controller $controller;
  public static string $ROOT_DIR;
  public static Application $app;
  
  public function __construct($root_dir_path){
    self::$app = $this;
    self::$ROOT_DIR = $root_dir_path;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
  }
  
  public function run(){
    echo $this->router->resolve();
  }
  
  public function set_controller(Controller $class){
    $this->controller = $class;
  }
  
  public function get_controller(){
    return $this->controller;
  }
}

?>