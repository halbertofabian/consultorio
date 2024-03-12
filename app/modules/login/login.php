<?php

if (!isset($rutas[1])) {
    include_once 'app/modules/login/login-iniciar-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'salir') {
    include_once 'app/modules/login/login-salir-view.php';
} else {
    echo 'Error 404';
}
