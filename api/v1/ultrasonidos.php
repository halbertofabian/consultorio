<?php
$app->post('/ultrasonidos/list', UltrasonidosController::class . ':list');
$app->post('/ultrasonidos/create', UltrasonidosController::class . ':create');
$app->get('/ultrasonidos/get', UltrasonidosController::class . ':get');
$app->post('/ultrasonidos/update', UltrasonidosController::class . ':update');
$app->post('/ultrasonidos/delete', UltrasonidosController::class . ':delete');