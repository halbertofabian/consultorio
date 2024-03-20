<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CitasController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['cts_fecha'] = FECHA;
        $data['cts_fecha_inicio'] = $data['cts_fecha_inicio'] . ' ' . $data['cts_hora_inicio'];
        $data['cts_fecha_fin'] = $data['cts_fecha_fin'] . ' ' . $data['cts_hora_fin'];
        $data['cts_descripcion'] = $data['cts_descripcion'];
        $data['cts_usuario_registro'] = $_SESSION['usr']['usr_id'];
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        $citas = CitasModelo::mdlMostrarCitasByFechas($data['cts_fecha_inicio'], $data['cts_fecha_fin'], $_SESSION['usr']['tenantid']);
        if ($citas) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Ya existe una cita programada para esta fecha y hora',
            )));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $res = CitasModelo::mdlGuardarCitas($data);
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

    public function list(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $citas = CitasModelo::mdlMostrarCitas($data['cts_usr_id'], $data['tenantid']);
        $array = array();
        foreach ($citas as $key => $cts) {
            array_push($array, array(
                'id' => $cts['cts_id'],
                'title' => ComponentesControlador::obtenerNombrePaciente($cts['cts_pte_id']),
                'start' => $cts['cts_fecha_inicio'],
                'end' => $cts['cts_fecha_fin'],
                'consultorio' => ComponentesControlador::obtenerNombreConsultorio($cts['cts_ctr_id']) 
            ));
        }

        $response->getBody()->write(json_encode($array, true));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
