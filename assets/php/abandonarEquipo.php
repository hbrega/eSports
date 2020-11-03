<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');
session_start();


require("../config/config.php");
require("funciones.php");


require("../clases/persona.php");
require("../clases/jugador.php");
require("../clases/manager.php");
require("../clases/equipo.php");
require("../clases/invitacion.php");
require("../clases/logger.php");
require("../clases/notificador.php");



$conn = _connect();
$json = new stdClass();



switch($_SESSION['userLvl']) {
    case 1:
        $usuario = new Jugador($_SESSION['idUser']);
        break;

    case 2:
        $json->status	= "error";
        $json->msg		= "Sesion Invalida";
        echo json_encode($json);
        die();
}

if($_POST['action'] != "abandonarEquipo") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else if(!$equipo = $usuario->ListarEquipos()) {
    $json->status	= "error";
    $json->msg		= "Equipo invalido";
}
else {

    $equipo->EliminarJugador($usuario);
    
    
    Notificador::Save($usuario, "salirEquipo", array($equipo->nombre) );

    Logger::Save($usuario, "salirEquipo", "El usuario id: ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." abandono el equipo id: ".$equipo->id." - ".$equipo->nombre);

    
    Notificador::Save($equipo->manager, "jugadorSalioEquipo", array($usuario->nombre." ".$usuario->apellido, $equipo->nombre) );    
    

    $json->status="ok";
}


echo json_encode($json);
die();

?>