<?php

if (!isset($rutas[1])) {
    include_once 'app/modules/historial/historial-list-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'list') {
    include_once 'app/modules/historial/historial-list-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'create') {
    include_once 'app/modules/historial/historial-create-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'update') {
    include_once 'app/modules/historial/historial-update-view.php';
} else if (isset($rutas[1]) && $rutas[1] == 'create-perinatal') {
    include_once 'app/modules/historial/historial-create-perinatal-view.php';
} else {
    echo 'Error 404';
}
