<?php
require_once(__DIR__ . '../../login/loginModelo.php');
require_once(__DIR__ . '../../usuarios/usuariosModelo.php');
require_once(__DIR__ . '../../consultorios/consultoriosModelo.php');
class LoginController
{
    public static function ctrIngresoUsuario()
    {
        if (isset($_POST['btnLogin'])) {
           
            $encriptar = crypt($_POST["usr_clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $usr = UsuariosModelo::mdlMostrarUsuarioByCorreoLogin(trim($_POST['usr_correo']));
            if ($usr && $usr['usr_correo'] == trim($_POST['usr_correo']) && $encriptar == $usr['usr_clave']) {
                $ctr = ConsultoriosModelo::mdlMostrarConsultoriosByTenantId($usr['tenantid']);
                $_SESSION['usr'] = $usr;
                $_SESSION['scl'] = $ctr;
                echo '<script>

            window.location = "' . HTTP_HOST . '";

        </script>';
            } else {
                echo '<script> toastr.error("Usuario o contraseña incorrecto, intente de nuevo", "Error")</script>';
            }
        }
    }
}
