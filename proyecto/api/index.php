<?php 

require("vendor/slim/slim/Slim/Slim.php");
require("classes/Token.php");
require("classes/Usuario.php");
require("classes/Contrato.php");
require("classes/Cliente.php");
require("classes/Factura.php");
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
    'templates.path' => './alt_templates/'
));

// traer todos usuarios
$app->put('/usuario', 'editUser');
$app->get('/usuario', 'showUsers');
$app->post('/usuario', 'addUser');
$app->post('/usuario-delete', 'deleteUser');

$app->get('/cliente', 'getAllClient');

$app->delete('/usuario/:id', function ($id) {
    deleteUser(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/usuario/:id', function($id) {
    getUser(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/factura/:id', function($id) {
    getFactura(htmlspecialchars(utf8_decode(strip_tags($id))));
});
$app->post('/factura', 'addfactura');

$app->get('/factura-cliente/:id', function($id) {
    getFacturaCliente(htmlspecialchars(utf8_decode(strip_tags($id))));
});

// traer un usuario
// $app->get('/usuario/:$id', 'usuarioByid');

$app->post('/contrato', 'addContract');
$app->get('/getAllPlans', 'getAllPlans');

$app->get('/contrato/:id', function($id) {
    getContratoById(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/getClienteHogar/:id', function($id) {
    getClienteHogar(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->post('/login', 'login');
$app->get('/logout', 'logout');
$app->get('/hashToken', 'hashToken');

$app->run();

function getAllClient() {
    $cliente = new Cliente();
    echo $cliente->getAllClient();
}

function getContratoById($id) {
    $contrato = new Contrato();
    $result = $contrato->getContratoById($id);
    echo $result;
}

function getFacturaCliente($id) {
    $factura = new Factura();
    $factura->getFacturaByClienteId($id);
}

function getFactura($id) {
    $factura = new Factura();
    $resultado = $factura->getFactura($id);
    echo $resultado;
}

function addFactura() {
    $app = \Slim\Slim::getInstance();
    $factura = new Factura();
    $id_contrato = json_decode($app->request->getBody());
    $id_factura = $factura->createFacutura($id_contrato);
    if(!$id_factura){
        echo "error al ingresar factura";
    } else {
        echo $id_factura;
    }
}

function getClienteHogar($id) {
    $cliente = new Cliente();
    $result = $cliente->getClienteHogar($id);
    echo $result;
}

function getAllPlans() {
    $app = \Slim\Slim::getInstance();
    $contrato = new Contrato();
    $resultado = $contrato->getAllPlans();
    echo $resultado;

}

function getUser($id) {
    $user = new Usuario();
    if($user->userExist($id)) {
        $result = $user->getUserById($id);
        echo $result;
    } else {
        echo false;
    }
}

function editUser() {
    $app = \Slim\Slim::getInstance();
    $user = new Usuario();
    $userFields = json_decode($app->request->getBody());

    $fields->nombre = htmlspecialchars(utf8_decode(strip_tags($fields->nombre)));
    $fields->apellido = htmlspecialchars(utf8_decode(strip_tags($fields->apellido)));
    $fields->dni  = htmlspecialchars(utf8_decode(strip_tags($fields->dni)));
    $fields->email  = htmlspecialchars(utf8_decode(strip_tags($fields->email)));
    $fields->telefono  = htmlspecialchars(utf8_decode(strip_tags($fields->telefono)));
    $fields->calle  = htmlspecialchars(utf8_decode(strip_tags($fields->calle)));
    $fields->numero  = htmlspecialchars(utf8_decode(strip_tags($fields->numero)));

    echo $user->editarUsuario($userFields);    
}

function deleteUser($id) {
    $app = \Slim\Slim::getInstance(); 
    $usuario = new Usuario();
    echo $usuario->deleteUsuario($id);
    
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
    $message = false;
    $app = \Slim\Slim::getInstance();
    $fields = json_decode($app->request->getBody());

    if($fields->nombre && $fields->apellido && $fields->dni && $fields->email &&
      $fields->telefono && $fields->password && $fields->calle && $fields->numero && 
      $fields->tipo_usuario) {

        $fields->nombre = htmlspecialchars(utf8_decode(strip_tags($fields->nombre)));
        $fields->apellido = htmlspecialchars(utf8_decode(strip_tags($fields->apellido)));
        $fields->dni  = htmlspecialchars(utf8_decode(strip_tags($fields->dni)));
        $fields->email  = htmlspecialchars(utf8_decode(strip_tags($fields->email)));
        $fields->telefono  = htmlspecialchars(utf8_decode(strip_tags($fields->telefono)));
        $fields->password  = htmlspecialchars(utf8_decode(strip_tags($fields->password)));
        $fields->calle  = htmlspecialchars(utf8_decode(strip_tags($fields->calle)));
        $fields->numero  = htmlspecialchars(utf8_decode(strip_tags($fields->numero)));
        $fields->tipo_usuario = htmlspecialchars(utf8_decode(strip_tags($fields->tipo_usuario)));
        
        $user = new Usuario();
        $result = $user->addUser($fields);
        if($result) {
            $message = true;
        }

        if($result > 0 && $fields->tipo_usuario == 'cliente') {
            $cliente = new Cliente();
            $cliente->addClienteRelation(1, $result);
        }
    }
    echo $message;
}

function addContract() {
    $app = \Slim\Slim::getInstance();
    $contrato = new Contrato(); 
    $fields = json_decode($app->request->getBody());

    $fields->id_cliente = htmlspecialchars(utf8_decode(strip_tags($fields->id_cliente)));
    $fields->plan = htmlspecialchars(utf8_decode(strip_tags($fields->plan)));

    if($fields->plan != "" && $fields->id_cliente != "") {
        $idContract = $contrato->setContract($fields);
        if($idContract != 0) {
            $contrato->addElements($fields->plan, $idContract);
            echo $idContract;
        } else {
            echo "no se pudo ingresar el contrato";
        }
    } else {
        echo "errorrrrrrrrrr";
    }
}

function createFacutura($id_contrato) {

}

function showUsers() {
    $app = \Slim\Slim::getInstance();
    $usuario = new Usuario();
    $resultado = $usuario->getAllUsers();
    echo $resultado;
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
        $_SESSION["user_id"] = $id;
        if($userType == "cliente") {
            $_SESSION["token"] = $password;
            $telefono = json_decode($usuario->getUsuarioTel($id));
            $_SESSION["telefono"] = $telefono[0]->telefono;

        }
        echo $userType;

    } else {
        echo "";
    }
}


    