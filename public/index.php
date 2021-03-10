<?php

require_once __DIR__ . "/../vendor/autoload.php";

use framework\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
$app->router->post('/contact', function(){
   return "Submitting Message";
});

$app->run();

?>
