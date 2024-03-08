<?php

$app->get('/suscripciones', SuscripcionesController::class . ':list');
$app->post('/suscripciones/create', SuscripcionesController::class . ':create');
