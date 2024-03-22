<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsuariosController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $correo = UsuariosModelo::mdlMostrarUsuarioByCorreo($data['usr_correo'], $_SESSION['usr']['tenantid']);
        if ($correo) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Lo sentimos, pero ese correo electrónico ya está asociado a otra cuenta. Por favor, utilice un correo electrónico diferente para registrarse.',
            )));

            return $response->withHeader('Content-Type', 'application/json');
        }

        if ($data['usr_clave1'] != $data['usr_clave2']) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Las contraseñas no coinciden',
            )));

            return $response->withHeader('Content-Type', 'application/json');
        }

        if (isset($_FILES["usr_foto"])) {
            $inputName = "usr_foto";
            $upload_result = ComponentesControlador::imageUpload($inputName);
            if (is_array($upload_result) && isset($upload_result['status']) && $upload_result['status'] === false) {
                return $upload_result;
            } else {
                $url_file = $upload_result;
            }
        } else {
            $url_file = "";
        }

        $data['usr_nombre'] = mb_strtoupper($data['usr_nombre']);
        $data['usr_clave'] = crypt($data['usr_clave1'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $data['usr_foto'] = $url_file;
        $data['usr_fecha_registro'] = FECHA;
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        $res = UsuariosModelo::mdlGuardarUsuarios($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El usuario se guardo correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }

    public function update(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $usr_res = UsuariosModelo::mdlMostrarUsuariosById($data['usr_id']);
        if ($usr_res['usr_correo'] !== $data['usr_correo']) {
            $correo = UsuariosModelo::mdlMostrarUsuarioByCorreo($data['usr_correo'], $_SESSION['usr']['tenantid']);
            if ($correo) {
                $response->getBody()->write(json_encode(array(
                    'status' => false,
                    'mensaje' => 'Lo sentimos, pero ese correo electrónico ya está asociado a otra cuenta. Por favor, utilice un correo electrónico diferente para registrarse.',
                )));

                return $response->withHeader('Content-Type', 'application/json');
            }
        }

        if ($data['usr_clave1'] != $data['usr_clave2']) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Las contraseñas no coinciden',
            )));

            return $response->withHeader('Content-Type', 'application/json');
        }

        if (isset($_FILES["usr_foto"]) && !empty($_FILES["usr_foto"]["tmp_name"])) {
            $inputName = "usr_foto";
            $upload_result = ComponentesControlador::imageUpload($inputName);
            if (is_array($upload_result) && isset($upload_result['status']) && $upload_result['status'] === false) {
                return $upload_result;
            } else {
                $url_file = $upload_result;
            }
        } else {
            $url_file = $usr_res['usr_foto'];
        }

        $data['usr_nombre'] = mb_strtoupper($data['usr_nombre']);
        $data['usr_clave'] = ($data['usr_clave1'] !== "") ? crypt($data['usr_clave1'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$') : $usr_res['usr_clave'];
        $data['usr_foto'] = $url_file;
        // $data['usr_fecha_registro'] = FECHA;
        // $data['tenantid'] = "";

        $res = UsuariosModelo::mdlActualizarUsuarios($data);
        if ($res) {
            $actualizacion = false;
            // Obtener usuario después de la actualización
            if ($_SESSION['usr']['usr_id'] == $data['usr_id']) {
                $usr_actualizado = UsuariosModelo::mdlMostrarUsuariosById($data['usr_id']);
                $_SESSION['usr'] = $usr_actualizado;

                $cambio_correo = ($usr_res['usr_correo'] !== $usr_actualizado['usr_correo']);
                $cambio_contraseña = ($usr_res['usr_clave'] !== $usr_actualizado['usr_clave']);

                if ($cambio_correo || $cambio_contraseña) {
                    $actualizacion = true;
                }
            }
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El usuario se actualizo correctamente',
                'actualizacion' => $actualizacion
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Tienes los ultimos datos actualizados',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }

    public function list(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $usuarios = UsuariosModelo::mdlMostrarUsuarios($data['tenantid']);
        $array = array();
        foreach ($usuarios as $key => $usr) {
            array_push($array, array(
                'usr_nombre' => $usr['usr_nombre'],
                'usr_correo' => $usr['usr_correo'],
                'usr_perfil' => $usr['usr_perfil'],
                'usr_fecha_registro' => $usr['usr_fecha_registro'],
                'acciones' => '
                <div class="dropdown font-sans-serif position-static">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-0">
                        <div class="py-2">
                            <a class="dropdown-item" href="' . HTTP_HOST . 'usuarios/update/' . base64_encode($usr['usr_id']) . '">Editar</a>
                            <a class="dropdown-item text-danger btnEliminarUsuario" usr_id="' . $usr['usr_id'] . '" href="javascript:void(0);">Eliminar</a>
                        </div>
                    </div>
                </div>',
            ));
        }

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($array, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function get(Request $request, Response $response, $args)
    {
        $queryParams = $request->getQueryParams();

        $usr_id = base64_decode($queryParams['usr_id']) ?? null;

        $usr = UsuariosModelo::mdlMostrarUsuariosById($usr_id);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($usr, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $res = UsuariosModelo::mdlEliminarUsuarios($data['usr_id']);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El usuario se elimino correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error al eliminar al usuario',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }
    public function consultorios(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $res = UsuariosModelo::mdlMostrarUsuariosByConsultorios($data['usr_ctr_id'], $data['tenantid']);
        $response->getBody()->write(json_encode($res, true));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
