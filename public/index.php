<?php

require_once __DIR__ . "/../vendor/autoload.php";

use framework\controllers\SiteController;
use framework\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
$app->router->post('/contact', [new SiteController, 'handle_contact_submit']);

$app->run();

?>
