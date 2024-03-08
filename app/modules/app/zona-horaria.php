
<?php
if (isset($_SESSION['scl']['zona'])) {
    date_default_timezone_set($_SESSION['scl']['zona']);
} else {
    date_default_timezone_set('America/Mexico_City');
}
$fecha = date('Y-m-d H:i:s');
define('FECHA', $fecha);
define('HORA', date('H:i:s'));

if (isset($_SESSION['scl']['scl_moneda']))
    define('MONEDA', $_SESSION['scl']['scl_moneda']);
