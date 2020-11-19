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
require("../clases/torneo.php");
require("../clases/juego.php");
require("../clases/inscripcion.php");
require("../clases/logger.php");
require("../clases/notificador.php");



$conn = _connect();
$json = new stdClass();

//{inscripcion: $(this).data("inscripcion"), equipo: $(this).data("equipo"), action: 'abandonarTorneo'}

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

if($_POST['action'] != "abandonarTorneo") {
    $json->status	= "error";
    $json->msg		= "Acción no seteada";
}
else if(!$torneo = new Torneo($_POST['torneo'])) {
    $json->status	= "error";
    $json->msg		= "Torneo Invalido";
}
else if(!$equipo = new Equipo($_POST['equipo'])) {
    $json->status	= "error";
    $json->msg		= "Equipo Invalido";
}
else if($equipo->manager->id != $usuario->id) {
    $json->status	= "error";
    $json->msg		= "Equipo Invalido";
}
else if(!$torneo->CheckEquipo($torneo)) {
    $json->status	= "error";
    $json->msg		= "El Equipo no esta anotado al Torneo";
}
else {
    
    //obtener jugadores
    $jugadores = $torneo->ListarJugadores($equipo);

    //abandonar
    //$torneo->AbandonarTorneo($equipo);
    
    
    //notificar mnanager
    Notificador::Save($usuario, "abandonarTorneo", array($equipo->nombre, $torneo->nombre) );

    Logger::Save($usuario, "abandonarTorneoManager", "El manager ".$usuario->id." - ".$usuario->nombre." ".$usuario->apellido." del equipo id: ".$equipo->id." - ".$equipo->nombre." abandono el torneo: ".$torneo->nombre);
    
    
    
    //notificar jugadores
    foreach($jugadores as $jugador) {
        Notificador::Save($jugador, "abandonarTorneo", array($equipo->nombre, $torneo->nombre) );

        Logger::Save($jugador, "abandonarTorneo", "El jugador ".$jugador->id." - ".$jugador->nombre." ".$jugador->apellido." del equipo id: ".$equipo->id." - ".$equipo->nombre." abandono el torneo: ".$torneo->nombre);

    }
    
    
    $json->status	= "ok";
    
}




echo json_encode($json);
die();

?>