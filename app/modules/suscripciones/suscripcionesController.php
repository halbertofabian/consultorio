<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SuscripcionesController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['scs_nombre'] = strtoupper($data['scs_nombre']);
        $data['tenantid'] = uniqid();

        $res = SuscripcionesModelo::mdlGuardarSuscripciones($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El suscriptor se guardo correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }

    public function list(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $suscriptores = SuscripcionesModelo::mdlMostrarSuscriptores();
        $array_sus = array();
        foreach ($suscriptores as $key => $scs) {
            array_push($array_sus, array(
                'scs_nombre' => $scs['scs_nombre'],
                'scs_correo' => $scs['scs_correo'],
                'scs_telefono' => $scs['scs_telefono'],
                'scs_acciones' => '
                <div class="dropdown font-sans-serif position-static">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-0">
                        <div class="py-2">
                            <a class="dropdown-item" href="' . HTTP_HOST . 'suscripciones/update/' . base64_encode($scs['scs_id']) . '">Editar</a>
                            <a class="dropdown-item text-danger" href="#!">Eliminar</a>
                        </div>
                    </div>
                </div>',
            ));
        }

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($array_sus, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function get(Request $request, Response $response, $args)
    {
        $queryParams = $request->getQueryParams();
        
        $scs_id = base64_decode($queryParams['scs_id']) ?? null;

        $scs = SuscripcionesModelo::mdlMostrarSuscriptoresById($scs_id);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($scs, true));

        return $response->withHeader('Content-Type', 'application/json');
    }
    public function update(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['scs_nombre'] = strtoupper($data['scs_nombre']);

        $res = SuscripcionesModelo::mdlActualizarSuscripciones($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El suscriptor se actualizo correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Tienes los ultimos datos actualizados',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }
}
