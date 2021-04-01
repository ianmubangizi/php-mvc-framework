<?php  

namespace Mubangizi\Core;

class Application {
  
  public Router $router;
  public Request $request;
  public Response $response;
  public Database $database;
  public Controller $controller;
  public static string $ROOT_DIR;
  public static Application $app;
  
  public function __construct($root_path, array $config){
    self::$app = $this;
    self::$ROOT_DIR = $root_path;
    $this->request = new Request();
    $this->response = new Response();
    $this->database = new Database($config['DATABASE']);
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