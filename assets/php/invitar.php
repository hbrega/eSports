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
        break;

    case 2:
        $usuario = new Manager($_SESSION['idUser']);
        break;
}

if($_POST['action'] != "invitarJugador") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else if(!$equipo = new Equipo($_POST['idEquipo'])) {
    $json->status	= "error";
    $json->msg		= "Equipo Invalido";
}
else if($equipo->manager->id != $usuario->id) {
    $json->status	= "error";
    $json->msg		= "Equipo Invalido";
}
else {
    
    $jugador = new Jugador($_POST['ivtPlayer']);
    
    Invitacion::Invitar($jugador, $equipo);
    
    
    Notificador::Save($usuario, "invitacionEnviada", array($jugador->nombre." ".$jugador->apellido, $equipo->nombre) );
    Logger::Save($usuario, "invitacionEnviada", "El usuario id: ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." invito al usuario id: ".$jugador->id." - ".$jugador->nombre." ".$jugador->apellido." al equipo id: ".$equipo->id." - ".$equipo->nombre);

    
    Notificador::Save($jugador, "invitacionRecibida", array($usuario->nombre." ".$usuario->apellido, $equipo->nombre) );
    Logger::Save($jugador, "invitacionRecibida", "El usuario id: ".$jugador->id." - ".$jugador->nombre." ".$jugador->apellido." recibio una invitacion del usuario id: ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." para unirse al equipo id: ".$equipo->id." - ".$equipo->nombre);

    $json->status="ok";

}


echo json_encode($json);
die();

?>