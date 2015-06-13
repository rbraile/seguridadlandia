<?php 
include_once('database/base.php');

require("vendor/slim/slim/Slim/Slim.php");
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('debug' => true));

$app->get('/', function() {
	echo "hola mundo";
});

$app->get('/hello/:name',  function($name) {
	echo "hola : $name";
});
	
$app->run();