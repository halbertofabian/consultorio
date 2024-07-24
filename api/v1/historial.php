<?php
$app->post('/historial/list', HistorialController::class . ':list');
$app->post('/historial/create', HistorialController::class . ':create');
$app->post('/historial/create/perinatal', HistorialController::class . ':createPerinetal');
$app->get('/historial/get', HistorialController::class . ':get');
$app->get('/historial-perinetal/get', HistorialController::class . ':getPerinetal');
$app->post('/historial/update', HistorialController::class . ':update');
$app->post('/historial/delete', HistorialController::class . ':delete');