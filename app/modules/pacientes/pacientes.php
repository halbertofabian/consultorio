<?php

if (!isset($rutas[1])) {
    include_once 'app/modules/pacientes/pacientes-list-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'list') {
    include_once 'app/modules/pacientes/pacientes-list-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'create') {
    include_once 'app/modules/pacientes/pacientes-create-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'update') {
    include_once 'app/modules/pacientes/pacientes-update-view.php';
} else {
    echo 'Error 404';
}
