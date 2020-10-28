<?php
require dirname(__FILE__) . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

session_start();

if (PHP_SAPI == 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = dirname(__FILE__) . $url['path'];
    if (is_file($file)) return false;
}

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(dirname(__FILE__).'/../config/globalconfig.php');
$container = $containerBuilder->build();

$app = \DI\Bridge\Slim\Bridge::create($container);

$app->get('/', [\Cursos\Controllers\HomeController::class, 'index']);

$app->run();