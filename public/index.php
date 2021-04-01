<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
use Mubangizi\Core\Application;
use Mubangizi\Controllers\SiteController;
use Mubangizi\Controllers\AuthController;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = require(__DIR__ . "/../config.php");
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'index']);
$app->router->match('/contact', [SiteController::class, 'contact']);
$app->router->match('/auth/login', [AuthController::class, 'login']);
$app->router->match('/auth/register', [AuthController::class, 'register']);

$app->run();

?>