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

        $fechaActual = FECHA;

        if ($data['cts_fecha_inicio'] < $fechaActual || $data['cts_fecha_fin'] < $fechaActual) {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'La fecha debe ser mayor o igual a la fecha y hora actual',
            )));
            return $response->withHeader('Content-Type', 'application/json');
        }

        $citas = CitasModelo::mdlMostrarCitasByFechas($data['cts_fecha_inicio'], $data['cts_fecha_fin'], $data['cts_ctr_id'], $data['cts_usr_id'], $_SESSION['usr']['tenantid']);
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

    public function update(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['cts_fecha_inicio'] = $data['cts_fecha_inicio'] . ' ' . $data['cts_hora_inicio'];
        $data['cts_fecha_fin'] = $data['cts_fecha_fin'] . ' ' . $data['cts_hora_fin'];
        $data['cts_descripcion'] = $data['cts_descripcion'];
        $data['cts_usuario_registro'] = $_SESSION['usr']['usr_id'];

        $fechaActual = FECHA;
        $cts = CitasModelo::mdlMostrarCitasById($data['cts_id']);

        if ($cts['cts_fecha_inicio'] !== $data['cts_fecha_inicio'] && $cts['cts_fecha_fin'] !== $data['cts_fecha_fin']) {
            if ($data['cts_fecha_inicio'] < $fechaActual || $data['cts_fecha_fin'] < $fechaActual) {
                $response->getBody()->write(json_encode(array(
                    'status' => false,
                    'mensaje' => 'La fecha debe ser mayor o igual a la fecha y hora actual',
                )));
                return $response->withHeader('Content-Type', 'application/json');
            }

            $citas = CitasModelo::mdlMostrarCitasByFechas($data['cts_fecha_inicio'], $data['cts_fecha_fin'], $data['cts_ctr_id'], $data['cts_usr_id'], $_SESSION['usr']['tenantid']);
            if ($citas) {
                $response->getBody()->write(json_encode(array(
                    'status' => false,
                    'mensaje' => 'Ya existe una cita programada para esta fecha y hora',
                )));
                return $response->withHeader('Content-Type', 'application/json');
            }
        }

        $res = CitasModelo::mdlActualizarCitas($data);
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

        $citas = CitasModelo::mdlMostrarCitas($data['usr_perfil'], $data['cts_usr_id'], $data['tenantid']);
        $array = array();
        foreach ($citas as $key => $cts) {
            array_push($array, array(
                'id' => $cts['cts_id'],
                'title' => ComponentesControlador::obtenerNombrePaciente($cts['cts_pte_id']),
                'start' => $cts['cts_fecha_inicio'],
                'end' => $cts['cts_fecha_fin'],
                'consultorio' => ComponentesControlador::obtenerNombreConsultorio($cts['cts_ctr_id']),
                'descripcion' => $cts['cts_descripcion'],
                'estado' => $cts['cts_estado'],
                'cts_pte_id' => $cts['cts_pte_id']
            ));
        }

        $response->getBody()->write(json_encode($array, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function estado(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $res = CitasModelo::mdlActualuzarEstadoCitas($data['cts_estado'], $data['cts_id']);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El estado se cambio correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error',
            )));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function get(Request $request, Response $response, $args)
    {
        $queryParams = $request->getQueryParams();

        $cts_id = base64_decode($queryParams['cts_id']) ?? null;

        $cts = CitasModelo::mdlMostrarCitasById($cts_id);

        $cts['pte_nombre'] = ComponentesControlador::obtenerNombrePaciente($cts['cts_pte_id']);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($cts, true));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
