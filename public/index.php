<?php

require_once __DIR__ . "/../vendor/autoload.php";

use framework\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

$app->run();

?>