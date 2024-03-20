<?php

$app->post('/citas/list', CitasController::class . ':list');
$app->post('/citas/create', CitasController::class . ':create');
$app->post('/citas/delete', CitasController::class . ':delete');
$app->get('/citas/get', CitasController::class . ':get');
$app->post('/citas/update', CitasController::class . ':update');
$app->post('/citas/cambiar-estado', CitasController::class . ':estado');
