<?php

namespace Mubangizi\Core;

use Mubangizi\Core\Widget\Alert;
use Mubangizi\Core\Exception\HttpException;

class Application
{

  public Router $router;
  public Session $session;
  public Request $request;
  public Response $response;
  public Database $database;
  public Controller $controller;
  public static ?array $auth;
  public static string $ROOT_DIR;
  public static string $auth_table;
  public static Application $app;

  public function __construct($root_path, array $config)
  {
    self::$app = $this;
    self::$ROOT_DIR = $root_path;
    $this->session = new Session();
    $this->request = new Request();
    $this->response = new Response();

    set_exception_handler(function (\Throwable $error) {
      if ($error instanceof HttpException) {
        $this->response->set_status($error->getCode());
      } else {
        $this->response->set_status(500);
      }
      echo (new View)->render('error', [
        'code' => $error->getCode(),
        'message' => $error->getMessage()
      ]);
    });

    $this->database = new Database($config['DATABASE']);
    self::$auth_table = $config['AUTH_TABLE'] ?? 'users';
    $this->router = new Router($this->request, $this->response);

    if (!isset(static::$auth)) static::$auth = Session::get('auth');
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
    $msg_log = '[' . date('Y-m-d - h:i:s') . ']: ' . $message . PHP_EOL;
    error_log($msg_log);
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

  public static function alert($message, $type)
  {
    Session::set('alert', new Alert($message, $type));
  }
}
