<?php

namespace Mubangizi\Core;

use Mubangizi\Core\Widget\Alert;

class Application
{

  public Router $router;
  public Session $session;
  public Request $request;
  public Response $response;
  public Database $database;
  public Controller $controller;
  public static string $ROOT_DIR;
  public static Application $app;

  public function __construct($root_path, array $config)
  {
    self::$app = $this;
    self::$ROOT_DIR = $root_path;
    $this->session = new Session();
    $this->request = new Request();
    $this->response = new Response();
    $this->database = new Database($config['DATABASE']);
    $this->router = new Router($this->request, $this->response);
  }

  public function run()
  {
    echo $this->router->resolve();
  }

  public function set_controller(Controller $class)
  {
    $this->controller = $class;
  }

  public function get_controller()
  {
    return $this->controller;
  }

  public static function log(string $message)
  {
    echo '[' . date('Y-m-d - h:i:s') . ']: ' . $message . PHP_EOL;
  }

  public function display_alert_message(): string
  {
    $alert = $this->session->get('alert');
    if ($alert) {
      if ($alert->displayed) {
        $this->session->remove('alert');
      } else {
        $alert->displayed = true;
        return $alert;
      }
    }
    return '';
  }

  public function alert($message, $type)
  {
    $this->session->set('alert', new Alert($message, $type));
  }
}
