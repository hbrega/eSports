<?php
header('Content-Type: application/json');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require("../config/config.php");
require("funciones.php");

require("../clases/persona.php");


$json = new stdClass();


if($usuario = Persona::buscarEmail($_POST['email'])) {
	$json->status	= "ok";
	$json->id 		= $usuario;
}
else {
	$json->status	= "error";
}


echo json_encode($json);
die();

?>