<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ConsultoriosController
{
    public function datos(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $ctr_res = ConsultoriosModelo::mdlMostrarConsultoriosById($data['ctr_id']);

        if (isset($_FILES["ctr_logo"]) && !empty($_FILES["ctr_logo"]["tmp_name"])) {
            $inputName = "ctr_logo";
            $upload_result = ComponentesControlador::imageUpload($inputName);
            if (is_array($upload_result) && isset($upload_result['status']) && $upload_result['status'] === false) {
                return $upload_result;
            } else {
                $url_file = $upload_result;
            }
        } else {
            
            $url_file = $data['ctr_id'] == "" ? "" : $ctr_res['ctr_logo'];
        }

        $data['ctr_logo'] = $url_file;
        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        if ($data['ctr_id'] == "") {
            
            $res = ConsultoriosModelo::mdlGuardarDatosConsultorios($data);
            $ctr_actualizado = ConsultoriosModelo::mdlMostrarConsultoriosById($res);
        } else {
            $res = ConsultoriosModelo::mdlActualizarDatosConsultorios($data);
            $ctr_actualizado = ConsultoriosModelo::mdlMostrarConsultoriosById($data['ctr_id']);
        }
        if ($res) {
            $_SESSION['scl'] = $ctr_actualizado;
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'Los datos se guardarón correctamente',
                'ctr_id' => $res
            )));
        } else {
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Tienes los ultimos datos actualizados',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');
    }

    public function direccion(Request $request, Response $response, $args)
    {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $ctr_res = ConsultoriosModelo::mdlMostrarConsultoriosById($data['ctr_id']);

        $data['tenantid'] = $_SESSION['usr']['tenantid'];

        if ($data['ctr_id'] == "") {
            $res = ConsultoriosModelo::mdlGuardarDireccionConsultorios($data);
            $ctr_actualizado = ConsultoriosModelo::mdlMostrarConsultoriosById($res);
        } else {
            $res = ConsultoriosModelo::mdlActualizarDireccionConsultorios($data);
            $ctr_actualizado = ConsultoriosModelo::mdlMostrarConsultoriosById($data['ctr_id']);
        }
        if ($res) {
            $_SESSION['scl'] = $ctr_actualizado;
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'Los datos se guardarón correctamente',
                'ctr_id' => $res
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

        $consultorios = ConsultoriosModelo::mdlMostrarConsultorios($data['tenantid']);
        $array = array();
        foreach ($consultorios as $key => $ctr) {
            // $consulta = $_SESSION['usr']['usr_perfil'] === 'Doctor' ? '<a class="dropdown-item" href="' . HTTP_HOST . 'consultas/create/' . base64_encode($pte['pte_id']) . '">Agregar a consulta</a>' : "";

            array_push($array, array(
                'ctr_logo' => '<img src="'.$ctr['ctr_logo'].'" width="100px">',
                'ctr_nombre' => $ctr['ctr_nombre'],
                'ctr_telefono_fijo' => $ctr['ctr_telefono_fijo'],
                'ctr_telefono_celular' => $ctr['ctr_telefono_celular'],
                'acciones' => '
                <div class="dropdown font-sans-serif position-static">
                    <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-10"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-0">
                        <div class="py-2">
                            <a class="dropdown-item" href="' . HTTP_HOST . 'consultorios/update/' . base64_encode($ctr['ctr_id']) . '">Editar</a>
                            <a class="dropdown-item text-danger btnEliminarConsulta" ctr_id="' . $ctr['ctr_id'] . '" href="javascript:void(0);">Eliminar</a>
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
        
        $ctr_id = base64_decode($queryParams['ctr_id']) ?? null;

        $scs = ConsultoriosModelo::mdlMostrarConsultoriosById($ctr_id);

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        $response->getBody()->write(json_encode($scs, true));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
