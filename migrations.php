<?php require_once __DIR__ . '/vendor/autoload.php';

use Mubangizi\Core\Application;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = require_once __DIR__ . '/config.php';
$app = new Application(__DIR__, $config);

$app->database->apply_migrations();