<?php 
require("vendor/slim/slim/Slim/Slim.php");
require("classes/Token.php");
require("classes/Usuario.php");
require("classes/Contrato.php");
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => './alt_templates/'
));

// traer todos usuarios
$app->get('/usuario', 'showUsers');
$app->post('/usuario', 'addtUser');

// traer un usuario
// $app->get('/usuario/:$id', 'usuarios');

$app->post('/contrato', 'addContract');

$app->post('/login', 'login');
$app->get('/hashToken', 'hashToken');

$app->run();

function addtUser() {
    $app = \Slim\Slim::getInstance();
    $connection = new DatabaConnect(); 
    $fields = json_decode($app->request->getBody());
    $user = new Usuario();
    $user->setUser($connection, $fields);
}

function addContract() {
    $app = \Slim\Slim::getInstance();
    $contrato = new Contrato(); 
    $fields = json_decode($app->request->getBody());
    $idContract = $contrato->setContract($fields);
    if($idContract != 0) {
        $contrato->addElements($fields->plan, $idContract);
    } else {
        echo "no se pudo ingresar el contrato";
    }

}

function showUsers() {
    $app = \Slim\Slim::getInstance();
    $connection = new DatabaConnect();
    $usuario = new Usuario();
    $resultado = $usuario->getAllUsers($connection);
    echo  $resultado;
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

    