<?php 

require("vendor/slim/slim/Slim/Slim.php");
require("classes/Token.php");
require("classes/Alarma.php");
require("classes/Usuario.php");
require("classes/Contrato.php");
require("classes/Cliente.php");
require("classes/Factura.php");
require("classes/Monitoreador.php");
 
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
$app->get('/monitoreadores', 'getAllMonitoreadores');

$app->delete('/usuario/:id', function ($id) {
    deleteUser(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/usuario/:id', function($id) {
    getUser(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/cliente-by-zona/:id', function($id) {
    zonaMonitoreador(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/factura/:id', function($id) {
    getFactura(htmlspecialchars(utf8_decode(strip_tags($id))));
});
$app->post('/factura', 'addfactura');
$app->get('/factura', 'getAllFactura');

$app->get('/factura-cliente/:id', function($id) {
    getFacturaCliente(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/facturas/:id', function($id) {
    getFactura(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/getFacturasByCliente/:id', function($id) {
    getFacturasByCliente(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->post('/pagarFactura', 'pagarFactura');
$app->post('/enviar-factura', 'enviarFactura');

$app->post('/facturasCliente', 'getfacturasCliente');

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


$app->get('/facturaEnvio/:id', function($id) {
    facturaEnvio(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->post('/login', 'login');
$app->get('/logout', 'logout');
$app->get('/hashToken', 'hashToken');

$app->post('/alarmaInterna', 'disparaAlarma');
$app->post('/alarmaUsuario', 'disparaAlarmaUsuario');
$app->put('/alarmaUsuario', 'stopAlarmaUsuario');
$app->post('/alarmaFalse', 'falseAlarmaUsuario');
$app->get('/alarmas-fecha', 'getAllAlarmasByFecha');

$app->get('/alarmas', 'alarmas');
$app->get('/alarmas-list', 'alarmasList');
$app->post('/alarmas-list-by', 'alarmasListBy');

$app->put('/visualizacion', 'changeVisualizacion');
$app->get('/visualizacion/:id', function($id) {
    getVisualizacion(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->get('/getAlarmaState/:id', function($id) {
    getAlarmaState(htmlspecialchars(utf8_decode(strip_tags($id))));
});

$app->run();

function getVisualizacion($id) {
    $cliente = new Cliente();
    echo $cliente->getVisualizacion($id);
}

function changeVisualizacion(){
    $app = \Slim\Slim::getInstance();
    $id = $app->request->post("id");
    $visualizacion = $app->request->post("visualizacion");
    $cliente = new Cliente();
    echo $cliente->changeVisualizacion($id, $visualizacion);
}

function facturaEnvio($id) {
    $factura = new Factura();
    $factura->facturaEnvio($id);
}

function pagarFactura() {
    $app = \Slim\Slim::getInstance();
    $id = $app->request->post("id");
    $factura = new Factura();
    $factura->pagarFactura($id);
}

function enviarFactura() {
    $app = \Slim\Slim::getInstance();
    $id = $app->request->post("id");
    $factura = new Factura();
    $factura->facturaEnvio($id);
}

function alarmas() {
    $alarma = new Alarma(); 
    $alarmas = $alarma->getAllAlarmas();
    $alarmas = json_decode($alarmas);
    $total=0;
    $falsa=0;
    $real=0;
    foreach ($alarmas AS $alarma) {
        if($alarma->factor_alarma == "disparo") {
            $total++;
        } elseif($alarma->factor_alarma == "false") {
            $falsa++;
        } elseif($alarma->factor_alarma == "stop") {
            $real++;
        }
    }

    echo '[{"total": ' . $total . ',"real":' . $real . ',"falsa":' . $falsa . '}]';
}

function alarmasList() {
    $alarma = new Alarma(); 
    $alarmas = $alarma->getAllAlarmas();
    echo $alarmas;
}

function alarmasListBy() {
    $app = \Slim\Slim::getInstance();
    $tipo = $app->request->post("tipo");
    $dato = $app->request->post("dato");
    $alarma = new Alarma(); 
    $alarmas = $alarma->getAllAlarmasBy($tipo, $dato);
    echo $alarmas;
}

function getAllAlarmasByFecha() {
    $dato = new Alarma();
    $alarmas = json_decode($dato->getAllAlarmasByFecha());
    $count=0;
    $result = "[{";
    
    foreach ($alarmas AS $alarma) {
        $count++;
        $result .=  '"fecha_' . $count . '":["' . $alarma->fecha . '",' . $alarma->cantidad . '],';
    }

    $result2 = substr($result, 0, -1);
    echo $result2 . "}]";  
    
}

function getAlarmaState($id){ 
    $alarma = new Alarma();
    echo $alarma->getAlarmaState($id);
}

function disparaAlarmaUsuario() {
    $app = \Slim\Slim::getInstance();
    $id_cliente = $app->request->post("id_cliente");
    $alarma = new Alarma();
    
    $result = $alarma->changeAlarmaState($id_cliente, "1");
    $alarma->hitorialAlarma($id_cliente,"disparo");
}

function stopAlarmaUsuario() {
    $app = \Slim\Slim::getInstance();
    $id_cliente = $app->request->post("id_cliente");
    $alarma = new Alarma();
    $alarma->changeAlarmaState($id_cliente, "0");
    $alarma->hitorialAlarma($id_cliente, "stop");
}

function falseAlarmaUsuario() {
    $app = \Slim\Slim::getInstance();
    $id_cliente = $app->request->post("id_cliente");
    $alarma = new Alarma();
    $alarma->changeAlarmaState($id_cliente, "0");
    $alarma->hitorialAlarma($id_cliente, "false");
}

function disparaAlarma() {
    $app = \Slim\Slim::getInstance();
    $address = $app->request->post("address");
    $userId = $app->request->post("userId");

}

function zonaMonitoreador($id) {
    $cliente = new Cliente();
    echo $cliente->getClienteByZona($id);
}

function getAllClient() {
    $cliente = new Cliente();
    echo $cliente->getAllClient();
}

function getAllMonitoreadores() {
    // $usuario = new Usuario();
    // echo $cliente->getAllClient();
}

function getContratoById($id) {
    $contrato = new Contrato();
    $result = $contrato->getContratoById($id);
    echo $result;
}

function getFacturasByCliente($id) {
    $factura = new Factura();
    $factura->getFacturasByCliente($id);
}

function getFacturaCliente($id) {
    $factura = new Factura();
    $factura->getFacturaByClienteId($id);
}

function getFacturasCliente() {
    $app = \Slim\Slim::getInstance();
    $id = $app->request->post("id");
    $factura = new Factura();
    $factura->getFacturaByClienteId($id);
}

function getAllFactura() {
    $factura = new Factura();
    $resultado = $factura->getAllFactura();
    echo $resultado;
}

function getFactura($id) {
    $factura = new Factura();
    $resultado = $factura->getFacturaByClienteId($id);

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
    $fields = json_decode($app->request->getBody());

    $fields->nombre = htmlspecialchars(utf8_decode(strip_tags($fields->nombre)));
    $fields->apellido = htmlspecialchars(utf8_decode(strip_tags($fields->apellido)));
    $fields->dni  = htmlspecialchars(utf8_decode(strip_tags($fields->dni)));
    $fields->email  = htmlspecialchars(utf8_decode(strip_tags($fields->email)));
    $fields->telefono  = htmlspecialchars(utf8_decode(strip_tags($fields->telefono)));
    $fields->calle  = htmlspecialchars(utf8_decode(strip_tags($fields->calle)));
    $fields->numero  = htmlspecialchars(utf8_decode(strip_tags($fields->numero)));

    if($fields->nombre != "" && $fields->apellido != "" && $fields->dni != "" && $fields->email != "" && $fields->telefono != "" && $fields->calle != "" && $fields->numero != "") {
        echo $user->editarUsuario($fields);    
    } else {
        echo "Error al editar el usuario";
    }

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
        $fields->password  = md5($fields->password);
        $fields->calle  = htmlspecialchars(utf8_decode(strip_tags($fields->calle)));
        $fields->numero  = htmlspecialchars(utf8_decode(strip_tags($fields->numero)));
        $fields->tipo_usuario = htmlspecialchars(utf8_decode(strip_tags($fields->tipo_usuario)));
        $fields->id_zona = htmlspecialchars(utf8_decode(strip_tags($fields->id_zona)));
        
        $user = new Usuario();
        $result = $user->addUser($fields);

        if($result) {
            $message = true;
        }

        if($result > 0 && $fields->tipo_usuario == 'cliente') {
            $id_cliente = $result;
            $cliente = new Cliente();
            $cliente->addClienteRelation(0, $id_cliente);
            $cliente->setAlarmaCleinte($id_cliente);
        }

        if($result > 0 && $fields->tipo_usuario == 'monitoreador') {
            var_dump($result);
            $monitoreador = new Monitoreador();
            $monitoreador->addMonitoreador($fields->id_zona, $result);
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
        $id_zona = $data_user['id_zona'];
        $id = $data_user['id'];
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["login"] = true;
        $_SESSION["user_type"] = $userType;
        $_SESSION["user_id"] = $id;
        $_SESSION["nya"] =  $data_user['nombre'] . " " . $data_user['apellido'];
        $_SESSION["dire"] = $data_user['calle'] . " " . $data_user['numero'];

        $_SESSION["id_zona"] = $id_zona;

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


    