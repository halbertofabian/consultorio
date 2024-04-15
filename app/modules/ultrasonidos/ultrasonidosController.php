<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UltrasonidosController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();
        $data['uts_fecha'] = $data['uts_fecha'] . ' ' . $data['uts_hora'];
        $data['uts_motivo'] = $data['uts_motivo'];
        $data['uts_conclusion'] = $data['uts_conclusion'];
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        $fechaActual = FECHA;

        if ($data['uts_fecha'] < $fechaActual) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'La fecha debe ser mayor o igual a la fecha actual',
            )));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $ultrasonidos = UltrasonidosModelo::mdlMostrarUltrasonidosByFechas($data['uts_fecha'], $_SESSION['usr']['tenantid']);
        if ($ultrasonidos) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Ya existe un ultrasonido programado para esta fecha y hora',
            )));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $res = UltrasonidosModelo::mdlGuardarUltrasonidos($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'Los datos se guardarón correctamente',
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
        $data['uts_fecha'] = $data['uts_fecha'] . ' ' . $data['uts_hora'];
        $data['uts_motivo'] = $data['uts_motivo'];
        $data['uts_conclusion'] = $data['uts_conclusion'];

        $fechaActual = FECHA;

        if ($data['uts_fecha'] < $fechaActual) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'La fecha debe ser mayor o igual a la fecha actual',
            )));
            return $response->withHeader('Content-Type', 'application/json');
        }
        $uts = UltrasonidosModelo::mdlMostrarUltrasonidosById($data['uts_id']);
        if ($data['uts_fecha'] !== $uts['uts_fecha']) {
            $ultrasonidos = UltrasonidosModelo::mdlMostrarUltrasonidosByFechas($data['uts_fecha'], $_SESSION['usr']['tenantid']);
            if ($ultrasonidos) {
                $response->getBody()->write(json_encode(array(
                    'status' => false,
                    'mensaje' => 'Ya existe un ultrasonido programado para esta fecha y hora',
                )));
                return $response->withHeader('Content-Type', 'application/json');
            }
        }

        $res = UltrasonidosModelo::mdlActualizarUltrasonidos($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'Los datos se guardarón correctamente',
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

        $ultrasonidos = UltrasonidosModelo::mdlMostrarUltrasonidos($data['tenantid']);
        $array = array();
        foreach ($ultrasonidos as $key => $uts) {

            array_push($array, array(
                'uts_pte_id' => ComponentesControlador::obtenerNombrePaciente($uts['uts_pte_id']),
                'uts_fecha' => ComponentesControlador::fechaCastellano($uts['uts_fecha']),
                'uts_motivo' => $uts['uts_motivo'],
                'uts_conclusion' => $uts['uts_conclusion'],
                'acciones' => '
                <div class="dropdown font-sans-serif position-static">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-0">
                        <div class="py-2">
                            <a class="dropdown-item" href="' . HTTP_HOST . 'ultrasonidos/update/' . base64_encode($uts['uts_id']) . '">Editar</a>
                            <a class="dropdown-item text-danger btnEliminarUltrasonido" uts_id="' . $uts['uts_id'] . '" href="javascript:void(0);">Eliminar</a>
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

        $uts_id = base64_decode($queryParams['uts_id']) ?? null;

        $uts = UltrasonidosModelo::mdlMostrarUltrasonidosById($uts_id);

        $uts['pte_nombre'] = ComponentesControlador::obtenerNombrePaciente($uts['uts_pte_id']);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($uts, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $res = UltrasonidosModelo::mdlEliminarUltrasonidos($data['uts_id']);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El ultrasonido se elimino correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error al eliminar el ultrasonido',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }
}
