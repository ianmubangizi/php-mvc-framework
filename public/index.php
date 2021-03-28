<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Mubangizi\Core\Application;
use Mubangizi\controllers\SiteController;
use Mubangizi\controllers\AuthController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/contact', 'contact');
$app->router->post('/contact', [SiteController::class, 'handle_contact_submit']);

$app->router->get('/auth/login', [AuthController::class, 'login']);
$app->router->post('/auth/login', [AuthController::class, 'login']);
$app->router->get('/auth/register', [AuthController::class, 'register']);
$app->router->get('/auth/register', [AuthController::class, 'register']);


$app->run();

?>
