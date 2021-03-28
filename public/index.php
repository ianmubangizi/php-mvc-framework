<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Mubangizi\Core\Application;
use Mubangizi\controllers\SiteController;
use Mubangizi\controllers\AuthController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'index']);
$app->router->match('/contact', [SiteController::class, 'contact']);
$app->router->match('/auth/login', [AuthController::class, 'login']);
$app->router->match('/auth/register', [AuthController::class, 'register']);

$app->run();

?>
