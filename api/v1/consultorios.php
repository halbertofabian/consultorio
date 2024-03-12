<?php
$app->post('/consultorios/datos', ConsultoriosController::class . ':datos');
$app->post('/consultorios/direccion', ConsultoriosController::class . ':direccion');
$app->get('/consultorios/get', ConsultoriosController::class . ':get');