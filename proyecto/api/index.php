<?php 
include_once('database/DatabaConnect.php');
require("vendor/slim/slim/Slim/Slim.php");
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => './alt_templates/'
));

$app->get('/usuario', 'usuarios');
$app->post('/login', 'login');

$app->post("/login/", function() use($app) {});

$app->run();

function usuarios() {
    $app = \Slim\Slim::getInstance();
    $connection = new DatabaConnect();
    $query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario";
    $resutlado = $connection->DBQuery($query);


    $app->response->headers->set("Content-type", "application/json");
    $app->response->status(200);
    $app->response->body(json_encode($resutlado));

    // echo $resutlado;
}

function login() {
    $app = \Slim\Slim::getInstance();
    $nombre = $app->request->post("nombre");
    $password = md5($app->request->post("password"));
    $connection = new DatabaConnect();
    $query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero 
                FROM usuario 
                WHERE nombre = '$nombre' 
                AND password = '$password'";
    $resutlado = $connection->DBQuery($query);
    echo $resutlado;
}

