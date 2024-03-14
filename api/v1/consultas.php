<?php

$app->post('/consultas/list', ConsultasController::class . ':list');
$app->post('/consultas/create', ConsultasController::class . ':create');
$app->post('/consultas/delete', ConsultasController::class . ':delete');
$app->get('/consultas/get', ConsultasController::class . ':get');
$app->post('/consultas/update', ConsultasController::class . ':update');
