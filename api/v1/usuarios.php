<?php

$app->post('/usuarios/list', UsuariosController::class . ':list');
$app->post('/usuarios/create', UsuariosController::class . ':create');
$app->post('/usuarios/delete', UsuariosController::class . ':delete');
$app->get('/usuarios/get', UsuariosController::class . ':get');
$app->post('/usuarios/update', UsuariosController::class . ':update');
