<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
use Mubangizi\Core\Application;
use Mubangizi\Controllers\SiteController;
use Mubangizi\Controllers\AuthController;
use Mubangizi\Middlewares\AuthMiddleware;

if (!isset($_ENV['PRODUCTION'])) {
	$dotenv = Dotenv::createImmutable(dirname(__DIR__));
	$dotenv->load();
}

$config = require(__DIR__ . "/../config.php");
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'index'])->name('home');
$app->router->match('/contact', [SiteController::class, 'contact'])->name('contact');
$app->router->match('/auth/login', [AuthController::class, 'login'])->name('login');
$app->router->match('/auth/register', [AuthController::class, 'register'])->name('register');

$app->router->with([AuthMiddleware::class], [
	$app->router->match('/admin', [SiteController::class, 'index'])->name('admin'),
	$app->router->match('/profile/{id:\d+}/{user:\w+}', [SiteController::class, 'index'])->name('profile'),
]);

$app->run();
