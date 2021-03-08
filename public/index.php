<?php

require_once __DIR__ . "/../vendor/autoload.php";

use framework\core\Application;

$app = new Application();

$app->router->get('/', 'main');

$app->run();

?>