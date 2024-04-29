<?php

$app->post('/suscripciones/list', SuscripcionesController::class . ':list');
$app->post('/suscripciones/create', SuscripcionesController::class . ':create');
$app->get('/suscripciones/get', SuscripcionesController::class . ':get');
$app->post('/suscripciones/update', SuscripcionesController::class . ':update');
$app->post('/suscripciones/update/intro', SuscripcionesController::class . ':updateIntro');
