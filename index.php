<?php session_start();
include_once 'config.php';

//CONTROLADORES
require_once 'app/modules/app/componentescontrolador.php';
require_once 'app/modules/login/loginController.php';


// Página principal
include_once 'app/modules/app/app-view.php';


ob_end_flush();
