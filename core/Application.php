<?php  

namespace framework\core;

class Application {
  
  public Router $router;
  public Request $request;
  public static string $ROOT_DIR;
  public static Application $app;
  
  public function __construct($root_dir_path){
    self::$app = $this;
    self::$ROOT_DIR = $root_dir_path;
    $this->request = new Request();
    $this->router = new Router($this->request);
  }
  
  public function run(){
    echo $this->router->resolve();
  }
}

?>