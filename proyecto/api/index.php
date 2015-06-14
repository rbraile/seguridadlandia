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
$app->post('/login/:usuario/:clave', 'login');

$app->run();

function usuarios() {
    $app = \Slim\Slim::getInstance();
    $connection = new DatabaConnect();
    $query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero, password FROM usuario";
    $resutlado = $connection->DBQuery($query);
    echo $resutlado;
}

function login($usuario, $clave) {
    $app = \Slim\Slim::getInstance();

    // $request = $app->request();
    // $body = $request->getBody();
    // $input = json_decode($body);
    echo $usuarios;
}

// $app->get('/usuarios', function () use ($app) {
//   $app->config('templates.path', './alt_templates/');
//   $app->render('test.php');
// });

// $app->get('/', function() {
//     echo "hola mundo";
// });


// $app->get('/test', function () use ($app) {
//   $app->config('templates.path', './alt_templates/');
//   $app->render('test.html');
// });

// $app->get('/showProduct', function () use ($app) {
//   $app->config('templates.path', './alt_templates/');
//   $app->render('test.html');
// });



