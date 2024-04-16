<?php
$app->post('/historial/list', HistorialController::class . ':list');
$app->post('/historial/create', HistorialController::class . ':create');
$app->get('/historial/get', HistorialController::class . ':get');
$app->post('/historial/update', HistorialController::class . ':update');
$app->post('/historial/delete', HistorialController::class . ':delete');