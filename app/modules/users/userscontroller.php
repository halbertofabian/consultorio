<?php

class UserController
{
    // public function list($request,  $response, $args)
    // {
    //     // Aquí se simula una lista de usuarios
    //     $users = [
    //         ['id' => 1, 'name' => 'Usuario 1'],
    //         ['id' => 2, 'name' => 'Usuario 2'],
    //         ['id' => 3, 'name' => 'Usuario 3'],
    //     ];

    //     // Se convierte la lista de usuarios a formato JSON y se envía como respuesta
    //     $response->getBody()->write(json_encode($users));

    //     return $response->withHeader('Content-Type', 'application/json');
    // }

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
