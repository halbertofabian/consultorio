<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PacientesController
{
    public function create(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['pte_nombres'] = trim(mb_strtoupper($data['pte_nombres']));
        $data['pte_ap_paterno'] = trim(mb_strtoupper($data['pte_ap_paterno']));
        $data['pte_ap_materno'] = trim(mb_strtoupper($data['pte_ap_materno']));
        $data['pte_rfc'] = trim(mb_strtoupper($data['pte_rfc']));
        $data['pte_curp'] = trim(mb_strtoupper($data['pte_curp']));
        $data['pte_fecha_registro'] = FECHA;
        $data['pte_usuario_registro'] = $_SESSION['usr']['usr_id'];
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        $res = PacientesModelo::mdlGuardarPacientes($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El paciente se guardo correctamente',
                'pte_id' => $res
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

        $data['pte_nombres'] = trim(mb_strtoupper($data['pte_nombres']));
        $data['pte_ap_paterno'] = trim(mb_strtoupper($data['pte_ap_paterno']));
        $data['pte_ap_materno'] = trim(mb_strtoupper($data['pte_ap_materno']));
        $data['pte_rfc'] = trim(mb_strtoupper($data['pte_rfc']));
        $data['pte_curp'] = trim(mb_strtoupper($data['pte_curp']));
        $data['pte_usuario_registro'] = $_SESSION['usr']['usr_id'];

        $res = PacientesModelo::mdlActualizarPacientes($data);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El paciente se actualizo correctamente',
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

        $pacientes = PacientesModelo::mdlMostrarPacientes($data['tenantid']);
        $array = array();
        foreach ($pacientes as $key => $pte) {
            $consulta = $_SESSION['usr']['usr_perfil'] === 'Doctor' ? '<a class="dropdown-item" href="' . HTTP_HOST . 'consultas/create/' . base64_encode($pte['pte_id']) . '">Agregar a consulta</a>' : "";

            array_push($array, array(
                'pte_nombres' => $pte['pte_nombres'] . ' ' . $pte['pte_ap_paterno'] . ' ' . $pte['pte_ap_materno'],
                'pte_fecha_nacimiento' => $pte['pte_fecha_nacimiento'],
                'pte_sexo' => $pte['pte_sexo'],
                'pte_curp' => $pte['pte_curp'],
                'pte_fecha_registro' => ComponentesControlador::fechaCastellano($pte['pte_fecha_registro']),
                'pte_usuario_registro' => $pte['usr_nombre'],
                'acciones' => '
                <div class="dropdown font-sans-serif position-static">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-0">
                        <div class="py-2">
                            ' . $consulta . '
                            <a class="dropdown-item" href="' . HTTP_HOST . 'citas/create/' . base64_encode($pte['pte_id']) . '">Agendar cita</a>
                            <a class="dropdown-item btnAgregarUltrasonido" pte_id="' . $pte['pte_id'] . '" pte_nombre="' . ComponentesControlador::obtenerNombrePaciente($pte['pte_id']) . '" href="javascript:void(0)">Agregar ultrasonido</a>
                            <a class="dropdown-item" href="' . HTTP_HOST . 'pacientes/update/' . base64_encode($pte['pte_id']) . '">Editar</a>
                            <a class="dropdown-item text-danger btnEliminarPaciente" pte_id="' . $pte['pte_id'] . '" href="javascript:void(0);">Eliminar</a>
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

        $pte_id = base64_decode($queryParams['pte_id']) ?? null;

        $pte = PacientesModelo::mdlMostrarPacientesById($pte_id);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($pte, true));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function curp(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        $nombre = $data['nombre'];
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $sexo = $data['sexo'];
        $estado = $data['estado'];

        $curp_generada = ComponentesControlador::generarCURP($nombre, $fecha_nacimiento, $sexo, $estado);
        $rfc_generada = ComponentesControlador::generarRFC($nombre, $fecha_nacimiento);



        // Se devuelve la CURP directamente como JSON
        $response->getBody()->write(json_encode(array(
            'curp' => $curp_generada,
            'rfc' => $rfc_generada,
        )));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function delete(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $res = PacientesModelo::mdlEliminarPacientes($data['pte_id']);
        if ($res) {
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El paciente se elimino correctamente',
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error al eliminar al paciente',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }
}
