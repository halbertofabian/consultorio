<?php
require (__DIR__ . '/../../config.php');
require(__DIR__ . '/../vendor/autoload.php');

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


$app = AppFactory::create();
$app->setBasePath("/".FOLDER."api/v1"); // /myapp/api is the api folder (http://domain/myapp/api)


$app->get('/blog', function (Request $requets, Response $response, $args) {
    $response->getBody()->write('Pagina principal a wuebo');
    return  $response;
});
// Run app
try {
    $app->run();
} catch (Exception $e) {
    // We display a error message
    die(json_encode(array("status" => "failed", "message" => "This action is not allowed")));
}
