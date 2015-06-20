<?php 
require_once('database/DatabaConnect.php');
require("vendor/slim/slim/Slim/Slim.php");
require("classes/Token.php");
require("classes/Usuario.php");
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => './alt_templates/'
));

// traer todos usuarios
$app->get('/usuario', 'usuarios');

// traer un usuario
// $app->get('/usuario:$id', 'usuarios');

$app->post('/usuario', 'insertUser');
$app->post('/login', 'login');
$app->get('/hashToken', 'hashToken');

$app->run();

function insertUser() {
    $app = \Slim\Slim::getInstance();
    $connection = new DatabaConnect();
    $fields = json_decode($app->request->getBody());
    $user = new Usuario();
    $user->setUser($connection, $fields);


}


function usuarios() {
    $app = \Slim\Slim::getInstance();
    $connection = new DatabaConnect();
    $query = "SELECT nombre, apellido, email, tipo_usuario, telefono, dni, calle, numero FROM usuario";
    $resultado = $connection->DBQuery($query);

    // $app->response->headers->set("Content-type", "application/json");
    // $app->response->status(200);
    // $app->response->body(json_encode($resulado));
    echo  $connection->getResultJSONEncode($resultado);
}

function hashToken() {
    $app = \Slim\Slim::getInstance();
    $id = $app->request->get("id");
    $token = new Token();
    $connection = new DatabaConnect();
    echo $token->getHashToken($connection, $id);
}

function login() {
    $app = \Slim\Slim::getInstance();
    $passwodToken = new Token();
    $connection = new DatabaConnect();
    $usuario = new Usuario();

    $nombre = $app->request->post("nombre");
    $password = $passwodToken->createPasswordToken($app->request->post("password"));    
    $resultado = $usuario->instertUser($connection, $nombre, $password);

    if($resultado->num_rows == 1) {
        $newToken = new Token(); 
        $hashtoken = $newToken->createRandomToken();
        $data_user = $resultado->fetch_assoc();
        $id = $data_user['id'];        
        $result = $usuario->setUserToken($id, $hashtoken);
        echo $result;
    }
}

    