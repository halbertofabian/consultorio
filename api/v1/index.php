<?php session_start();

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../../app/modules/app/zona-horaria.php');
require_once(__DIR__ . '/../../app/modules/app/componentescontrolador.php');


require_once(__DIR__ . '/../../app/modules/usuarios/usuariosController.php');
require_once(__DIR__ . '/../../app/modules/suscripciones/suscripcionesController.php');
require_once(__DIR__ . '/../../app/modules/consultorios/consultoriosController.php');
require_once(__DIR__ . '/../../app/modules/pacientes/pacientesController.php');
require_once(__DIR__ . '/../../app/modules/consultas/consultasController.php');
require_once(__DIR__ . '/../../app/modules/citas/citasController.php');

require_once(__DIR__ . '/../../app/modules/usuarios/usuariosModelo.php');
require_once(__DIR__ . '/../../app/modules/suscripciones/suscripcionesModelo.php');
require_once(__DIR__ . '/../../app/modules/consultorios/consultoriosModelo.php');
require_once(__DIR__ . '/../../app/modules/login/loginModelo.php');
require_once(__DIR__ . '/../../app/modules/pacientes/pacientesModelo.php');
require_once(__DIR__ . '/../../app/modules/consultas/consultasModelo.php');
require_once(__DIR__ . '/../../app/modules/citas/citasModelo.php');



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->setBasePath("/" . FOLDER . "api/v1"); // /myapp/api es la carpeta api (http://domain/myapp/api)

// Middleware de manejo de errores
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Rutas
require __DIR__ . '/usuarios.php';
require __DIR__ . '/suscripciones.php';
require __DIR__ . '/consultorios.php';
require __DIR__ . '/pacientes.php';
require __DIR__ . '/consultas.php';
require __DIR__ . '/citas.php';

// Ejecutar la aplicación
$app->run();
