<?php 

require("vendor/slim/slim/Slim/Slim.php");
require("classes/Token.php");
require("classes/Usuario.php");
require("classes/Contrato.php");
require("classes/Cliente.php");
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => './alt_templates/'
));

// traer todos usuarios
$app->get('/usuario', 'showUsers');
$app->post('/usuario', 'addUser');
$app->get('/usuario/:id', function($id) {
    getUser($id);
});

// traer un usuario
// $app->get('/usuario/:$id', 'usuarios');

$app->post('/contrato', 'addContract');

$app->post('/login', 'login');
$app->get('/logout', 'logout');
$app->get('/hashToken', 'hashToken');

$app->run();

function getUser($id) {
    $user = new Usuario();
    if($user->userExist($id)) {
        $result = $user->getUserById($id);
        echo $result;
    } else {
        echo false;
    }
}

function logout() {
    $app = \Slim\Slim::getInstance();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    echo "redirect";
}

function addUser() {
    $app = \Slim\Slim::getInstance();
    $fields = json_decode($app->request->getBody());
    $user = new Usuario();
    $message = false;
    if($user->addUser($fields)) {
        $message = true;
    }
    $result = $user->addUser($fields);
    if($result > 0 && $fields->tipo_usuario == 'cliente') {
        $cliente = new Cliente();
        $cliente->addClienteRelation($result, 1);
    }
    echo $message;
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
    $usuario = new Usuario();
    $resultado = $usuario->getAllUsers();
    echo  $resultado;
}

function hashToken() {
    $app = \Slim\Slim::getInstance();
    $id = $app->request->get("id");
    $token = new Token();
    echo $token->getHashToken($id);
}

function login() {
    $app = \Slim\Slim::getInstance();
    $passwodToken = new Token();
    $usuario = new Usuario();

    $nombre = $app->request->post("nombre");

    $password = $passwodToken->createPasswordToken($app->request->post("password"));
    $resultado = $usuario->loginUser($nombre, $password);

    if($resultado->num_rows == 1) {
        $data_user = $resultado->fetch_assoc();
        $newToken = new Token(); 
        $hashtoken = $newToken->createRandomToken();
        $userType = $data_user['tipo_usuario'];
        $id = $data_user['id'];
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["login"] = true;
        $_SESSION["user_type"] = $userType;

        echo $userType;

    } else {
        echo "";
    }
}


    