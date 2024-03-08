<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/blog', function (Request $request, Response $response, $args) {
    $response->getBody()->write('Página principal a wuebo');
    return $response;
});

$app->get('/users', UsersController::class . ':list');
