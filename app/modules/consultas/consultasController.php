<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ConsultasController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['cta_usr_id'] = $_SESSION['usr']['usr_id'];
        $data['cta_ctr_id'] = $_SESSION['scl']['ctr_id'];
        $data['cta_pte_id'] = $data['cta_pte_id'];
        $data['cta_subjetivo'] = $data['cta_subjetivo'];
        $data['cta_analisis'] = $data['cta_analisis'];
        $data['cta_plan'] = $data['cta_plan'];
        $data['cta_fecha'] = FECHA;
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        $res = ConsultasModelo::mdlGuardarConsultas($data);
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

        $data['cta_subjetivo'] = $data['cta_subjetivo'];
        $data['cta_analisis'] = $data['cta_analisis'];
        $data['cta_plan'] = $data['cta_plan'];
        $data['cta_fecha'] = FECHA;

        $res = ConsultasModelo::mdlActualizarConsultas($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'Los datos se actualizarón correctamente',
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

        $consultas = ConsultasModelo::mdlMostrarConsultas($data['tenantid'], $data['cta_ctr_id']);
        $array = array();
        foreach ($consultas as $key => $cta) {
            // $consulta = $_SESSION['usr']['usr_perfil'] === 'Doctor' ? '<a class="dropdown-item" href="' . HTTP_HOST . 'consultas/create/' . base64_encode($pte['pte_id']) . '">Agregar a consulta</a>' : "";

            array_push($array, array(
                'pte_nombres' => $cta['pte_nombres'] . ' ' . $cta['pte_ap_paterno'] . ' ' . $cta['pte_ap_materno'],
                'pte_edad' => $cta['pte_edad'],
                'cta_fecha' => ComponentesControlador::fechaCastellano($cta['cta_fecha']),
                'acciones' => '
                <div class="dropdown font-sans-serif position-static">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-0">
                        <div class="py-2">
                            <a class="dropdown-item text-primary btnVerConsulta" cta_id="' . $cta['cta_id'] . '" href="javascript:void(0);">Consulta médica</a>
                            <a class="dropdown-item" href="' . HTTP_HOST . 'consultas/update/' . base64_encode($cta['cta_id']) . '">Editar</a>
                            <a class="dropdown-item text-danger btnEliminarConsulta" cta_id="' . $cta['cta_id'] . '" href="javascript:void(0);">Eliminar</a>
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

        $cta_id = base64_decode($queryParams['cta_id']) ?? null;

        $cta = ConsultasModelo::mdlMostrarConsultasById($cta_id);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($cta, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $res = ConsultasModelo::mdlEliminarConsultas($data['cta_id']);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'La consulta se elimino correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error al eliminar la consulta',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }
}
