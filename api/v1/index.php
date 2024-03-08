<?php

require(__DIR__ . '/../../config.php');
require(__DIR__ . '/../vendor/autoload.php');

require(__DIR__ . '/../../app/modules/users/userscontroller.php');

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->setBasePath("/" . FOLDER . "api/v1"); // /myapp/api es la carpeta api (http://domain/myapp/api)

// Middleware de manejo de errores
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Rutas
require __DIR__ . '/routes.php';

// Ejecutar la aplicación
$app->run();
