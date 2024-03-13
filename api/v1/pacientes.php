<?php
$app->post('/pacientes/list', PacientesController::class . ':list');
$app->post('/pacientes/create', PacientesController::class . ':create');
$app->get('/pacientes/get', PacientesController::class . ':get');
$app->post('/pacientes/get-curp', PacientesController::class . ':curp');
$app->post('/pacientes/update', PacientesController::class . ':update');
$app->post('/pacientes/delete', PacientesController::class . ':delete');