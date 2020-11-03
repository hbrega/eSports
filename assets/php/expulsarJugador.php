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
        $json->status	= "error";
        $json->msg		= "Sesion Invalida";
        echo json_encode($json);
        die();

    case 2:
        $usuario = new Manager($_SESSION['idUser']);
        break;
}

if($_POST['action'] != "expulsarJugador") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else if(!$equipo = new Equipo($_POST['equipo'])) {
    $json->status	= "error";
    $json->msg		= "Equipo Invalido";
}
else if($equipo->manager->id != $usuario->id) {
    $json->status	= "error";
    $json->msg		= "Equipo Invalido";
}
else {
    
    $jugador = new Jugador($_POST['jugador']);

    
    $equipo->EliminarJugador($jugador);
    
    
    Notificador::Save($jugador, "expulsado", array($equipo->nombre) );

    Logger::Save($jugador, "expulsado", "El usuario id: ".$jugador->id." - ".$jugador->nombre." ".$jugador->apellido." fue expulsado del equipo id: ".$equipo->id." - ".$equipo->nombre);
    
    
    Notificador::Save($usuario, "expulsoJugador", array($jugador->nombre." ".$jugador->apellido, $equipo->nombre) );
    

    $json->status="ok";
}


echo json_encode($json);
die();

?>