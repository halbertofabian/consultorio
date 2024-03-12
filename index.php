<?php session_start();
include_once 'config.php';

//CONTROLADORES
require_once 'app/modules/app/componentescontrolador.php';
require_once 'app/modules/login/loginController.php';
require_once 'app/modules/suscripciones/suscripcionesController.php';
require_once 'app/modules/usuarios/usuariosController.php';
require_once 'app/modules/consultorios/consultoriosController.php';

//MODELOS
require_once 'app/modules/login/loginModelo.php';
require_once 'app/modules/suscripciones/suscripcionesModelo.php';
require_once 'app/modules/usuarios/usuariosModelo.php';
require_once 'app/modules/consultorios/consultoriosModelo.php';


// Página principal
include_once 'app/modules/app/app-view.php';


ob_end_flush();
