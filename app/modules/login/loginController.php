<?php
require_once(__DIR__ . '../../login/loginModelo.php');
require_once(__DIR__ . '../../usuarios/usuariosModelo.php');
require_once(__DIR__ . '../../consultorios/consultoriosModelo.php');
require_once(__DIR__ . '../../suscripciones/suscripcionesModelo.php');
class LoginController
{
    public static function ctrIngresoUsuario()
    {
        if (isset($_POST['btnLogin'])) {

            $encriptar = crypt($_POST["usr_clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $usr = UsuariosModelo::mdlMostrarUsuarioByCorreoLogin(trim($_POST['usr_correo']));
            if ($usr && $usr['usr_correo'] == trim($_POST['usr_correo']) && $encriptar == $usr['usr_clave']) {
                $ctr = ConsultoriosModelo::mdlMostrarConsultoriosByTenantId($usr['tenantid']);
                $scs = SuscripcionesModelo::mdlMostrarSuscriptoresByTenantId($usr['tenantid']);
                $_SESSION['usr'] = $usr;
                $_SESSION['scl'] = $ctr;
                $_SESSION['scs'] = $scs;
                echo '<script>

            window.location = "' . HTTP_HOST . '";

        </script>';
            } else {
                echo '<script> toastr.error("Usuario o contraseña incorrecto, intente de nuevo", "Error")</script>';
            }
        }
    }

    public static function ctrIngresoUsuarioNuevo($datos)
    {

        // $encriptar = crypt($datos["usr_clave"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $usr = UsuariosModelo::mdlMostrarUsuarioByCorreoLogin(trim($datos['usr_correo']));
        if ($usr && $usr['usr_correo'] == trim($datos['usr_correo']) && $datos['usr_clave'] == $usr['usr_clave']) {
            $ctr = ConsultoriosModelo::mdlMostrarConsultoriosByTenantId($usr['tenantid']);
            $scs = SuscripcionesModelo::mdlMostrarSuscriptoresByTenantId($usr['tenantid']);
            UsuariosModelo::mdlActualizarTokenAut($usr['usr_id']);
            $_SESSION['usr'] = $usr;
            $_SESSION['scl'] = $ctr;
            $_SESSION['scs'] = $scs;
            echo '<script>

            window.location = "' . HTTP_HOST . '";

        </script>';
        } else {
            echo '<script> toastr.error("Usuario o contraseña incorrecto, intente de nuevo", "Error")</script>';
        }
    }
}
