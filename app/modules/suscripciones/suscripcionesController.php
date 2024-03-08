<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require(__DIR__ . '../../suscripciones/suscripcionesModelo.php');

class SuscripcionesController
{
    public function create(Request $request, Response $response, $args) {
        // Aquí puedes acceder a los datos de la solicitud
        $data = $request->getParsedBody();

        $data['scs_nombre'] = strtoupper($data['scs_nombre']);
        $data['tenantid'] = uniqid();

        $res = SuscripcionesModelo::mdlGuardarSuscripciones($data);
        if($res){
            $response->getBody()->write(json_encode(array(
                'status' => true,
                'mensaje' => 'El suscriptor se guardo correctamente',
            )));
        }else{
            $response->getBody()->write(json_encode(array(
                'status' => false,
                'mensaje' => 'Hubo un error',
            )));
        }


        return $response->withHeader('Content-Type', 'application/json');

    }

    public function list($request,  $response, $args)
    {
        // Aquí se simula una lista de usuarios
         $queryParams = $request->getQueryParams(); // Datos get
        // $data = $request->getParsedBody(); // Datos post
        echo json_encode($queryParams,true);
        // $users = [
        //     ['id' => 1, 'name' => 'Usuario 1'],
        //     ['id' => 2, 'name' => 'Usuario 2'],
        //     ['id' => 3, 'name' => 'Usuario 3'],
        // ];

        // // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
        // $response->getBody()->write(json_encode($users));

        return $response->withHeader('Content-Type', 'application/json');
    }
   
}
