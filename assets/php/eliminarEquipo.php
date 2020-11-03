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

if($_POST['action'] != "borrarEquipo") {
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
    
    
    //rechazar todas las invitaciones
    if($invitaciones = $equipo->ListarInvitaciones()) {
        foreach($invitaciones as $invitacion) {
            $invitacion->RechazarInvitacion();    
        }
    }


    //expulsar a todos los jugadores y notificar jugadores
    if($jugadores = $equipo->ListarJugadores()) {
        foreach($jugadores as $jugador) {

            $equipo->EliminarJugador($jugador);

            Notificador::Save($jugador, "borrarEquipo", array($usuario->nombre." ".$usuario->apellido, $equipo->nombre) );

            Logger::Save($jugador, "salirEquipo", "El usuario id: ".$jugador->id." - ".$jugador->nombre." ".$jugador->apellido." salio del equipo id: ".$equipo->id." - ".$equipo->nombre);
                
        }
    }

    
    $equipo->EliminarEquipo();
    
    Notificador::Save($usuario, "borrarEquipo", array($usuario->nombre." ".$usuario->apellido, $equipo->nombre) );

    Logger::Save($usuario, "borrarEquipo", "El equipo id: ".$equipo->id." - ".$equipo->nombre." fue eliminado");
    
    
    $json->status="ok";

}


echo json_encode($json);
die();

?>